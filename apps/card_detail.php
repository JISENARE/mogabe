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
    ca<div data-role="page" id="page10">
            <div data-theme="b" data-role="header">
                <h3>
                    (card name)
                </h3>
            </div>
            <div data-role="content">
                <div data-role="navbar" data-iconpos="top">
                    <ul>
                        <li>
                            <a href="./libarary.php" data-transition="fade" data-theme="b" data-icon="back">
                                戻る
                            </a>
                        </li>
                        <li>
                            <a href="#page10" data-transition="fade" data-theme="b" data-icon="arrow-l">
                                前のカード
                            </a>
                        </li>
                        <li>
                            <a href="#page10" data-transition="fade" data-theme="b" data-icon="arrow-r">
                                次のカード
                            </a>
                        </li>
                    </ul>
                </div>
                <div style="width: 288px; height: 100px; position: relative; background-color: #fbfbfb; border: 1px solid #b8b8b8;">
                    <img src="http://codiqa.com/static/images/v2/image.png" alt="image" style="position: absolute; top: 50%; left: 50%; margin-left: -16px; margin-top: -18px">
                </div>
                <div>
                    <p>
                        <b>
                            カード情報
                        </b>
                    </p>
                    <p>
                        <b>
                            (card_description)
                        </b>
                    </p>
                </div>
            </div>
            <div data-theme="b" data-role="footer" data-position="fixed">
                <h3>
                    copy right by JISENARE
                </h3>
            </div>
        </div>
    </body>
</html>