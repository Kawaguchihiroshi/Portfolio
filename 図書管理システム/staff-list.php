<?php
session_start();
if (isset($_SESSION['customer'])) {
  unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
  header('Location: admin.php');
}
if ($_SESSION['staff']['login_name'] != "administrator") {
	header('Location: admin-login-output.php');
}
if ($_SESSION['staff']['login_name'] != "a_test") {
	header('Location: admin-login-output.php');
}	
ini_set('display_errors',1);
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/staff_header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/staff_menu.php';?>
<main role="main" class="container py-5">
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">指導員管理</h1>
</div>
<div class="p-5 mt-3 bg-white">
<h2>現在登録されている指導員は以下の通りです。</h2>
<hr>
<div class="row my-4">
<div class="col-md-2 text-center" style="font-weight:bold;">指導員番号</div>
<div class="col-md-2" style="font-weight:bold;">氏名</div>
<div class="col-md-4" style="font-weight:bold;">メールアドレス</div>
<div class="col-md-2" style="font-weight:bold;">ログインID</div>
<div class="col-md-2 text-center" style="font-weight:bold;">変更・削除</div>
</div>
<?php
$i = 0;
$sql = "SELECT * FROM staff WHERE unsub LIKE 0";
foreach ($pdo->query($sql) as $row) {
if ($i % 2 == 1) {
echo '<div class="row py-2">';
} else {
echo '<div class="row py-2 bg-light">';
}
echo '<div class="col-md-2 pt-1 text-center">', $row['id'], '</div>';
echo '<div class="col-md-2 pt-1">', $row['name'], '</div>';
echo '<div class="col-md-4 pt-1">', $row['email'], '</div>';
echo '<div class="col-md-2 pt-1">', $row['login_name'], '</div>';
echo '<div class="col-md-1 text-center"><a class="btn btn-sm btn-info" href="staff-input.php?id=', $row['id'], '">変更</a></div>';
echo '<div class="col-md-1 text-center">';
echo '<form action="staff-delete.php" method="post">';
echo '<input type="hidden" name="unsub" value="1">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="name" value="', $row['name'], '">';
echo '<input type="hidden" name="email" value="', $row['email'], '">';
echo '<button class="btn btn-sm btn-secondary" type="sbmit">削除</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$i++;
}
?>
</div>
</main>
<?php require 'include/staff_footer.php' ;?>