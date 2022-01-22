<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:24:21
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Libraries;

/**
 * Description of Site_Config
 *
 * @author https://roytuts.com
 */
class Site_Config {


    function __construct() {
    }

    public $url="page";
        /**
     * dynamically generate year dropdown
     * @param int $startYear start year
     * @param int $endYear end year
     * @param string $id id of the select-option
     * @return html
     */
        function generate_years($id = 'year', $startYear = '', $endYear = '') {
            $startYear = (strlen(trim($startYear)) ? $startYear : date('Y') - 10);
            $endYear = (strlen(trim($endYear)) ? $endYear : date('Y'));

            if (!$this->holds_int($startYear) || !$this->holds_int($endYear)) {
                return 'Year must be integer value!';
            }

            if ((strlen(trim($startYear)) < 4) || (strlen(trim($endYear)) < 4)) {
                return 'Year must be 4 digits in length!';
            }

            if (trim($startYear) > trim($endYear)) {
                return 'Start Year cannot be greater than End Year!';
            }

        //start the select tag
            $html = '<select id="' . $id . '" name="' . $id . '">"n"';
            $html .= '<option value="">-- Year --</option>"n"';
        //echo each year as an option    
            for ($i = $endYear; $i >= $startYear; $i--) {
                $html .= '<option value="' . $i . '">' . $i . '</option>"n"';
            }
        //close the select tag
            $html .= "</select>";

            return $html;
        }

    /**
     * dynamically generate months dropdown
     * @param string $id id of the select-option
     * @return html
     */
    function generate_months($id = 'month') {
        //start the select tag
        $html = '<select id="' . $id . '" name="' . $id . '">"n"';
        $html .= '<option value="">-- Month --</option>"n"';
        //echo each month as an option    
        for ($i = 1; $i <= 12; $i++) {
            $timestamp = mktime(0, 0, 0, $i);
            $label = date("F", $timestamp);
            $html .= '<option value="' . $i . '">' . $label . '</option>"n"';
        }
        //close the select tag
        $html .= "</select>";

        return $html;
    }

    private function holds_int($str) {
        return preg_match("/^[1-9][0-9]*$/", $str);
    }


   


    function get_user_name($id){
        $this->CI->load->model("user_model");
        $u = $this->CI->user_model->get($id);
        return $u->name;
    }


    function zmienna($name){

        $z=$this->zmienne_model->get_by("name",$name);
        if($z)
            return $z->value;
        else return false;
        
    }
    function zmienna_set($name,$value){
        $z=$this->CI->zmienne_model->update_by(array("name"=>$name),array("value"=>$value));
        return $z;
        
    }

    function prepare_page_menu($main_page_id,$current_page,$unset=false){
        if($this->url=="page_p"){
            $this->pages_model= new \App\Models\Pages_p_model();
           // echo "page_p";
        }
            else{
            $this->pages_model= new \App\Models\Pages_model();
           // echo "page";
        }
        $this->pages_addlinks_model= new \App\Models\Pages_addlinks_model();
        helper("page");
        $menu =[];
        $first_page=$this->pages_model->find($main_page_id);
        //print_r($first_page);
        $main_page=$this->pages_addlinks_model->where("page_id",$main_page_id)->findAll();
        if($this->url=="page") $ptype=0; else $ptype=1;
        //print_r($main_page);
        $active=0;
        //echo $current_page;
        if($main_page_id==$current_page) $active=1;
        if(!$unset){
            $menu[]=(object)array("title"=>$first_page->title,"id"=>$first_page->id,"url"=>generate_page_url($first_page,$ptype),"active"=>$active,"childs"=>[]);
        }
      //  $children=$this->CI->pages_model->get_many_by(array("parent_id"=>$main_page_id,"published"=>1));
        $children=$this->pages_addlinks_model->orderBy("position","ASC")->where("parent_id",$main_page_id)->where("page_type",$ptype)->findAll();
      //  $children = (object) array_merge( 
       // (array) $children, (array) $links); 

        foreach($children as $item){
            $childs=[];


            $active=0;
            if($item->page_id==$current_page) $active=1;
            $menu[]= (object)array("title"=>$item->title,"id"=>$item->id,"url"=>generate_page_url($item,$ptype),"active"=>$active,"childs"=>$childs);
        }
      // / print_r($menu);
        return  $menu;
    }



    function news($content){
        $dot = "<hr>";

    $position = stripos ($content, $dot); //find first dot position

    if($position) { //if there's a dot in our soruce text do
        $offset = $position; //prepare offset
        $first_two = substr($content, 0, $offset); //put two first sentences under $first_two

        return $first_two . ''; //add a dot
    }

    else {  //if there are no dots
        return $content;
    }
}
function read_many($content){
    $dot = "<hr>";

    $position = stripos ($content, $dot); //find first dot position

    if($position) return true; else return false;
}


public function routes_generate(){
    $routes=[];
    $this->pages_p_model = new \App\Models\Pages_p_model();
    $this->pages_model = new \App\Models\Pages_model();

    $pages=$this->pages_model->where("published","1")->findAll();
    foreach($pages as $page){
        if($page->symlink!=""){
            $routes[preg_replace("/[^A-Za-z0-9.!?]/",'',strtolower($page->symlink))]="Page::page/".$page->id;
        }
    }

    $pages_p=$this->pages_p_model->where("published","1")->findAll();
    foreach($pages_p as $page){
        if($page->symlink!=""){
            $routes[preg_replace("/[^A-Za-z0-9.!?]/",'',strtolower($page->symlink))]="Page::page_p/".$page->id;
        }
    }

    $this->_save_temp_route($routes);



}

private function _save_temp_route($routes){
    $output='<'.'?'.'php'.''."\n";

    foreach($routes as $key=>$item){
        $output.='$routes->add(\''.$key.'\',\''.$item.'\');'."\n";
    }

    helper("filesystem");
    write_file(APPPATH."Routes/100_autogenerate.php",$output);
}



function acl($name = NULL) {

    $ses = $this->CI->session->userdata("logged_in");
    if ($ses["level"] == 0)
        return true;
    if (!isset($name))
        $str = str_replace("/", "-", substr($this->CI->uri->ruri_string(), 1));
    else
        $str = $name;

    $this->CI->load->model("acl_model");
        $str = str_replace(" ", '', $str); //wywalanie spacji wrazie cos;
//jesli jest dostęp zwraca true jak nie ma to false
        $acl_base=$this->CI->acl_model->get_by(array("user_id"=>$ses["id"],"acl_name"=>$name));
        if ($acl_base)
            return true;
        
        else
           return false;
   }
   function acl_user($name = NULL,$user) {

    if (!isset($name))
        $str = str_replace("/", "-", substr($this->CI->uri->ruri_string(), 1));
    else
        $str = $name;

    $this->CI->load->model("acl_model");
        $str = str_replace(" ", '', $str); //wywalanie spacji wrazie cos;
//jesli jest dostęp zwraca true jak nie ma to false
        $acl_base=$this->CI->acl_model->get_many_by(array("user_id"=>$user,"acl_name"=>$name));
        if (count($acl_base)!=0)
            return true;
        
        else
           return false;
   }

}

/* End of file Site_Config.php */
/* Location: ./application/libraries/Site_Config.php */