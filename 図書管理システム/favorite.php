<?php
session_start();
if (!isset($_SESSION['customer'])) {
	header('Location: index.php');
}
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

        <h2>お気に入りに追加しました。</h2>
<hr>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM favorite WHERE member_id=? and book_id=?');
$sql->execute([
	$_REQUEST['member_id'],
	$_REQUEST['book_id']
]);
foreach ($sql->fetchAll() as $row) {
	if ($row['unsub'] == 1) {
		$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
		$sql=$pdo->prepare('update favorite set unsub=0 WHERE book_id=? and member_id=?');
		$sql->execute([
			$row['book_id'], 
			$row['member_id']
		]);
	}
}
if (empty($sql->fetchAll())) {
		$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
		$sql=$pdo->prepare('insert into favorite values(?,?,?)');
		$sql->execute([
			$_REQUEST['member_id'],
			$_REQUEST['book_id'],
			$_REQUEST['unsub']
		]);
}
	
	echo '<div class="mt-3">追加したお気に入りの本は、お気に入り一覧から確認できます。</div>';
	echo '<div class="mt-5"><a class="btn btn-secondary" href="favorite-list.php">お気に入り一覧に戻る <i class="fas fa-chevron-circle-right"></i></a></div>';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>';
?>
      </div><!-- /.product-area -->

</main>

<?php require 'include/footer.php'; ?>