<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-03 14:37:43
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
class Pliki extends PanelController
{
    public function __construct()
    {

        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->user_model    = new \App\Models\User_model();
        $this->acl_model     = new \App\Models\Acl_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        helper("acl");
        $this->page_config = new \Config\Page();

        if ($this->ses["level"] != 0) {
            return redirect()->to(base_url("panel/admin"));
        }

    }
    public function index()
    {
        $dane["s"]          = "s";
        $dane["ses"]        = $this->ses;
        $panel_body         = view("panel/pliki/pliki_view", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }
}
