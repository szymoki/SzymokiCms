<?php /**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:58
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

class Panel extends \App\Controllers\BaseController
{

    public function __construct()
    {
        $this->model   = new \App\Models\User_model();
        $this->session = \Config\Services::session();
        helper("acl");
        helper("log");
    }
    public function login()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to(base_url() . '/panel/admin');
        } else {
            $validation         = \Config\Services::validation();
            $dane["validation"] = $validation;
            echo view('panel/panel_login', $dane);
        }
    }

    public function admin()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to(base_url() . '/panel/login');
        }
        $this->log_model = new \App\Models\Log_model();
        $dane["logs"]    = "";
        foreach ($this->log_model->orderBy("id", "DESC")->findAll(50) as $item) {
            $dane["logs"] .= "\n" . $item->date . " " . get_user_name($item->user_id) . " - " . $item->log;
        }

        $dane["ses"]                = $this->session->get('logged_in');
        $site_statics_today         = 0; //$this->vm->get_site_data_for_today();
        $site_statics_last_week     = 0; //$this->vm->get_site_data_for_last_week();
        $dane['visits_today']       = isset($site_statics_today['visits']) ? $site_statics_today['visits'] : 0;
        $dane['visits_last_week']   = isset($site_statics_last_week['visits']) ? $site_statics_last_week['visits'] : 0;
        $dane['visits_chart_today'] = []; // $this->vm->get_chart_data_for_today();
        $dane['visits_chart_month'] = []; //$this->vm->get_chart_data_for_month_year();
        $panel_body                 = view("panel/panel_view", $dane);
        $dane["panel_body"]         = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function verify()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to(base_url() . '/panel/login');
        }

        $rules = [
            'check_database' => "Login lub hasło jest nieprawidłowe",
        ];
        $validation = \Config\Services::validation();
        $validation->setRule('username', 'Username', 'trim|required');
        $validation->setRule('password', 'Password', 'trim|required|check_database', $rules);
        //print_r($this->request->getPost());
        if (!$validation->run($_POST)) {
            $dane["validation"] = $validation;
            echo view('panel/panel_login', $dane);

        } else {
            log_cms("Zalogowano się");
            return redirect()->to(base_url() . '/panel/admin');
        }
    }

    public function logout()
    {
        $this->session->remove('logged_in');
        return redirect()->to(base_url() . '/panel/login');
    }

    public function profil()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to(base_url() . '/panel/login');
        }
        $dane["ses"]        = $this->session->get('logged_in');
        $dane["name"]       = $dane["ses"]["name"];
        $validation         = \Config\Services::validation();
        $dane["validation"] = $validation;
        $dane["alert"]      = false;
        $panel_body         = view("panel/panel_profil", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function pass_change()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to(base_url() . '/panel/login');
        }
        $validation = \Config\Services::validation();
        $validation->setRule('old', 'Stare hasło', 'trim|pass_check', [
            'pass_check' => "Stare hasło jest nieprawidłowe",
        ]);
        $validation->setRule('new', 'Nowe hasło', 'trim');
        $validation->setRule('new2', 'Powtórz hasło', 'trim|matches[new]');
        $dane["validation"] = $validation;
        $ses                = $this->session->get('logged_in');
        if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page

            $dane["name"]       = $ses["name"];
            $dane["ses"]        = $ses;
            $dane["alert"]      = true;
            $datta["username"]  = "";
            $panel_body         = view("panel/panel_profil", $dane);
            $dane["panel_body"] = $panel_body;
            echo view('panel/panel_theme', $dane);
        } else {
            log_cms("Zmiana hasła");
            $encryption = new \Config\Encryption();
            $this->model->update($ses["id"], array("password" => password_hash($encryption->key . $this->request->getPost("new"), PASSWORD_BCRYPT)));
            return redirect()->to(base_url() . '/panel/profil');
        }
    }
}
