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

$name = get_post('name');
$price = get_post('price');
$status = get_post('status');
$stock = get_post('stock');
//$_FILEを取得
$image = get_file('image');

//postでtokenが送られているかチェック
$post_token = get_post('token');
//session['token']を取得
$session_token = get_session('token');
//tokenをチェック
if(token_value_check($post_token,$session_token)){
  //ファイルがhttpで送られられたものか、型を調べる。is_positive_integerで価格、在庫が整数か確認is_valid_length
    if(regist_item($db, $name, $price, $stock, $status, $image)){
      set_message('商品を登録しました。');
    }else {
      set_error('商品の登録に失敗しました。');
    }
}else{
  set_error('エラーが発生しました');
}


redirect_to(ADMIN_URL);