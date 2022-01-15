<?php
ob_start();
define('REQUEST', 'external');
require_once "/home/parapano/domains/szymonyo.tk/public_html/loken/index.php"; //or wherever the directory is relative to your path
ob_end_clean();
return $CI;