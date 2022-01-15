<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:23:52
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class Acl_model extends Model
{
    public $table            = 'acl';
    protected $returnType    = 'object';
    protected $allowedFields = ['user_id', 'acl_name'];
}
