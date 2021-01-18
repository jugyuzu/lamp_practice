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
$item_id = get_post('item_id');

//データベースと画像ファイルの削除ができればtrueがreturnされる
if(destroy_item($db, $item_id) === true){
  set_message('商品を削除しました。');
} else {
  set_error('商品削除に失敗しました。');
}

delete_session('csrf_token');

redirect_to(ADMIN_URL);