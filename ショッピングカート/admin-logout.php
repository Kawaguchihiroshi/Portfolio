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
<title>管理画面 / ログアウト｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">ログアウト</h1>
<h2 class="">ログアウトしました。</h2>
<?php unset($_SESSION['admin']); ?>
</div>
</main>
<?php require 'include/footer.php'; ?>