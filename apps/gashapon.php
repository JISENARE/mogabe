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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo h($user_id);?> profile</title>

		<!-- load css -->
		<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.css"/>
        <link rel="stylesheet" href="my.css" />
        <style>
            /* App custom styles */
        </style>

        <!-- load script -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/dark-hive/jquery-ui.css" rel="stylesheet" />
		<script type="text/javascript">
		google.load("jquery", "1.7");
		google.load("jqueryui", "1.8");
		</script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
        <script src="my.js">
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
        <div data-role="page" id="page7">
            <div data-theme="b" data-role="header">
                <h3>
                    ガシャ
                </h3>
            </div>
            <div data-role="content">
                <div data-role="navbar" data-iconpos="top">
                    <ul>
                        <li>
                            <a href="./profile.php" data-transition="fade" data-theme="b" data-icon="home">
                                プロフィール
                            </a>
                        </li>
                        <li>
                            <a href="" data-transition="fade" data-theme="a" data-icon="">
                                ガシャ
                            </a>
                        </li>
                        <li>
                            <a href="./library.php" data-transition="fade" data-theme="b" data-icon="">
                               　カード一覧
                            </a>
                        </li>
                        <li>
                            <a href="./user_login.php" data-transition="fade" data-theme="b" data-icon="refresh">
                                ログアウト
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

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
				</form>
			</div>
			</section>

            <div data-theme="b" data-role="footer" data-position="fixed">
                <h3>
                    copy right by JISENARE
                </h3>
            </div>
        </div>
    </body>
</html>