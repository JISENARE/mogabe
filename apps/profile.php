
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

?>

<html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo h($user_id);?> profile</title>
</head>
<body>
<header></header>
<!--
<?php
//$user_id = h($_POST['name']);
?>
-->
<nav>ようこそ <?php echo h($user_id);?>さん</nav>

</body>
</html>