<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:24:06
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public $table         = 'users';
    protected $returnType = 'object';

    protected $allowedFields = ['last_ip', 'last_login', "nick", "name", "email", "password", "level"];
}
