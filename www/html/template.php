<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'order.php';

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

$id=get_get('id');
//注文番号、購入日時、合計金額を$valuesに
$values=get_order_content($db,$user['user_id'],$id);
//商品名、購入時の商品価格、購入数、小計を$itemsに入れる
$items=get_order_items($db,$user['user_id'],$id);
//tokenの発行
$token = get_csrf_token();

include_once VIEW_PATH . 'template_view.php';