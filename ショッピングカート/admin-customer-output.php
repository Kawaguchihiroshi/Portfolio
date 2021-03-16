<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
//　管理画面ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: admin-login-input.php" ) ;
exit ;
}
?>
<?php require 'include/admin_header.php'; ?>
<title>管理画面 / 
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 会員情報変更完了に関する処理
echo '会員情報変更完了';
break;

case '1':	// 退会・退会解除に関する処理
if ($_REQUEST['del'] == 0) {
echo '退会解除';
} else {
echo '退会完了';
}
break;

case '2':	// 仮会員から会員への変更処理
echo '会員区分変更';
break;

case '3':	// メールアドレス確認の再送信に関する処理
echo 'メールアドレス確認の再送信';
break;

case '4':	// パスワードリセットに関する処理
echo 'パスワードリセット';
break;
}
?>
｜NERVE FACTORY</title>
</head>
<body>
<header class="p-4 bg-dark text-white">
<div class="row">
<div class="col-md-3 text-left"><a href="admin-login-output.php"><img src="images/admin_logo.png"></a></div>
<div class="col-md-9 text-right">
<a href="admin-login-output.php" class="btn btn-info btn-sm">ダッシュボード</a>
<a href="index.php" class="btn btn-info btn-sm" target="_blank">サイトを確認</a>
<a href="admin-logout.php" class="btn btn-info btn-sm ml-3">ログアウト</a>
</div>
</div>
</header>
<main class="row">
<?php require 'include/admin_menu.php'; ?>
<div id="main" class="col-md-10 py-5">
<h1 class="mb-5" style="border-bottom: solid 3px #444;">
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 会員情報変更完了に関する処理
echo '会員情報変更完了';
break;

case '1':	// 退会・退会解除に関する処理
if ($_REQUEST['del'] == 0) {
echo '退会解除';
} else {
echo '退会完了';
}
break;

case '2':	// 仮会員から会員への変更処理
echo '会員区分変更';
break;

case '3':	// メールアドレス確認の再送信に関する処理
echo 'メールアドレス確認の再送信';
break;

case '4':	// パスワードリセットに関する処理
echo 'パスワードリセット';
break;
}
?>
</h1>


<?php
$pref = $_REQUEST['level'];
switch ($pref){

case '0':	// 会員情報変更完了に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update customer set name=?, tell=?, post_no=?, adrs=?, email=?, password=?, delivery_name=?, delivery_tell=?, delivery_post_no=?, delivery_adrs=? where id=?');
$sql->execute([
	$_REQUEST['name'], 
	$_REQUEST['tell'], 
	$_REQUEST['post_no'], 
	$_REQUEST['adrs'], 
	$_REQUEST['email'], 
	$_REQUEST['password'], 
	$_REQUEST['delivery_name'], 
	$_REQUEST['delivery_tell'], 
	$_REQUEST['delivery_post_no'], 
	$_REQUEST['delivery_adrs'], 
	$_REQUEST['id']
]);

echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">以下、内容に会員情報を変更しました。</h2>';
echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">基本情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">会員氏名</div>';
echo '<div class="col-md-7 py-2">', $_REQUEST['name'], '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
echo '<div class="col-md-7 py-2">', $_REQUEST['tell'], '</div>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
echo '<div class="col-md-6 py-2">', $_REQUEST['post_no'], '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
echo '<div class="col-md-11 py-2">', $_REQUEST['adrs'], '</div>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white py-2">メールアドレス</div>';
echo '<div class="col-md-5 py-2">', $_REQUEST['email'], '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="col-md-3 bg-secondary text-white py-2">パスワード</div>';
echo '<div class="col-md-4 py-2">', $_REQUEST['password'], '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">配送先情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-5">';
echo '<div class="col-md-4 bg-secondary text-white py-2">配送先名前</div>';
echo '<div class="col-md-8 py-2">', $_REQUEST['delivery_name'], '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
echo '<div class="col-md-7 py-2">', $_REQUEST['delivery_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-3"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
echo '<div class="col-md-6 py-2">', $_REQUEST['delivery_post_no'], '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
echo '<div class="col-md-11 py-2">', $_REQUEST['delivery_adrs'], '</div>';
echo '</div>';
echo '</div>';
echo '<div class="pt-5">';
echo '<a href="admin-customer-list.php?pg=1&level=0" class="btn btn-info">会員一覧</a>';
echo '<a href="admin-index.php" class="ml-3 btn btn-info">管理画面トップ</a>';
echo '</div>';
echo '</div>';
require 'include/admin_sendmail.php';
break;


case '1':	// 退会・退会解除に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update customer set del=? where id=?');
$sql->execute([
	$_REQUEST['del'], 
	$_REQUEST['id']
]);

echo '<div class="p-3 bg-white">';
if ($_REQUEST['del'] == 0) {
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">退会を解除しました。</h2>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=0" class="btn btn-info">会員一覧</a>';
echo '<a href="admin-customer-list.php?pg=1&level=2" class="btn btn-info ml-3">仮登録一覧</a>';
} else {
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">退会しました。</h2>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=1" class="btn btn-info">退会者一覧</a>';
}
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;


case '2':	// 仮会員から会員への変更に関する処理
$i = 0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from customer where email=? AND status=1');
$sql->execute([	$_REQUEST['email'] ]);
foreach ($sql->fetchAll() as $row) { $i++; }

if ($i == 0) {
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update customer set status=? where id=?');
$sql->execute([
	$_REQUEST['status'], 
	$_REQUEST['id']
]);

echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">会員区分を「会員」に変更しました。</h2>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=0" class="btn btn-info">会員一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
require 'include/admin_sendmail.php';
} else {
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">会員区分を変更できませんでした。</h2>';
echo '<div class="py-3">すでに本会員に使用しているメールアドレスが存在します。</div>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=0" class="btn btn-info">会員一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
}
break;


case '3':	// メールアドレス確認の再送信に関する処理
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">登録アドレス宛に確認メールを送信しました。</h2>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=2" class="btn btn-info">仮登録一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
require 'include/admin_sendmail.php';
break;


case '4':	// パスワードリセットページのURLを送信に関する処理
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">パスワードリセットのご案内を送信しました。</h2>';
echo '<div class="py-4">';
echo '<a href="admin-customer-list.php?pg=1&level=0" class="btn btn-info">会員一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
require 'include/admin_sendmail.php';
break;


}
?>

</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>