<?php
/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:16:07
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

/**
 * Description of panel
 *
 * @author szymon
 */
class Szablon extends PanelController
{

    public function __construct()
    {
        $this->session       = \Config\Services::session();
        $this->ses           = $this->session->get("logged_in");
        $this->zmienne_model = new \App\Models\Zmienne_model();
        $this->acl_model     = new \App\Models\Acl_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        helper("acl");
        helper("log");
        $this->page_config = new \Config\Page();
    }

    public function index()
    {
        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["zmienne"]    = $this->zmienne_model->getAll();
        $dane["pieciokaty"] = [];
        for ($i = 1; $i <= 4; $i++) {
            $pieciakat = $this->zmienne_model->zmienna("pieciokat" . $i);
            //       echo $pieciakat;

            $dane["pieciokaty"][] = (object) json_decode($pieciakat);
        }
        $panel_body         = view("panel/szablon/szablon_view", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function pieciokat_edit($id)
    {

        $dane["ses"]        = $this->ses;
        $dane["alert"]      = false;
        $dane["icons"]      = array("books", "professor", "book", "diploma");
        $dane["pieciokat"]  = (object) json_decode($this->zmienne_model->zmienna("pieciokat" . $id));
        $dane["id"]         = $id;
        $panel_body         = view("panel/szablon/pieciokat_edit", $dane);
        $dane["panel_body"] = $panel_body;
        echo view('panel/panel_theme', $dane);
    }

    public function save()
    {
        $this->zmienne_model->zmienna_set("text_startup", $this->request->getPost("text_startup"));
        $this->zmienne_model->zmienna_set("text_sponsorzy", $this->request->getPost("text_sponsorzy"));
        $this->zmienne_model->zmienna_set("licznik1", $this->request->getPost("licznik1",FILTER_SANITIZE_STRING));
        $this->zmienne_model->zmienna_set("licznik2", $this->request->getPost("licznik2",FILTER_SANITIZE_STRING));
        $this->zmienne_model->zmienna_set("licznik3", $this->request->getPost("licznik3",FILTER_SANITIZE_STRING));
        $this->zmienne_model->zmienna_set("licznik4", $this->request->getPost("licznik4",FILTER_SANITIZE_STRING));
        $this->zmienne_model->zmienna_set("licznik4", $this->request->getPost("licznik4",FILTER_SANITIZE_STRING));
        $this->zmienne_model->zmienna_set("uczniowie_on", $this->request->getPost("uczniowie_on"));
        $this->zmienne_model->zmienna_set("licznik_on", $this->request->getPost("licznik_on"));
        $this->zmienne_model->zmienna_set("boxy_on", $this->request->getPost("boxy_on"));
        log_cms("Edycja danych szablonu");
        return redirect()->to(base_url() . '/panel/szablon');
    }
    public function save_p()
    {
        if (is_numeric($this->request->getPost("id"))) {
            $zmienna = json_encode(array("title" => $this->request->getPost("title"), "url" => $this->request->getPost("url"), "icon" => $this->request->getPost("icon"), "text" => $this->request->getPost("text")));
            $this->zmienne_model->zmienna_set("pieciokat" . $this->request->getPost("id"), $zmienna);
        }
        log_cms("Edycja sześciokąta " . $this->request->getPost("title"));
        return redirect()->to(base_url() . '/panel/szablon');
    }

}
