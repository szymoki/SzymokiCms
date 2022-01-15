<?php
/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-08 15:04:35
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Controllers\Panel;

class Gallery extends PanelController {
	public $dir    = FCPATH.'upload_media/gallery';

	function __construct() {
		$this->session = \Config\Services::session();
		$this->ses=$this->session->get("logged_in");
		$this->gallery_model = new \App\Models\Gallery_model();
		$this->acl_model = new \App\Models\Acl_model();
		$this->pages_p_model = new \App\Models\Pages_p_model();
		helper("acl");
		helper("log");
		$this->page_config=new \Config\Page();
	}

	public function index(){

		$dane["ses"]=$this->ses;
		$dane["gallery"]=$this->gallery_model->orderBy("pozycja")->findAll();
		$panel_body=view("panel/gallery/gallery_index",$dane);
		$dane["panel_body"]=$panel_body;
		echo view('panel/panel_theme', $dane);
	}

	public function add(){

		$scan = scandir($this->dir);
		unset($scan[0]);
		unset($scan[1]);
		foreach($scan as $id=>$item){
			if(!is_dir($this->dir."/".$item)) unset($scan[$id]);
		}
		$dane["foldery"]=$scan;
		$dane["ses"]=$this->ses;
		$dane["alert"]=false;
		$dane["gallery"]=$this->gallery_model->findAll();
		$panel_body=view("panel/gallery/gallery_add",$dane);
		$dane["panel_body"]=$panel_body;
		echo view('panel/panel_theme', $dane);
	}

	public function edit($id){

		$scan = scandir($this->dir);
		unset($scan[0]);
		unset($scan[1]);
		foreach($scan as $key=>$item){
			if(!is_dir($this->dir."/".$item)) unset($scan[$key]);
		}

		$dane["ses"]=$this->ses;
		$dane["alert"]=false;
		$dane["foldery"]=$scan;

		$dane["album"]=$this->gallery_model->find($id);
		$panel_body=view("panel/gallery/gallery_edit",$dane);
		$dane["panel_body"]=$panel_body;
		echo view('panel/panel_theme', $dane);
	}


	public function addu(){

		$validation =  \Config\Services::validation();
		$validation->setRule('title', 'nazwa', 'trim|required');
		$validation->setRule('text', 'Url', 'trim');
		$validation->setRule('folder', 'Url', 'trim|required');
		if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
			$dane["alert"] = true;
			
			$dane["ses"]=$this->ses;
			$panel_body=view("panel/gallery/gallery_add",$dane);
			$dane["panel_body"]=$panel_body;
			echo view('panel/panel_theme', $dane);
		} else {

			if($this->request->getPost("folder")!="new"){ 
				$folder=$this->request->getPost("folder");

			}
			else{
				$folder=substr($this->_minifyname($this->request->getPost("title")),0,12)."_".time();
				mkdir($this->dir."/".$folder);
			}
			$galerry_id=$this->gallery_model->insert(array(
				"title"=>$this->request->getPost("title"),
				"text"=>$this->request->getPost("text"),
				"folder"=>$folder,
				"published"=>$this->request->getPost("published"),
				"added_by"=>$this->ses["id"],
				"added_date"=>date("Y-m-d H:i:s"),
				"edited_date"=>date("Y-m-d H:i:s"),

			));
			log_cms("Dodanie albumu: ".$galerry_id. "/".$this->request->getPost("title"));
			return redirect()->to(base_url().'/panel/gallery');
		}

	}

	public function editu(){

		$validation =  \Config\Services::validation();
		$validation->setRule('title', 'nazwa', 'trim|required');
		$validation->setRule('text', 'Url', 'trim');
		$validation->setRule('folder', 'Url', 'trim|required');
		if (!$validation->run($_POST)) {
            //Field validation failed.  User redirected to login page
			$dane["alert"] = true;

			$dane["ses"]=$this->ses;
			$panel_body=view("panel/gallery/gallery_add",$dane);
			$dane["panel_body"]=$panel_body;
			echo view('panel/panel_theme', $dane);
		} else {
			if($this->request->getPost("folder")!="new") $folder=$this->request->getPost("folder");
			else{
				$folder=substr($this->_minifyname($this->request->getPost("title")),0,12)."_".time();
				mkdir($this->dir."/".$folder); 	
			}
			$this->gallery_model->update($this->request->getPost("id"),array(
				"title"=>$this->request->getPost("title"),
				"text"=>$this->request->getPost("text"),
				"folder"=>$folder,
				"published"=>$this->request->getPost("published"),
				"edited_date"=>date("Y-m-d H:i:s"),

			));
			log_cms("Edycja albumu: ".$this->request->getPost("id"). "/".$this->request->getPost("title"));
			return redirect()->to(base_url().'/panel/gallery');
		}

	}

	public function del($id){
		$g=$this->gallery_model->find($id);
		log_cms("Usunięcie albumu ".$id."/".$g->title);
		$this->gallery_model->delete($id);
		return redirect()->to(base_url().'/panel/gallery');
	}

	private function _minifyname($alias){
		$alias = strtolower($alias);
		$alias = str_replace(' ', '-', $alias);
		$alias = preg_replace('/[^0-9a-ąćęłńóśźż\-]+/', '', $alias);

		$alias = preg_replace('/[\-]+/', '-', $alias);
		$alias= trim($alias,'-');
		$alias = str_replace(array('ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż'), array('a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z'), $alias);
		$alias = str_replace(array(',', ':', ';', ' '), array('', '', '', '-'), $alias);
		$alias = strtr($alias, ' ','-');

		return $alias;
	}

		public function setposition(){
		if(!acl("gallery")) return redirect()->to(base_url("panel/admin"));

		$pozycje=$this->request->getPost("positions");
		foreach($pozycje as $key=>$item){
			$this->gallery_model->update($item,array(
				"pozycja"=>$key,
			));
		}
	}


}
