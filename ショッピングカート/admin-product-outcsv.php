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
<title>管理画面 / 商品CSVの登録｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">商品CSVの登録</h1>

<?php
require 'include/admin-product-csv.php';

echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">CSVファイルの登録が完了しました。</h2>';
echo '<a href="admin-product-list.php" class="btn btn-info">商品一覧</a>';
echo '<a href="admin-index.php" class="ml-3 btn btn-info">管理画面トップ</a>';
echo '</div>';
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>