<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:23:55
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class Log_model extends Model
{
    public $table            = 'logs';
    protected $returnType    = 'object';
    protected $allowedFields = ['user_id', 'id', "log", "date", "type"];

}
