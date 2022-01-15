<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-06 15:49:15
 * @Last Modified by:   Szymon Haczyk
 * @Last Modified time: 2020-05-06 15:58:39
 * @email: szymon.haczyk@icloud.com
 */

 function log_cms($text,$type=0){
 	$session = \Config\Services::session();
    $ses=$session->get("logged_in");
	$log_model= new \App\Models\Log_model();
	return $log_model->insert(array("log"=>$text,"user_id"=>$ses["id"],"date"=>date("Y-m-d H:i:s")));
 }
?>