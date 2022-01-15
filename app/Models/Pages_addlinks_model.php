<?php
namespace App\Models;

use CodeIgniter\Model;

class Pages_addlinks_model extends Model
{
    public $table            = 'pages_addlinks';
    protected $returnType    = 'object';
    protected $allowedFields = ['title', 'page_id', "url", "parent_id", "position", "page_type"];

}
