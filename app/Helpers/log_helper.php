<?php

/**
 * @Author: Szymon Haczyk
 * @Date:   2020-05-06 15:49:15
 * @Last Modified by:   szymon
 * @Last Modified time: 2022-01-22 14:11:50
 * @email: szymon.haczyk@icloud.com
 */

 function log_cms($text,$type=0){
 	$session = \Config\Services::session();
    $ses=$session->get("logged_in");
	$log_model= new \App\Models\Log_model();
	return $log_model->insert(array("log"=>filter_var($text,FILTER_SANITIZE_STRING),"user_id"=>$ses["id"],"date"=>date("Y-m-d H:i:s")));
 }
?>