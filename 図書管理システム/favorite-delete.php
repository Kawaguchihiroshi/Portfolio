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
        <h2><i class="fas fa-heart"></i> お気に入りの削除</h2>
<hr />
<div class="p-5 mt-3 bg-white">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update favorite set unsub=1 WHERE book_id=? and member_id=?');
$sql->execute([
	$_GET['book_id'], 
	$_GET['member_id']
]);

echo '<h2>以下の内容を削除しました。</h2>';
echo '<hr>';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">本のタイトル</div>';
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
$sql->execute([$_GET['book_id']]);
foreach ($sql->fetchAll() as $book) {
	echo '		<div class="col-md-2 text-center"><img class="w-50" src="img/', $book['topimg'], '"></div>';
	echo '		<div class="col-md-7">', $book['booktitle'], '</div>';
}
echo '	</div>';
echo '';
echo '<div class="mt-5"><a class="btn btn-secondary" href="favorite-list.php">お気に入り一覧に戻る <i class="fas fa-chevron-circle-right"></i></a></div>';
echo '<div class="mt-3"><a class="btn btn-secondary" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>';
?>
</div>
</main>

<?php require 'include/footer.php'; ?>