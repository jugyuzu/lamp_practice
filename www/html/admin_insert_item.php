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

if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
if(is_valid_csrf_token(get_post('token'))===false){
  redirect_to(LOGIN_URL);
}
$name = get_post('name');
$price = get_post('price');
$status = get_post('status');
$stock = get_post('stock');
//$_FILEを取得
$image = get_file('image');

//ファイルがhttpで送られられたものか、型を調べる。is_positive_integerで価格、在庫が整数か確認is_valid_length
  if(regist_item($db, $name, $price, $stock, $status, $image)){
    set_message('商品を登録しました。');
  }else {
    set_error('商品の登録に失敗しました。');
  }

delete_session('csrf_token');

redirect_to(ADMIN_URL);