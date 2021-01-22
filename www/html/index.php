<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();
//session[name]が入っているか確認
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
//user_id,name,password,typeを取得
$user = get_login_user($db);
//statusが1の商品のitem_id,name,stock,price,image,statusを取得
$items = get_open_items($db);

$token=get_csrf_token();

include_once VIEW_PATH . 'index_view.php';