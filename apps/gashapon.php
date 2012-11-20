<?php

require_once('config.php');
require_once('functions.php');

session_start();

if (empty($_SESSION['user_id'])) {
    echo 'no session';
    //header('Location: '.SITE_URL.'login.html');
    exit;
}

// セッションmeからデータ取り出し
$user_id = $_SESSION['user_id'];
$user_name = $SESSION['user_name'];
$user_point = $SESSION['point'];
?>

<html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo h($user_id);?> profile</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/dark-hive/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript">
google.load("jquery", "1.7");
google.load("jqueryui", "1.8");
</script>

<script type="text/javascript">
<!--
function pickCard(frm){
	var cardform = frm.form;
	var ctl = parseInt(cardform.ctl.value);
	var cardname;
	switch(ctl){
		case 1:
			cardname = "社長";
			break;
		case 2:
			cardname = "部長";
			break;
		case 3:
			cardname = "ユニット長";
			break;
		case 4:
			cardname = "苗木";
			break;
		default:
			cardname = "ポイントが足りません。お金払ってね。";
			ctl = 0;
			break;
	}
	cardform.ctl.value = ctl + 1;
	cardform.cardname.value = cardname;
}
-->
</script>

</head>
<body>
<header><h1>mogabe</h1><h2> -ガチャ画面</h2></header>
<nav>
<ul>
<li>TOP</li>
<li>プロフィール画面</li>
<li>カード一覧画面</li>
<li>ガチャ画面</li>
</ul>
</nav>
<section>
<h1><?php echo h($user_name);?>さんのガチャ画面</h1>
<div>
	<img src="" alt="ガチャガチャの画像"><br/>
	<br/>
	<br/>
</div>

<div>
<form>
	<input type="button" value="カードを引く" onclick="pickCard(this)"/><br/><br/>
	<input type="text" name="cardname" value="" style="border:none;width:200;" readonly/>
	<input type="hidden" name="ctl"/>
<form>
<div>

</section>

</body>
</html>