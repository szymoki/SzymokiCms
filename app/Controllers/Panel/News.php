<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:13:54
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

/**
 * Description of panel
 *
 * @author szymon
 */
class News extends PanelController
{

    public function __construct()
    {

        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->news_model    = new \App\Models\News_model();
        $this->acl_model     = new \App\Models\Acl_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        helper("acl");
        helper("log");
        $this->page_config = new \Config\Page();

    }

    public function index()
    {

        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["news"]       = $this->news_model->orderBy("id", "DESC")->paginate(10);
        $dane["pager"]      = $this->news_model->pager;
        $dane["cat"]        = "-";
        $dane["categories"] = $this->page_config->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $panel_body         = view("panel/news/news_index", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function category($cat, $from = 0)
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["news"]       = $this->news_model->orderBy("id", "DESC")->where("category", $cat)->paginate(10);
        $dane["pager"]      = $this->news_model->pager;
        $dane["ses"]        = $this->ses;
        $dane["cat"]        = $cat;
        $dane["categories"] = $this->page_config->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $panel_body         = view("panel/news/news_index", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function add()
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["categories"]         = $this->page_config->categories;
        $dane["pages_p_categories"] = $this->pages_p_model->where("parent_id", '0')->findAll();
        $dane["ses"]                = $this->ses;
        $dane["alert"]              = false;
        $panel_body                 = view("panel/news/news_add", $dane);
        $dane["panel_body"]         = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function edit($id)
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["categories"]         = $this->page_config->categories;
        $dane["pages_p_categories"] = $this->pages_p_model->where("parent_id", '0')->findAll();
        $dane["ses"]                = $this->ses;
        $dane["alert"]              = false;
        $dane["news"]               = $this->news_model->find($id);
        $panel_body                 = view("panel/news/news_edit", $dane);
        $dane["panel_body"]         = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function addu()
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            return redirect()->to(base_url() . '/panel/news');
        } else {
            $this->news_model->insert(array(
                "title"       => $this->request->getPost("title",FILTER_SANITIZE_STRING),
                "text"        => $this->request->getPost("text"),
                "published"   => $this->request->getPost("published"),
                "mainphoto"   => $this->request->getPost("mainphoto",FILTER_SANITIZE_STRING),
                "super"       => $this->request->getPost("super"),
                "mainpage"    => $this->request->getPost("mainpage"),
                "category"    => $this->request->getPost("category"),
                "create_by"   => $this->ses["id"],
                "create_date" => date("Y-m-d H:i:s"),
                "edited_by"   => $this->ses["id"],
                "edited_date" => date("Y-m-d H:i:s"),
            ));
            log_cms("Dodanie newsa: " . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/news');

        }

    }

    public function editu()
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("panel/news/news_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $this->news_model->update($this->request->getPost("id"), array(
                "title"       => $this->request->getPost("title",FILTER_SANITIZE_STRING),
                "text"        => $this->request->getPost("text"),
                "published"   => $this->request->getPost("published"),
                "super"       => $this->request->getPost("super"),
                "mainpage"    => $this->request->getPost("mainpage"),
                "category"    => $this->request->getPost("category"),
                "mainphoto"   => $this->request->getPost("mainphoto",FILTER_SANITIZE_STRING),
                "edited_by"   => $this->ses["id"],
                "edited_date" => date("Y-m-d H:i:s"),
            ));
            log_cms("Edycja newsa: " . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/news');
        }

    }

    public function del($id)
    {
        if (!(acl("news_pages") or acl("news"))) {
            return redirect()->to(base_url("panel/admin"));
        }

        $news = $this->news_model->find($id);
        log_cms("Usunięcie newsa: " . $news->title);
        $this->news_model->delete($id);
        return redirect()->to(base_url() . '/panel/news');
    }

}
