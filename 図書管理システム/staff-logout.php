<?php
session_start();
if (isset($_SESSION['customer'])) {
unset($_SESSION['customer']);
}
if (isset($_SESSION['staff'])) {
unset($_SESSION['staff']);
}
ini_set('display_errors',1);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/staff_header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/no_menu.php';?>
<main role="main" class="container py-5">
<div class="p-5 bg-white rounded">
<h2>ログアウト</h2>
<hr>
<div class="pt-4">ログアウトしました。</div>
<div class="mt-5"><a class="btn btn-secondary" href="admin.php">ログインページに戻る</a></div>
</div>
</main>
<?php require 'include/staff_footer.php' ;?>