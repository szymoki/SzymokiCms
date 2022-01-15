<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:24:00
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

class News_model extends MY_Model
{
    public $table            = 'news';
    protected $returnType    = 'object';
    protected $allowedFields = ['title', 'text', 'published', 'mainphoto', 'super', 'mainpage', 'category', 'create_by', 'create_date', 'edited_by', 'edited_date'];

}
