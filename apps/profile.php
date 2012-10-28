<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<header></header>
<?php
$user_id = htmlspecialchars($_POST['name'], ENT_QUOTES);
?>
<nav>ようこそ <? echo $user_id ?>さん</nav>

</body>
</html>