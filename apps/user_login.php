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
	$errmsg = 'ユーザIDを入力してください。';
}
// $passwordが空？
if ($password == '') {
	$errmsg = 'パスワードを入力してください。';
}

if(!empty($errmsg)){
	goto a;
}

if($me = getUser($user_id, $password, $dbh)){
	// change session
	//認証完了
	session_regenerate_id(true);

	// セッションにmeとして登録
	$_SESSION['user_id'] = $me['user_id'];
	$_SESSION['user_name'] = $me['user_name'];
	$_SESSION['point'] = $me['point'];

	//パスワードが一致したらセッションを開始しprofileへリダイレクトする
	header("Location: ".SITE_URL."profile.php");
} else {
	//パスワードが一致しない場合はエラーを表示する
	$errmsg = 'パスワードが一致しません。';
}
a:
?>
<!--エラーによりPHP処理が終了した場合のみ表示されるHTML-->
<html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>エラー処理</title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.css"
        />
        <link rel="stylesheet" href="my.css" />
        <style>
            /* App custom styles */
        </style>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/redmond/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript">
        google.load("jquery", "1.7");
        google.load("jqueryui", "1.8");
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
        <script src="my.js">
        </script>
    </head>
    <body>
    <div>
    <?php echo h($errmsg);?>
    </br>
    <a href="login.html">戻る</a>
    </div>
    </body>
</html>