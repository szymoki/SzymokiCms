<?php
/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:17:11
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

/**
 * Description of panel
 *
 * @author szymon
 */
class Users extends PanelController
{

    public function __construct()
    {

        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->user_model    = new \App\Models\User_model();
        $this->acl_model     = new \App\Models\Acl_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        $this->pages_model   = new \App\Models\Pages_model();
        helper("acl");
        helper("log");
        $this->page_config = new \Config\Page();

        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

    }

    public function index()
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        $dane["ses"]        = $this->ses;
        $dane["users"]      = $this->user_model->findAll();
        $panel_body         = view("panel/users/users_index", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function add()
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        $validation = \Config\Services::validation();

        $dane["validation"] = $validation;

        $dane["acl__pages_p_items"] = $this->pages_p_model->where("parent_id", 0)->findAll();
        $dane["acl__pages_items"]   = $this->pages_model->where("parent_id", 0)->findAll();
        $dane["acl_items"]          = $this->page_config->acl_items;
        $dane["ses"]                = $this->ses;
        $dane["alert"]              = false;
        $panel_body                 = view("panel/users/users_add", $dane);
        $dane["panel_body"]         = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function edit($id)
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        $validation = \Config\Services::validation();

        $dane["validation"] = $validation;

        $dane["acl__pages_p_items"] = $this->pages_p_model->where("parent_id", 0)->findAll();
        $dane["acl__pages_items"]   = $this->pages_model->where("parent_id", 0)->findAll();
        $dane["acl_items"]          = $this->page_config->acl_items;
        $dane["user"]               = $this->user_model->find($id);
        $dane["ses"]                = $this->ses;
        $dane["alert"]              = false;
        $panel_body                 = view("panel/users/users_edit", $dane);
        $dane["panel_body"]         = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function addu()
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation
        $validation = \Config\Services::validation();
        $validation->setRule('nick', 'Nazwa użytkownika', 'trim|required');
        $validation->setRule('name', 'Imię i nazwisko', 'trim|required');
        $validation->setRule('email', 'Email', 'trim|required');
        $validation->setRule('password', 'Hasło', 'trim|required|min_length[6]');
        $validation->setRule('password2', 'Powtórz hasło', 'trim|required|matches[password]');
        $validation->setRule('level', 'Uprawnienia', 'trim|required');
        if (!$validation->run($_POST)) {

            $dane["alert"]              = true;
            $dane["acl__pages_p_items"] = $this->pages_p_model->where("parent_id", 0)->findAll();
            $dane["acl_items"]          = $this->page_config->acl_items;
            $dane["ses"]                = $this->ses;
            $dane["validation"]         = $validation;
            $dane["acl__pages_p_items"] = $this->pages_p_model->where("parent_id", 0)->findAll();
            $dane["acl__pages_items"]   = $this->pages_model->where("parent_id", 0)->findAll();
            $dane["acl_items"]          = $this->page_config->acl_items;
            $dane["ses"]                = $this->ses;
            $panel_body                 = view("panel/users/users_add", $dane);
            $dane["panel_body"]         = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            $encryption = new \Config\Encryption();
            $id         = $this->user_model->insert(array(
                "nick"     => $this->request->getPost("nick",FILTER_SANITIZE_STRING),
                "name"     => $this->request->getPost("name",FILTER_SANITIZE_STRING),
                "password" => password_hash($encryption->key . $this->request->getPost("password"),PASSWORD_BCRYPT),
                "level"    => $this->request->getPost("level"),
                "email"    => $this->request->getPost("email",FILTER_SANITIZE_EMAIL),

            ));
            if ($this->request->getPost("acl")) {
                foreach ($this->request->getPost("acl") as $item) {
                    $this->acl_model->insert(array("user_id" => $id, "acl_name" => $item));
                }
            }
            if ($this->request->getPost("pages_p")) {
                foreach ($this->request->getPost("pages_p") as $item) {
                    $this->acl_model->insert(array("user_id" => $id, "acl_name" => "p_" . $item));
                }
            }
            if ($this->request->getPost("pages")) {
                foreach ($this->request->getPost("pages") as $item) {
                    $this->acl_model->insert(array("user_id" => $id, "acl_name" => "p0_" . $item));
                }
            }
            log_cms("Dodanie użytkownika: " . $this->request->getPost("nick"));
            return redirect()->to(base_url() . '/panel/users');
        }

    }

