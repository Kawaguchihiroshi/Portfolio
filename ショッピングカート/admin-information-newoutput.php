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
<title>管理画面 / お知らせ登録｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">お知らせ登録</h1>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
date_default_timezone_set('Japan');
$writedate = date("Y-m-d H:i:s");
$del = 0;
$sql=$pdo->prepare('insert into information values(null,?,?,?,?,?,?,?)');
$sql->execute([
	$_REQUEST['admin_id'], 
	$_REQUEST['title'], 
	$_REQUEST['content'], 
	$writedate, 
	$_REQUEST['flag'], 
	$_REQUEST['status'], 
	$del
]);

echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">以下、内容を登録しました。</h2>';

echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">タイトル</div>';
echo '<div class="col-md-9">', $_REQUEST['title'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">本文</div>';
echo '<div class="col-md-9">', $_REQUEST['content'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示区分</div>';
if ($_REQUEST['flag'] == 1) {
echo '<div class="col-md-9">トップページのみ表示</div>';
} else if ($_REQUEST['flag'] == 2) {
echo '<div class="col-md-9">会員ページのみ表示</div>';
} else {
echo '<div class="col-md-9">両方表示</div>';
}
echo '</div>';
echo '<div class="row mb-5">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示設定</div>';
if ($_REQUEST['status'] == 1) {
echo '<div class="col-md-9">下書き</div>';
} else if ($_REQUEST['status'] == 2) {
echo '<div class="col-md-9">公開</div>';
} else {
echo '<div class="col-md-9">非表示</div>';
}
echo '</div>';
echo '<a href="admin-information-list.php?pg=1" class="btn btn-info">お知らせ一覧</a>';
echo '<a href="admin-index.php" class="ml-3 btn btn-info">管理画面トップ</a>';
echo '</div>';
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>