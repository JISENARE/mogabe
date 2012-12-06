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
$user_name = $_SESSION['user_name'];
$point = $_SESSION['point'];
?>

<html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo h($user_id);?> profile</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/redmond/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript">
google.load("jquery", "1.7");
google.load("jqueryui", "1.8");
<!--
jQuery( function() {
    jQuery( '#gmenu' ) . buttonset();
} );
// -->
</script>
<style>
<!--
#gmenu li{
    font-size: 14px;
    margin: 0;
    float: left;
}
-->
</style>
</head>
<body>
<nav>
<ul id="gmenu">
<li>TOP</li>
<li><a href="#">プロフィール画面</a></li>
<li>カード一覧画面</li>
<li><a href="./gashapon.php">ガチャ画面</a></li>
</ul>
</nav>
</br>
<section>
<h1>ようこそ <?php echo h($user_id);?>さん</h1>
<div>
<img src="./Image/<?php echo h($user_id);?>.png" alt="アバター"  width="250" height="250">
<p>所持ポイント：<?php echo h($point);?></p>
</div>
</section>

</body>
</html>