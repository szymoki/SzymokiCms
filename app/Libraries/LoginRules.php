<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:58
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Libraries;

class LoginRules
{

    public function check_database($password)
    {
        $this->session = \Config\Services::session();
        $request       = \Config\Services::request();
        //Field validation succeeded.  Validate against database
        $this->model = new \App\Models\User_model();
        $username    = strip_tags($_POST["username"]);

        //query the database
        $result = $this->model->where("nick", $username)->find();

        if ($result) {
            $result     = $result[0];
            $encryption = new \Config\Encryption();
            if (password_verify($encryption->key . $password, $result->password)) {
                //print_r($result);
                $sess_array = [];

                $sess_array = array(
                    'id'    => $result->id,
                    'nick'  => $result->nick,
                    'name'  => $result->name,
                    'level' => $result->level,
                );

                $this->model->update($result->id, array("last_ip" => $request->getIPAddress(),
                    "last_login"                                      => date("Y-m-d H:i:s")));
                $this->session->set('logged_in', $sess_array);
                return true;
            } else {
                //  $this->form_validation->set_message('check_database', 'Złe hasło lub login');

                return false;
            }
        } else {
            //  $this->form_validation->set_message('check_database', 'Taki użytkownik nie istnieje');

            return false;
        }
    }

    public function mymatch($password)
    {
        $request = \Config\Services::request();
        if ($request->getPost("password") != "") {
            if ($request->getPost("password") == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }

    }

    public function pass_check($old)
    {
        $this->session = \Config\Services::session();
        $request       = \Config\Services::request();
        //Field validation succeeded.  Validate against database
        $this->model = new \App\Models\User_model();
        $ses         = $this->session->get("logged_in");
        $encryption  = new \Config\Encryption();
        $result      = $this->model->find($ses["id"]);
        if ($result->password == sha1($encryption->key . $old)) {
            return true;
        } else {
            return false;
        }
    }
}
