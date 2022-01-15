<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-15 16:24:10
 * @email: szymon.haczyk@icloud.com
 */
namespace App\Models;

use CodeIgniter\Model;

class Zmienne_model extends Model
{
    public $table            = 'zmienne';
    protected $primaryKey    = 'name';
    protected $returnType    = 'object';
    protected $allowedFields = ['name', 'value'];
    public function zmienna($name)
    {

        $z = $this->find($name);
        //    print_r($z);
        if ($z) {
            return $z->value;
        } else {
            return false;
        }

    }

    public function zmienna_set($name, $value)
    {

        $this->update($name, array("value" => $value));
    }

    public function getAll()
    {
        $z    = $this->findAll();
        $dane = [];
        foreach ($z as $item) {
            $dane[$item->name] = $item->value;
        }
        //print_r($dane);
        return (object) $dane;
    }
}
