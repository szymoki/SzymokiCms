<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:24:03
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class Pages_model extends Model
{
    public $table            = 'pages';
    protected $returnType    = 'object';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title', 'text', 'published', 'category', 'create_by', 'create_date', 'edited_by', 'edited_date', 'parent_id', 'symlink'];

}
