<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();
$db = get_db_connect();
$user = get_login_user($db);
$term = $_GET['line_up'];
$num  = $_GET['item_num'];

$items=change_line_up($db,true,$term,$num);
print json_encode($items);