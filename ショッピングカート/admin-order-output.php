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
case '0':	// 注文内容の確認に関する処理
echo '注文内容の確認完了';
break;

case '1':	// 支払い確認に関する処理
echo '支払い確認完了';
break;

case '2':	// 発送の確認に関する処理
echo '発送の確認完了';
break;

case '3':	// キャンセル確認に関する処理
echo 'キャンセルの確認完了';
break;

case '4':	// 返金処理に関する処理
echo '返金処理の完了';
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
case '0':	// 注文内容の確認に関する処理
echo '注文内容の確認完了';
break;

case '1':	// 支払い確認に関する処理
echo '支払い確認完了';
break;

case '2':	// 発送の確認に関する処理
echo '発送の確認完了';
break;

case '3':	// キャンセル確認に関する処理
echo 'キャンセルの確認完了';
break;

case '4':	// 返金処理に関する処理
echo '返金処理の完了';
break;
}
?>
</h1>


<?php
$pref = $_REQUEST['level'];
switch ($pref){

case '0':	// 注文内容の確認に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update purchases set order_checker=?, status=? where id=?');
$sql->execute([
	$_SESSION['admin']['id'], 
	$_REQUEST['status'],
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">注文の確認が完了しました。</h2>';
echo '<div class="py-4" style="border-bottom: solid 1px #444;">次は支払いの確認を行ってください。</div>';
echo '<div class="py-4">';
echo '<a href="admin-order-list.php?pg=1&level=0" class="btn btn-info">注文者一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;

case '1':	// 支払い確認に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update purchases set payment_date=?, payment_checker=?, status=? where id=?');
$sql->execute([
	$_REQUEST['pay_date'],
	$_SESSION['admin']['id'], 
	$_REQUEST['status'],
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">支払いの確認が完了しました。</h2>';
echo '<div class="py-4" style="border-bottom: solid 1px #444;">次は発送の確認を行ってください。</div>';
echo '<div class="py-4">';
echo '<a href="admin-order-list.php?pg=1&level=1" class="btn btn-info">支払い完了者一覧</a>';
echo '<a href="admin-order-list.php?pg=1&level=0" class="btn btn-info ml-3">注文者一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;

case '2':	// 発送の確認に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update purchases set shipment_date=?, shipment_checker=?, status=?, voucher_no=? where id=?');
$sql->execute([
	$_REQUEST['shipment_date'],
	$_SESSION['admin']['id'], 
	$_REQUEST['status'],
	$_REQUEST['voucher_no'],
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">発送の確認が完了しました。</h2>';
echo '<div class="py-4" style="border-bottom: solid 1px #444;">注文処理は全て完了いたしました。<br />お疲れさまでした。</div>';
echo '<div class="py-4">';
echo '<a href="admin-order-list.php?pg=1&level=2" class="btn btn-info">発送完了者一覧</a>';
echo '<a href="admin-order-list.php?pg=1&level=1" class="btn btn-info ml-3">支払い完了者一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;

case '3':	// キャンセル確認に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update cart set cancel_checker=? where id=?');
$sql->execute([
	$_SESSION['admin']['id'], 
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">キャンセルの確認が完了しました。</h2>';
echo '<div class="py-4" style="border-bottom: solid 1px #444;">返品の有無、払い戻しの有無を確認してください。</div>';
echo '<div class="py-4">';
echo '<a href="admin-order-list.php?pg=1&level=3" class="btn btn-info">キャンセル商品一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;

case '4':	// 返金処理に関する処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update cart set refund_date=?, refund_checker=? where id=?');
$sql->execute([
	$_REQUEST['refund_date'], 
	$_SESSION['admin']['id'], 
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="py-4" style="border-bottom: solid 1px #444;">返金の確認が完了しました。</h2>';
echo '<div class="py-4" style="border-bottom: solid 1px #444;">キャンセル処理は全て完了いたしました。<br />お疲れさまでした。</div>';
echo '<div class="py-4">';
echo '<a href="admin-order-list.php?pg=1&level=3" class="btn btn-info">キャンセル商品一覧</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
echo '</div>';
break;
}
?>

</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>