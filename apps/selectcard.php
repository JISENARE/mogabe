<?php
// -----------------------------------------------
// selectcard.php
// カード情報をDBより取得し結果画面を表示する
// -----------------------------------------------
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
$user_point = $_SESSION['point'];

$dbh = connectDb();

// エラーメッセージ
define("CONST_ERR_DB", "データベースエラーです。");
define("CONST_ERR_POINT", "ポイントが足りません。");
$str_err_message = "";

// ----------------------
// メイン処理
// ----------------------
// ガチャ画面から必要なポイントを取得
// ※パッケージテーブルとかつくってそこから取得するようにした方がいいかも
$req_point = $_REQUEST["req_point"];
// 必要なポイントを持っているかチェック
if($user_point >= $req_point){
	// 画面より対象パッケージを取得
//	$req_package = $_REQUEST["req_package"];
	// パッケージに含まれるカードの枚数を取得
	$target_pack = getTargetNum($req_package, $dbh);
//	$req_package = '11111';
	// パッケージ内のカード番号をランダムに設定
	$req_num = mt_rand(1, $target_pack[0]);
//	$req_num = 5;
	// カード情報を取得
	$array_card_info = getCard($req_package, $req_num, $dbh);
	print_r($array_card_info);
	if($array_card_info){
		// ユーザ所得情報に登録
		if(insertUserCards($user_id, $array_card_info['card_id'], $dbh)){
			$str_err_message = CONST_ERR_DB;
		}
	}else{
		$str_err_message = CONST_ERR_DB;
	}
}else{
	$str_err_message = CONST_ERR_POINT;
}

// -------------------------------------
// 指定されたパッケージに含まれるカードの枚数を取得
function getTargetNum($req_package, $dbh) {
//	$sql = "select count(*) from cards where package = :req_package";
	$sql = "select count(*) from cards";
    $stmt = $dbh->prepare($sql);
//    $stmt->execute(array(":req_package"=>$req_package));
    $stmt->execute();
    $ret_num = $stmt->fetch();
    return $ret_num;
}
// -------------------------------------
// package_idとcard_numをキーにDBを検索、カード情報を取得
function getCard($package_id, $card_num, $dbh) {
//	$sql = "select * from cards where package_id = :package_id and card_num = :card_num limit 1";
//    $stmt = $dbh->prepare($sql);
//    $stmt->execute(array(":package_id"=>$package_id, ":card_num"=>$card_num));
//    $ret_array = $stmt->fetch();

	$sql = "select * from cards where card_id = :card_num limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":card_num"=>$card_num));
    $ret_array = $stmt->fetch();
    return $ret_array ? $ret_array : false;
}
// -------------------------------------
// user_cardsテーブルにカード情報をINSERT
function insertUserCards($user_id, $card_id, $dbh) {
	$sql = "insert into user_cards('user_id', 'card_id', 'card_num') values ";
	$sql = $sql + "(:user_id, :card_id, (select decode(card_num, null, 0, card_num) from user_cards where user_id = :user_id, card_id = :card_id) + 1)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":user_id"=>$user_id, ":card_id"=>$card_id));
    $ret_array = $stmt->fetch();
    return $ret_array ? $ret_array : false;
}
// -------------------------------------
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

<?php
if($str_err_message <> ""){
	// エラー時の処理
?>
<section>
<h1><?php echo h($user_name);?>ガチャ結果画面</h1>
	@<?php echo $str_err_message;?>
	</br>@<?php echo $req_num;?>
</section>
<?php
} else {
	// 正常時の処理
?>
<section>
<h1><?php echo h($user_name);?>ガチャ結果画面</h1>
	<div>
		<img src="" alt="カードの画像"><br/>
		<br/>
		<br/>
	</div>

	<div>
		<form>
			<input type="button" value="もう一度カードを引く" onclick=""/><br/><br/>
		</form>
	</div>
</section>
<?php
}
?>
</body>

</html>