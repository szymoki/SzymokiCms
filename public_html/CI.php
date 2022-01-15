<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-02 21:37:28
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-08 15:12:54
 * @email: szymon.haczyk@icloud.com
 */
ob_start();
define('REQUEST', 'external');
require_once "index.php"; //or wherever the directory is relative to your path
ob_end_clean();
//echo "Dds";
 $session = \Config\Services::session();
    if($session->get('logged_in'))
   		return true; else return false;
