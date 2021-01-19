<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
if(is_valid_csrf_token(get_post('token'))===false){
  redirect_to(LOGIN_URL);
}
$db = get_db_connect();
$user = get_login_user($db);

//POST[item_id]が入力されていたら$_POST['item_id']を$item_idに代入
$item_id = get_post('item_id');
//flaseがreturnされていればcartに追加れる
if(add_cart($db,$user['user_id'], $item_id)){
  set_message('カートに商品を追加しました。');
} else {
  set_error('カートの更新に失敗しました。');
}

delete_session('csrf_token');

redirect_to(HOME_URL);