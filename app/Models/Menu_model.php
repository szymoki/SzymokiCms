<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:23:56
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{
    public $table            = 'menu';
    protected $returnType    = 'object';
    protected $allowedFields = ['name', 'url', "pozycja", "active", "parent_id"];

}
