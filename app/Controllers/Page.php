<?php /**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:58
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers;

class Page extends BaseController
{

    public function __construct()
    {
        $this->slider_model         = new \App\Models\Slider_model();
        $this->pages_p_model        = new \App\Models\Pages_p_model();
        $this->pages_model          = new \App\Models\Pages_model();
        $this->pages_addlinks_model = new \App\Models\Pages_addlinks_model();
        $this->news_model           = new \App\Models\News_model();
        $this->menu_model           = new \App\Models\Menu_model();
        $this->zmienne_model        = new \App\Models\Zmienne_model();
        $this->site_config          = new \App\Libraries\Site_config();
        helper("page_helper");
    }
    public function page($id)
    {
        $dane = [];

        //page
        $dane["page"] = $this->pages_model->find($id);
        if (!$dane["page"]) {
            return redirect()->to(base_url() . "/error");
        }

        $dane["active_menu"] = 2;

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();
        //page_submenu
        if ($dane["page"]->parent_id == 0) {
            $dane["page_menu"]    = $this->site_config->prepare_page_menu($id, $id);
            $dane["page_submenu"] = [];
            $dane["parent_page"]  = $this->pages_model->find($dane["page"]->parent_id);
        } else {
            $dane["page_menu"]    = $this->site_config->prepare_page_menu($dane["page"]->parent_id, $id);
            $dane["page_submenu"] = $this->site_config->prepare_page_menu($id, $id, true);
            $dane["parent_page"]  = $this->pages_model->find($dane["page"]->parent_id);
            $dane["parent_page"]  = $this->pages_model->find($dane["parent_page"]->parent_id);
        }
        $menu_item = $this->menu_model->where("name", $dane["page"]->title)->findAll();
        if ($menu_item) {
            $dane["active_menu"] = $menu_item[0]->id;
        }

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu, $dane["active_menu"]);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $dane["fb"]["title"]     = $dane["title"]     = $dane["page"]->title . " - Prosty CMS";
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages_p"]         = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]  = false;
        $dane["page_body"]       = view("pages/pages_index", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function page_p($id)
    {
      
              $dane                   = [];
        $this->site_config->url = "page_p";

        //page
        $dane["page"] = $this->pages_model->find($id);
        if (!$dane["page"]) {
            return redirect()->to(base_url() . "/error");
        }

        $dane["active_menu"] = 2;

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();
        //page_submenu
        if ($dane["page"]->parent_id == 0) {
            $dane["page_menu"]    = $this->site_config->prepare_page_menu($id, $id);
            $dane["page_submenu"] = [];
            $dane["parent_page"]  = $this->pages_model->find($dane["page"]->parent_id);
        } else {
            $dane["page_menu"]    = $this->site_config->prepare_page_menu($dane["page"]->parent_id, $id);
            $dane["page_submenu"] = $this->site_config->prepare_page_menu($id, $id, true);
            $dane["parent_page"]  = $this->pages_model->find($dane["page"]->parent_id);
            $dane["parent_page"]  = $this->pages_model->find($dane["parent_page"]->parent_id);
        }
        $menu_item = $this->menu_model->where("name", $dane["page"]->title)->findAll();
        if ($menu_item) {
            $dane["active_menu"] = $menu_item[0]->id;
        }

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu, $dane["active_menu"]);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $dane["fb"]["title"]     = $dane["title"]     = $dane["page"]->title . " - Prosty CMS";
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages"]           = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["news"]            = $this->news_model->orderBy("id", "DESC")->where("published", '1')->where("category", $id * 100)->findAll();
        $dane["show_news_down"]  = true;
        $dane["page_body"]       = view("pages/pages_p_index", $dane);
        echo view('eskwela/page_theme', $dane);
    }
    //--------------------------------------------------------------------

}