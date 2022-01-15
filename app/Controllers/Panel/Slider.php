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
class Slider extends PanelController
{

    public function __construct()
    {
        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->slider_model  = new \App\Models\Slider_model();
        $this->acl_model     = new \App\Models\Acl_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        helper("acl");
        helper("log");
        $this->page_config = new \Config\Page();
    }

    public function index()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["slider"]     = $this->slider_model->findAll();
        $panel_body         = view("panel/slider/slider_index", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function add()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["slider"]     = $this->slider_model->findAll();
        $panel_body         = view("panel/slider/slider_add", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function edit($id)
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["slider"]     = $this->slider_model->find($id);
        $panel_body         = view("panel/slider/slider_edit", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function addu()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $validation = \Config\Services::validation();

        $validation->setRule('image_path', 'nazwa', 'trim|required');
        $validation->setRule('btn_text', 'Url', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("panel/slider/slider_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $sid = $this->slider_model->insert(array(
                "image_path" => $this->request->getPost("image_path"),
                "text"       => $this->request->getPost("text"),
                "btn_text"   => $this->request->getPost("btn_text"),
                "url"        => $this->request->getPost("url"),
                "active"     => $this->request->getPost("active"),

            ));
            log_cms("Dodanie elementu slidera " . $sid);
            return redirect()->to(base_url() . '/panel/slider');
        }

    }

    public function editu()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $validation = \Config\Services::validation();

        $validation->setRule('image_path', 'nazwa', 'trim|required');
        $validation->setRule('btn_text', 'Url', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"] = true;

            $dane["ses"]        = $this->ses;
            $panel_body         = view("panel/slider/slider_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $this->slider_model->update($this->request->getPost("id"), array(
                "image_path" => $this->request->getPost("image_path"),
                "text"       => $this->request->getPost("text"),
                "btn_text"   => $this->request->getPost("btn_text"),
                "url"        => $this->request->getPost("url"),
                "active"     => $this->request->getPost("active"),
            ));
            log_cms("Edycja elementu slidera " . $this->request->getPost("id"));
            return redirect()->to(base_url() . '/panel/slider');
        }

    }

    public function del($id)
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        log_cms("Usunięcie elementu slidera " . $id);

        $this->slider_model->delete($id);
        return redirect()->to(base_url() . '/panel/slider');
    }

}
