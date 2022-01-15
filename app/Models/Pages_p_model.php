<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   Szymon Haczyk
 * @Last Modified time: 2020-05-03 14:45:43
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;
use CodeIgniter\Model;



class Pages_p_model extends Model {
	public $table = 'pages_przedmioty';
	protected $returnType = 'object';
	protected $primaryKey = 'id';
	protected $allowedFields = ['title', 'text', 'published', 'category', 'create_by', 'create_date', 'edited_by', 'edited_date', 'parent_id', 'symlink',"menushow","newsletter","img","pozycja"];
	
}