    public function editu()
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        //This method will have the credentials validation

        $validation = \Config\Services::validation();
        $validation->setRule('nick', 'Nazwa użytkownika', 'trim|required');
        $validation->setRule('name', 'Imię i nazwisko', 'trim|required');
        $validation->setRule('email', 'Email', 'trim|required');
        $validation->setRule('password', 'Hasło', 'trim');
        $validation->setRule('password2', 'Powtórz hasło', 'trim|mymatch', [
            'mymatch' => "Hasła nie są takie same",
        ]);
        $validation->setRule('level', 'Uprawnienia', 'trim|required');
        if (!$validation->run($_POST)) {
            $dane["acl__pages_p_items"] = $this->pages_p_model->where("parent_id", 0)->findAll();
            $dane["acl__pages_items"]   = $this->pages_model->where("parent_id", 0)->findAll();
            $dane["acl_items"]          = $this->page_config->acl_items;
            $dane["user"]               = $this->user_model->find($this->request->getPost("id"));
            $dane["validation"]         = $validation;
            $dane["ses"]                = $this->ses;
            $panel_body                 = view("panel/users/users_edit", $dane);
            $dane["panel_body"]         = $panel_body;
            echo view('panel/panel_theme', $dane);
            // return redirect()->to(base_url().'/panel/users');

        } else {
            $encryption = new \Config\Encryption();
            if ($this->request->getPost("id") == 1) {
                $level = 0;
            } else {
                $level = $this->request->getPost("level");
            }
//taki usmieszek:)
            if ($this->request->getPost("password") != "") {
                if ($this->request->getPost("id") != 1) {
                    $this->user_model->update($this->request->getPost("id"), array(
                        "nick"     => $this->request->getPost("nick"),
                        "name"     => $this->request->getPost("name"),
                        "password" => password_hash($encryption->key . $this->request->getPost("password"),PASSWORD_BCRYPT),
                        "level"    => $level,
                        "email"    => $this->request->getPost("email"),
                    ));

                    $this->acl_model->where("user_id", $this->request->getPost("id"))->delete();
                    if ($this->request->getPost("acl")) {
                        foreach ($this->request->getPost("acl") as $item) {
                            $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => $item));
                        }
                    }
                    if ($this->request->getPost("pages_p")) {
                        foreach ($this->request->getPost("pages_p") as $item) {
                            $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => "p_" . $item));
                        }
                    }
                    if ($this->request->getPost("pages")) {
                        foreach ($this->request->getPost("pages") as $item) {
                            $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => "p0_" . $item));
                        }
                    }
                }
            } else {

                $this->user_model->update($this->request->getPost("id"), array(
                    "nick"  => $this->request->getPost("nick",FILTER_SANITIZE_STRING),
                    "name"  => $this->request->getPost("name",FILTER_SANITIZE_STRING),
                    "level" => $level,
                    "email" => $this->request->getPost("email",FILTER_SANITIZE_EMAIL),
                ));

                $this->acl_model->where("user_id", $this->request->getPost("id"))->delete();
                if ($this->request->getPost("acl")) {
                    foreach ($this->request->getPost("acl") as $item) {
                        $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => $item));
                    }
                }
                if ($this->request->getPost("pages_p")) {
                    foreach ($this->request->getPost("pages_p") as $item) {
                        $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => "p_" . $item));
                    }
                }
                if ($this->request->getPost("pages")) {
                    foreach ($this->request->getPost("pages") as $item) {
                        $this->acl_model->insert(array("user_id" => $this->request->getPost("id"), "acl_name" => "p0_" . $item));
                    }
                }
            }
            log_cms("Edycja użytkownika: " . $this->request->getPost("nick"));
            return redirect()->to(base_url() . '/panel/users');
        }

    }

    public function delete($id)
    {
        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

        if ($id == 1) {
            return redirect()->to(base_url() . '/panel/users');
        }
        $u = $this->user_model->find($id);
        log_cms("Usunięcie użytkownika: " . $u->nick);
        $this->user_model->delete($id);
        return redirect()->to(base_url() . '/panel/users');
    }

}
