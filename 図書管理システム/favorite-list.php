<?php
session_start();
if (!isset($_SESSION['customer'])) {
header('Location: index.php');
}
ini_set('display_errors',1);
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
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
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">訓練生メニュー</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2><i class="fas fa-heart"></i> お気に入り一覧</h2>
<hr />
	<div class="row  py-2">
		<div class="col-md-9 text-left" style="font-weight:bold;">本のタイトル</div>
	  	<div class="col-md-3 text-center" style="font-weight:bold;">操作</div>
	</div>
<hr />
<?php
$i = 0;
$sql=$pdo->prepare('SELECT * FROM favorite WHERE member_id=? and unsub=0');
$sql->execute([$_SESSION['customer']['id']]);

foreach ($sql->fetchAll() as $row) {
if ($i % 2 == 1) {
	echo '	<div class="row py-2">';
	$i++;
} else {
	echo '	<div class="row py-2 bg-light">';
	$i++;
}

$sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
$sql->execute([$row['book_id']]);
foreach ($sql->fetchAll() as $book) {
	echo '		<div class="col-md-2 text-center"><img class="w-50" src="img/', $book['topimg'], '"></div>';
	echo '		<div class="col-md-7">', $book['booktitle'], '<br /><a class="btn btn-sm btn-outline-success mt-1" href="', $book['publishers_url'], '" target="_blank"><i class="fas fa-external-link-alt"></i> 出版社の書籍ページ</a></div>';


echo ' 		<div class="col-md-2 text-right">';

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM rentdata WHERE book_id=? and return_check=0');
$sql->execute([$book['id']]);
$rent = 0;
foreach ($sql->fetchAll() as $row) {
$rent++;
}
if ($book['count'] > $rent) {
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM rentdata WHERE member_id=? and book_id=? and return_check=0');
	$sql->execute([$_SESSION['customer']['id'], $book['id']]);
	if (empty($sql->fetchAll())) {
		echo '<form action="lending-newinput.php" method="post">';
		echo '	<input type="hidden" name="book_id" value="', $book['id'], '">';
		echo '	<button class="btn btn-sm btn-outline-success" type="submit"><i class="fas fa-file-alt"></i> 貸出申請を出す</button>';
		echo '</form>';
	} else {
		echo '	<button class="btn btn-sm btn-secondary" disabled><i class="fas fa-file-alt"></i> 貸出申請中</button>';
	}
} else {
	echo '	<button class="btn btn-sm btn-danger" disabled><i class="fas fa-file-alt"></i> 返却待ち</button>';
}

	echo ' 		</div>';
	echo ' 		<div class="col-md-1 text-left"><a class="btn btn-sm btn-info" href="favorite-delete.php?book_id=', $book['id'], '&member_id=', $_SESSION['customer']['id'], '">削除</a></div>';
	echo '	</div>';
}
}
?>
</div>
</main>

<?php require 'include/footer.php'; ?>