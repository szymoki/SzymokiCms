<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   Szymon Haczyk
 * @Last Modified time: 2020-05-03 14:46:56
 * @email: szymon.haczyk@icloud.com
 */
function generate_page_url($link,$ptype=0){
    if($ptype==0) $url="page"; else $url="page_p";
    if(isset($link->page_id)){
        if($link->page_id==0) return $link->url;
        if($ptype==1)
            $pages_model= new \App\Models\Pages_p_model();
        else
            $pages_model= new \App\Models\Pages_model();
        $page=$pages_model->find($link->page_id);
    } else $page=$link;



    if($page->symlink=="") return $url."/".$page->id;
    else return strtolower($page->symlink);
}

function generate_page_url2($page,$ptype=0){
    if($ptype==0) $url="page"; else $url="page_p";

    if($page->symlink=="") return $url."/".$page->id;
    else return strtolower($page->symlink);
}
   function news($content){
        $dot = "<hr />";
      // /  echo "<!--.".$content.".-->";
        $news=explode($dot,$content);
        $content=$news[0];


        return $content;
    
}
function read_many($content){
    $dot = "<hr />";

    $position = stripos ($content, $dot); //find first dot position

    if($position) return true; else return false;
}

function zmienna(){
	return "";
}

function prepare_menu($menu,$aid=0){
    foreach($menu as $k=>$item){
        $menu[$k]->hasChildren=0;
        if(!isset($menu[$k]->selected)) $menu[$k]->selected=0;
        if($item->parent_id==0){
            foreach($menu as $item2){
                if($item2->parent_id!=0 and $item->id==$item2->parent_id){
                    $menu[$k]->hasChildren=1;
                    if($aid==$item2->id) $menu[$k]->selected=1;
                    $menu[$k]->children[]=$item2;
                }else{

                }
            }
        }
    }
    foreach($menu as $k=>$item){
        if($item->parent_id!=0){
            unset($menu[$k]);
        }
    }
   //    print_r($menu);
    return $menu;
}