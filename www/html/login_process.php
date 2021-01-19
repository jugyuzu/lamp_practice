<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}
if(is_valid_csrf_token(get_post('token'))===false){
  redirect_to(LOGIN_URL);
}
//postでnameとpasswordを受け取る
$name = get_post('name');
$password = get_post('password');

$db = get_db_connect();

//nameに応じてuserを取得、userがいないかpasswordが間違っていればfalseを返す
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  delete_session('csrf_token');
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  delete_session('csrf_token');
  redirect_to(ADMIN_URL);
}

delete_session('csrf_token');

redirect_to(HOME_URL);