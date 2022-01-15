<?php /**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:58
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        $this->slider_model  = new \App\Models\Slider_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        $this->news_model    = new \App\Models\News_model();
        $this->menu_model    = new \App\Models\Menu_model();
        $this->zmienne_model = new \App\Models\Zmienne_model();
        $this->site_config   = new \App\Libraries\Site_config();
        helper("page_helper");
    }

    public function index()
    {

        $dane                = [];
        $dane["active_menu"] = 1;
        //$this->site_config->routes_generate();
        for ($i = 1; $i <= 4; $i++) {
            $pieciakat            = $this->zmienne_model->zmienna("pieciokat" . $i);
            $dane["pieciokaty"][] = (object) json_decode($pieciakat);
        }
        for ($i = 1; $i <= 4; $i++) {
            $licznik                         = $this->zmienne_model->zmienna("licznik" . $i);
            $dane["licznik"]["licznik" . $i] = $licznik;
        }
        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();
        $dane["news"]        = $this->news_model->where('published', '1')->where('mainpage', '1')->orderBy('id', 'desc')->findAll(4);

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $dane["title"]                    = "Prosty CMS";
        $dane["text_startup"]             = $this->zmienne_model->zmienna("text_startup");
        $dane["text_sponsorzy"]           = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_slider"]              = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"]          = view("eskwela/page_left_boxes", $dane);
        $dane["page_footer"]              = view("eskwela/page_footer", $dane);
        $dane["pages_p"]                  = $this->pages_p_model->orderBy("pozycja", "ASC")->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]           = true;
        $dane["show_pages_p_down"]        = true;
        $dane["page_strony_przedmiotowe"] = view("eskwela/page_strony_przedmiotowe", $dane);
        $dane["page_body"]                = view("eskwela/page_main", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function error()
    {
        $dane                = [];
        $dane["active_menu"] = 1;
        $dane["pager"]       = $this->news_model->pager;
        $dane["fb"]["title"] = $dane["title"] = "404 Nie znaleziono - Prosty CMS";

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);
        header("HTTP/1.0 404 Not Found");
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["show_news_down"]  = false;
        $dane["page_body"]       = view("eskwela/page_error", $dane);
        echo view('eskwela/page_theme', $dane);
    }
    //--------------------------------------------------------------------

}
