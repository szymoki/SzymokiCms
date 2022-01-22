<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-03 14:37:41
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:20:11
 * @email: szymon.haczyk@icloud.com
 */

namespace App\Controllers\Panel;

/**
 * Description of panel
 *
 * @author szymon
 */
class Menu extends PanelController
{

    public function __construct()
    {
        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->menu_model    = new \App\Models\Menu_model();
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
        $dane["menu"]       = $this->menu_model->orderBy("pozycja", "ASC")->findAll();
        $panel_body         = view("panel/menu/menu_index", $dane);
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
        $dane["menu"]       = $this->menu_model->findAll();
        $panel_body         = view("panel/menu/menu_add", $dane);
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
        $dane["element"]    = $this->menu_model->find($id);
        $dane["menu"]       = $this->menu_model->findAll();
        $panel_body         = view("panel/menu/menu_edit", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function addu()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation
        $validation = \Config\Services::validation();
        $validation->setRule('name', 'nazwa', 'trim|required');
        $validation->setRule('url', 'Url', 'trim|required');
        $validation->setRule('pozycja', 'Pozycja', 'trim');
        $validation->setRule('active', 'Aktywny', 'trim|required');
        $validation->setRule('parent_id', 'Podmenu', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"]      = true;
            $dane["ses"]        = $this->ses;
            $dane["menu"]       = $this->menu_model->findAll();
            $panel_body         = view("panel/menu/menu_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $mid = $this->menu_model->insert(array(
                "name"      => $this->request->getPost("name",FILTER_SANITIZE_STRING),
                "url"       => strtolower($this->request->getPost("url",FILTER_SANITIZE_URL)),
                "pozycja"   => $this->request->getPost("pozycja",FILTER_SANITIZE_STRING),
                "parent_id" => $this->request->getPost("parent_id"),
                "active"    => $this->request->getPost("active"),

            ));
            log_cms("Dodanie pozycji głownego menu: " . $mid . "/" . $this->request->getPost("name"));
            return redirect()->to(base_url() . '/panel/menu');
        }

    }

    public function editu()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation
        $validation = \Config\Services::validation();
        $validation->setRule('name', 'nazwa', 'trim|required');
        $validation->setRule('url', 'Url', 'trim|required');
        $validation->setRule('pozycja', 'Pozycja', 'trim|required');
        $validation->setRule('active', 'Aktywny', 'trim|required');
        $validation->setRule('parent_id', 'Podmenu', 'trim|required');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
            $dane["alert"]      = true;
            $dane["ses"]        = $this->ses;
            $dane["menu"]       = $this->menu_model->get_all();
            $panel_body         = view("panel/menu/menu_add", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $this->menu_model->update($this->request->getPost("id"), array(
                "name"      => $this->request->getPost("name"),
                "url"       => strtolower($this->request->getPost("url",FILTER_SANITIZE_URL)),
                "pozycja"   => $this->request->getPost("pozycja"),
                "parent_id" => $this->request->getPost("parent_id"),
                "active"    => $this->request->getPost("active"),

            ));
            log_cms("Edycja pozycji głownego menu: " . $this->request->getPost("id") . "/" . $this->request->getPost("name"));
            return redirect()->to(base_url() . '/panel/menu');
        }

    }
    public function del($id)
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $m = $this->menu_model->find($id);
        log_cms("Usunięcie pozycji głownego menu: " . $id . "/" . $m->name);
        $this->menu_model->delete($id);
        return redirect()->to(base_url() . '/panel/menu');
    }

    public function setposition()
    {
        if (!acl("szablon")) {
            return redirect()->to(base_url("panel/admin"));
        }

        $pozycje = $this->request->getPost("positions");
        foreach ($pozycje as $key => $item) {
            $this->menu_model->update($item, array(
                "pozycja" => $key,
            ));
        }
    }

}
