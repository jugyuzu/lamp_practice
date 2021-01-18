<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);
//falseが入っていたらリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
//itemsテーブルから商品の情報を取得
$items = get_all_items($db);

//tokenの発行
$token = get_csrf_token();

include_once VIEW_PATH . '/admin_view.php';
