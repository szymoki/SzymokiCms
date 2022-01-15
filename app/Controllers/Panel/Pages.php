<?php
/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-08 12:02:55
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

/**
 * Description of panel
 *
 * @author szymon
 */
class Pages extends PanelController
{

    public function __construct()
    {
        $this->session              = \Config\Services::session();
        $this->ses                  = $this->session->get("logged_in");
        $this->pages_model          = new \App\Models\Pages_model();
        $this->pages_addlinks_model = new \App\Models\Pages_addlinks_model();
        $this->acl_model            = new \App\Models\Acl_model();
        $this->pages_p_model        = new \App\Models\Pages_p_model();
        helper("acl");
        helper("log");
        helper("page_helper");
        $this->page_config = new \Config\Page();
        $this->site_config = new \App\Libraries\Site_config();
    }

    public function index()
    {

        $dane["ses"]        = $this->ses;
        $dane["pages"]      = $this->pages_model->findAll();
        $panel_body         = view("/panel/pages/pages_index", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('/panel/panel_theme', $dane);
    }

    public function add()
    {

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["pages"]      = $this->pages_model->findAll();
        $panel_body         = view("/panel/pages/pages_add", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('/panel/panel_theme', $dane);
    }

    public function menu_add($id)
    {

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["parent_id"]  = $id;
        $dane["pages"]      = $this->pages_model->findAll();
        $panel_body         = view("/panel/pages/pages_menu_add", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('/panel/panel_theme', $dane);
    }

    public function menu_edit($id)
    {

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["id"]         = $id;
        $dane["link"]       = $this->pages_addlinks_model->find($id);
        $dane["pages_all"]  = $this->pages_model->findAll();
        $panel_body         = view("/panel/pages/pages_menu_edit", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('/panel/panel_theme', $dane);
    }

    public function edit($id)
    {

        $dane["links"]      = $this->pages_addlinks_model->orderBy("position")->where("parent_id", $id)->where("page_type", 0)->findAll();
        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["pages"]      = $this->pages_model->find($id);
        $dane["pages_all"]  = $this->pages_model->findAll();
        $panel_body         = view("/panel/pages/pages_edit", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('/panel/panel_theme', $dane);
    }

    public function addu()
    {

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        $validation->setRule('text', 'Url', 'required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("/panel/pages/pages_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('/panel/panel_theme', $dane);
        } else {
            $page_id = $this->pages_model->insert(array(
                "title"       => $this->request->getPost("title"),
                "text"        => $this->request->getPost("text"),
                "published"   => $this->request->getPost("published"),
                "create_by"   => $this->ses["id"],
                "create_date" => date("Y-m-d H:i:s"),
                "edited_by"   => $this->ses["id"],
                "edited_date" => date("Y-m-d H:i:s"),
                "parent_id"   => $this->request->getPost("parent_id"),
                "symlink"     => strtolower($this->request->getPost("symlink")),

            ));
            if ($this->request->getPost("parent_id") != 0) {
                $this->pages_addlinks_model->insert(array(
                    "title"     => $this->request->getPost("title"),
                    "page_id"   => $page_id,
                    "url"       => "",
                    "parent_id" => $this->request->getPost("parent_id"),
                    "position"  => 0,

                ));
            }
            $this->site_config->routes_generate();
            log_cms("Dodanie podstrony: " . $page_id . "/" . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/pages');
        }

    }

    public function editu()
    {

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("/panel/pages/pages_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('/panel/panel_theme', $dane);
        } else {

            if ($this->request->getPost("parent_id") != 0) {
                $link = $this->pages_addlinks_model->where("page_type", 0)->where("page_id", $this->request->getPost("id"))->where("parent_id", $this->request->getPost("parent_id"))->findAll();

                if (count($link) == 1) {
                    $link = $link[0];
                    if ($link->page_id != $this->request->getPost("id")) {
                        $this->pages_addlinks_model
                            ->where("page_type", 0)
                            ->where("page_id", $this->request->getPost("id"))
                            ->where("parent_id", $this->request->getPost("parent_id"))
                            ->set([
                                "title"     => $this->request->getPost("title"),
                                "page_id"   => $page_id,
                                "url"       => "",
                                "parent_id" => $this->request->getPost("parent_id"),
                                "position"  => 0,
                            ])
                            ->update();
                    }
                } else {
                    $this->pages_addlinks_model->insert([
                        "title"     => $this->request->getPost("title"),
                        "page_id"   => $this->request->getPost("id"),
                        "url"       => "",
                        "parent_id" => $this->request->getPost("parent_id"),
                        "position"  => 0,
                    ]);
                }
            }

            $this->pages_model->update($this->request->getPost("id"), array(
                "title"       => $this->request->getPost("title"),
                "text"        => $this->request->getPost("text"),
                "published"   => $this->request->getPost("published"),
                "edited_by"   => $this->ses["id"],
                "edited_date" => date("Y-m-d H:i:s"),
                "parent_id"   => $this->request->getPost("parent_id"),
                "symlink"     => strtolower($this->request->getPost("symlink")),

            ));
            $this->site_config->routes_generate();
            log_cms("Edycja podstrony: " . $this->request->getPost("id") . "/" . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/pages');
        }

    }

    public function symlink()
    {
        $this->site_config->routes_generate();
    }
    public function del($id)
    {
        $page = $this->pages_model->find($id);
        log_cms("Usunięcie podstrony: " . $id . "/" . $page->title);
        $this->pages_model->delete($id);
        $this->pages_addlinks_model->where("page_id", $id)->where("page_type", 0)->delete();
        $this->pages_addlinks_model->where("parent_id", $id)->where("page_type", 0)->delete();
        return redirect()->to(base_url() . "/panel/pages");
    }

    public function addu_menu()
    {

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"]      = true;
            $dane["ses"]        = $this->ses;
            $panel_body         = view("/panel/pages/pages_edit", $dane);
            $dane["panel_body"] = $panel_body;
            redirect("/panel/pages");
        } else {
            $this->pages_addlinks_model->insert(array(
                "title"     => $this->request->getPost("title"),
                "page_id"   => $this->request->getPost("page_id"),
                "url"       => $this->request->getPost("url"),
                "parent_id" => $this->request->getPost("id"),
                "position"  => $this->request->getPost("position"),

            ));
            $this->site_config->routes_generate();
            log_cms("Ręczne dodanie pozycji menu: " . $this->request->getPost("page_id") . "/" . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/pages/edit/' . $this->request->getPost("id"));
        }

    }

    public function editu_menu()
    {

        //This method will have the credentials validation
        $validation = \Config\Services::validation();

        $validation->setRule('title', 'nazwa', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("/panel/pages/pages_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('/panel/panel_theme', $dane);
        } else {
            $this->pages_addlinks_model->update($this->request->getPost("id"), array(
                "title"     => $this->request->getPost("title"),
                "page_id"   => $this->request->getPost("page_id"),
                "url"       => $this->request->getPost("url"),
                "parent_id" => $this->request->getPost("parent_id"),
                "position"  => $this->request->getPost("position"),
            ));
            $this->site_config->routes_generate();
            log_cms("Edycja pozycji menu: " . $this->request->getPost("page_id") . "/" . $this->request->getPost("title"));
            return redirect()->to(base_url() . '/panel/pages/edit/' . $this->request->getPost("parent_id"));
        }

    }
    public function setposition()
    {

        $pozycje = $this->request->getPost("positions");
        foreach ($pozycje as $key => $item) {
            $this->pages_addlinks_model->update($item, array(
                "position" => $key,
            ));
        }
    }
    public function menu_del($id)
    {
        $menupos = $this->pages_addlinks_model->find($id);
        log_cms("Usunięcie pozycji menu: " . $id . "/" . $menupos->title);
        $this->pages_addlinks_model->delete($id);
        return redirect()->to(base_url() . "/panel/pages");
    }

}
