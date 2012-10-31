<?php

require_once('config.php');
require_once('functions.php');

session_start();

//TODO:user_idをキーにDBを検索、パスワードを取得し比較を行う
function getUser($user_id, $password, $dbh) {
	$sql = "select * from users where user_id = :user_id and password = :password limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":user_id"=>$user_id, ":password"=>$password));
    $user = $stmt->fetch();
    return $user ? $user : false;
}

$user_id = h($_POST['name']);
$password = h($_POST['password']);
$dbh = connectDb();

// $user_idが空？
if ($user_id == '') {
	$err['user_id'] = 'ユーザIDを入力してください';
}
// $passwordが空？
if ($password == '') {
	$err['password'] = 'パスワードを入力してください';
}

if(!empty($err)){
	echo h($err['user_id']);
	echo h($err['password']);
	exit;
}

if($me = getUser($user_id, $password, $dbh)){
	// change session
	session_regenerate_id(true);

	// セッションにmeとして登録
	$_SESSION['user_id'] = $me['user_id'];

	//パスワードが一致したらセッションを開始しprofileへリダイレクトする
	header("Location: ".SITE_URL."profile.php");
} else {
	//パスワードが一致しない場合はエラーを表示する
	echo h('ログイン失敗');
	exit;
}


