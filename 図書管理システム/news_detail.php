<?php session_start(); ?>
<!DOCTYPE  html>
<html lang="ja">
<head>
<?php require 'include/header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/menu.php';?>

<main role="main" class="container py-5">
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">お知らせ</h1>
</div>

<div class="p-5 mt-3 bg-white rounded">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM info WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {
	echo '<div class="h2">', $row['title'], '</div>';
	echo '<hr>';
	echo '	<div class="p-2 mb-2">', $row['article'], '</div>';
	echo '	<div class="p-2 text-right bg-light">', $row['do_date'], ' 更新 / 投稿者：';
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM staff WHERE id=?');
$sql->execute([$row['staff_id']]);
foreach ($sql->fetchAll() as $mem) {
	echo $mem['name'];
}
	echo '<a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>';
}
?>
</div><!-- /.container -->
</main>
<?php require 'include/footer.php'; ?>