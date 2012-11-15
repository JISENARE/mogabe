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
</head>
<body>
<header><h1>mogabe</h1><h2> -プロフィール画面</h2></header>
<nav>
<ul>
<li>TOP</li>
<li>プロフィール画面</li>
<li>カード一覧画面</li>
<li>ガチャ画面</li>
</ul>
</nav>
<section>
<h1>ようこそ <?php echo h($user_name);?>さん</h1>
<img src="" alt="アバター">
<p>所持ポイント：<?php echo h($point);?></p>
</section>

</body>
</html>