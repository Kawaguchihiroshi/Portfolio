<?php
session_start();
if (isset($_SESSION['customer'])) {
unset($_SESSION['customer']);
}
ini_set('display_errors',1);
?>
<!DOCTYPE  html>
<html lang="ja">
<head>
<?php require 'include/header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/menu.php';?>
<main role="main" class="container py-5">
<div class="p-5 bg-white rounded">
<h2>ログアウト</h2>
<hr>
<div class="pt-4">ログアウトしました。</div>
<div class="mt-5"><a class="btn btn-secondary" href="index.php">ホームに戻る</a></div>
</div>
</main>
<?php require 'include/footer.php' ;?>