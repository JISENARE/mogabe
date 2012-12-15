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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo h($user_id);?> profile</title>
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
        <div data-role="page" id="page8">
            <div data-theme="b" data-role="header">
                <h3>
                    ライブラリ
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
                            <a href="./gashapon.php" data-transition="fade" data-theme="b" data-icon="">
                                ガシャ
                            </a>
                        </li>
                        <li>
                            <a href="" data-transition="fade" data-theme="a" data-icon="">
                                カード一覧
                            </a>
                        </li>
                        <li>
                            <a href="./login.html" data-transition="fade" data-theme="b" data-icon="refresh">
                                ログアウト
                            </a>
                        </li>
                    </ul>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="searchinput2">
                        </label>
                        <input name="" id="searchinput2" placeholder="" value="" type="search">
                    </fieldset>
                </div>
                <ul data-role="listview" data-divider-theme="b" data-inset="true">
                    <li data-role="list-divider" role="heading">
                        Divider
                    </li>
                    <li data-theme="c">
                        <a href="#" data-transition="slide">
                            Button
                        </a>
                    </li>
                </ul>
            </div>
            <div data-theme="b" data-role="footer" data-position="fixed">
                <h3>
                    copy right by JISENARE
                </h3>
            </div>
        </div>
    </body>
</html>