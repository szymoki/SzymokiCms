<?php /**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:20:58
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers;

class Galeria extends BaseController
{
    public $dir = FCPATH . 'upload_media/gallery';
    public $url = "/upload_media/gallery";

    public function __construct()
    {
        $this->slider_model  = new \App\Models\Slider_model();
        $this->pages_p_model = new \App\Models\Pages_p_model();
        $this->news_model    = new \App\Models\News_model();
        $this->menu_model    = new \App\Models\Menu_model();
        $this->zmienne_model = new \App\Models\Zmienne_model();
        $this->gallery_model = new \App\Models\Gallery_model();
        $this->site_config   = new \App\Libraries\Site_config();
        helper("page_helper");
    }
    public function index()
    {

        $dane                = [];
        $dane["active_menu"] = 1;
        $dane["albumy"]      = $this->gallery_model->where("published", '1')->orderBy("pozycja")->paginate(10);
        $dane["pager"]       = $this->gallery_model->pager;
        $dane["fb"]["title"] = $dane["title"] = "Galeria - Prosty CMS";

        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories
        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["show_news_down"]  = false;
        $dane["page_body"]       = view("gallery/gallery_view", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function album($id)
    {

        $dane                = [];
        $dane["active_menu"] = 1;

        $album               = $this->gallery_model->find($id);
        $dane["fb"]["title"] = $dane["title"] = $album->title . " - Prosty CMS";
        if (!$album) {
            return redirect()->to(base_url() . "/error");
        }

        $scan   = scandir($this->dir . "/" . $album->folder);
        $images = [];
        unset($scan[0]);
        unset($scan[1]);
        foreach ($scan as $key => $item) {
            if (is_dir($this->dir . "/" . $item)) {
                unset($scan[$key]);
            } else {
                $images[] = base_url($this->url . "/" . $album->folder . "/" . $item);
            }

        }
        //    print_r($images);
        $dane["zdjecia"]     = $images;
        $dane["album"]       = $album;
        $dane["page_config"] = new \Config\Page();
        $dane["slider"]      = $this->slider_model->where('active', '1')->findAll();

        //menu
        $menu         = $this->menu_model->where("active", "1")->orderBy("pozycja", "ASC")->findAll();
        $dane["menu"] = prepare_menu($menu);

        //categories

        $dane["page_slider"]     = view("eskwela/page_slider", $dane);
        $dane["page_left_boxes"] = view("eskwela/page_left_boxes", $dane);
        $dane["text_sponsorzy"]  = $this->zmienne_model->zmienna("text_sponsorzy");
        $dane["page_footer"]     = view("eskwela/page_footer", $dane);
        $dane["pages_p"]         = $this->pages_p_model->where("parent_id", '0')->where("published", '1')->where("menushow", '1')->findAll();
        $dane["show_news_down"]  = false;
        $dane["page_body"]       = view("gallery/gallery_album", $dane);
        echo view('eskwela/page_theme', $dane);
    }

    public function get_thumb($id)
    {
        $this->gallery_model = new \App\Models\Gallery_model();
        $album               = $this->gallery_model->find($id);
        $scan                = scandir($this->dir . "/" . $album->folder);

        unset($scan[0]);
        unset($scan[1]);
        foreach ($scan as $key => $item) {
            if (is_dir($this->dir . "/" . $item)) {
                unset($scan[$key]);
            }

        }
        $scan = array_values($scan);
        if (count($scan) != 0) {
            $filename       = basename($this->dir . "/" . $album->folder . "/" . $scan[0]);
            $file_extension = strtolower(substr(strrchr($filename, "."), 1));

            switch ($file_extension) {
                case "gif":$ctype = "image/gif";
                    break;
                case "png":$ctype = "image/png";
                    break;
                case "jpeg":$ctype = "image/jpeg";
                    break;
                case "jpg":$ctype = "image/jpeg";
                    break;
                case "svg":$ctype = "image/svg+xml";
                    break;
                default:
            }

            header('Content-type: ' . $ctype);

            readfile($this->dir . "/" . $album->folder . "/" . $scan[0]);
        }
    }

}
