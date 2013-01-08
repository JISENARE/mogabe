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
$user_name = $SESSION['user_name'];
$user_point = $SESSION['point'];

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
	$req_package = $_REQUEST["req_package"];
	// パッケージに含まれるカードの枚数を取得
	$target_pack = getTargetNum($req_package, $dbh);
	// パッケージ内のカード番号をランダムに設定
	$req_num = mt_rand(1, target_pack)
	// カード情報を取得
	if($array_card_info = getCard($req_package, $req_num, $dbh)){
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
	$sql = "select count(*) from cards where package = :req_package";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":req_package"=>$req_package));
    $ret_num = $stmt->fetch();
    return $ret_num;
}
// -------------------------------------
// package_idとpack_numをキーにDBを検索、カード情報を取得
function getCard($package_id, $pack_num, $dbh) {
	$sql = "select * from cards where package_id = :package_id and pack_num = :pack_num limit 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":package_id"=>$package_id, ":pack_num"=>$pack_num));
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
<title><?php echo h($user_id);?> profile</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/dark-hive/jquery-ui.css" rel="stylesheet" />
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
<header><h1>mogabe</h1><h2> -ガチャ画面</h2></header>
<nav>
<ul>
<li>TOP</li>
<li>プロフィール画面</li>
<li>カード一覧画面</li>
<li>ガチャ画面</li>
</ul>
</nav>

<?php
if($str_err_message <> ""){
	// エラー時の処理
?>
<section>
<h1><?php echo h($user_name);?>ガチャ結果画面</h1>
	<?php echo $str_err_message;?>
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