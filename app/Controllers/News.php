<?php /**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:59
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers;

class News extends BaseController
{

    public function __construct(){
        $this->slider_model  = new \App\Models\Slider_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        $this->news_model    = new \App\Models\News_model();
        $this->menu_model    = new \App\Models\Menu_model();
        $this->zmienne_model = new \App\Models\Zmienne_model();
        $this->site_config   = new \App\Libraries\Site_config();
        helper("page_helper");
    }

    public function news($id)
    {
        
        $dane                = array('fb'=>[]);
        $dane["active_menu"] = 1;

        $dane["news"] = $this->news_model->find($id);
        $dane["fb"]["title"] = $dane["title"] = $dane["news"]->title . " - Prosty CMS";

        if (!$dane["news"]) {
            return redirect()->to(base_url() . "/error");
        }
        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages_p"]         = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]  = true;
        $dane["page_body"]       = view("news/news_index", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function all()
    {
       
        $dane                = [];
        $dane["active_menu"] = 1;
        $dane["news"]        = $this->news_model->where("published", '1')->where("mainpage", '1')->orderBy("id", "DESC")->paginate(10);
        $dane["pager"]       = $this->news_model->pager;
        $dane["fb"]["title"] = $dane["title"] = "Aktualności - Prosty CMS";

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->where("newsletter", '1')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        $dane["cat"]             = -1;
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages_p"]         = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]  = true;
        $dane["page_body"]       = view("news/news_all", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function category($category)
    {
       
        $dane                = [];
        $dane["active_menu"] = 1;
        $dane["news"]        = $this->news_model->orderBy("id", "DESC")->where("category", $category)->paginate(10);
        $dane["pager"]       = $this->news_model->pager;
        $dane["fb"]["title"] = $dane["title"] = "Aktualności - Prosty CMS";

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();
        $dane["cat"]         = $category;
        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories
        $dane["categories"] = $dane["page_config"]->categories;
        foreach ($this->pages_p_model->where("parent_id", '0')->where("newsletter", '1')->findAll() as $item) {
            $dane["categories"][$item->id * 100] = $item->title;
        }
        if (!$dane["categories"][$category]) {
            return redirect()->to(base_url() . "/error");
        }
        $dane["category"]        = $dane["categories"][$category];
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages_p"]         = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]  = true;
        $dane["page_body"]       = view("news/news_category", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    //--------------------------------------------------------------------

}