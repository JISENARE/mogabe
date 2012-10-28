<?php
$user_id = htmlspecialchars($_POST['name'], ENT_QUOTES);
//user_idをキーにDBを検索、パスワードを取得し比較を行う

//パスワードが一致したらセッションを開始しprofileへリダイレクトする
header("Location:profile.php");

//パスワードが一致しない場合はエラーを表示する

?>