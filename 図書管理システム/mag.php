<?php
session_start();
ini_set('display_errors',1);
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql = "SELECT * FROM book WHERE category05 LIKE 1";
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

	<div class="p-4 text-white bg-dark rounded">
		<h1 class="display-4">管理図書一覧</h1>
	</div>

      <div class="search-area mb-5">
		<div class="container">
			<!-- 列の例 -->
			<div class="row p-4 bg-info rounded">
				<div class="col-md-3 text-white text-center" style="font-size:22px; font-weight:bold;">図書検索</div>
				<div class="col-md-9">
				 	<form class="form-inline my-2 my-lg-0" action="search.php">
						<div class="input-group w-100">
							<input class="form-control" type="text" name="search" value="" placeholder="検索ワード" aria-label="検索ワード" aria-describedby="button-addon2">
							<div class="input-group-append">
								<button class="btn btn-outline-light" type="submit" id="button-addon2">検索</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.container -->

        <h2 class="mt-5">雑誌関連</h2>
<hr>
<?php
$i = 0;

foreach ($pdo->query($sql) as $row) {
	echo '<div class="row mx-1 bg-white mb-2">';
	echo '<div class="col-md-2 p-2"><img class="w-100" src="img/', $row['topimg'], '"></div>';
	echo '<div class="col-md-7 p-2">';
	echo '<div class="mt-1">';
	echo '<h5>', $row['booktitle'], '</h5>';
	echo '</div>';
	echo '<div class="mt-1">著者：', $row['author'], '</div>';
	echo '<div class="mt-1">出版社：', $row['publishers'], '</div>';
	echo '<div class="mt-1"><a class="btn btn-sm btn-outline-success" href="', $row['publishers_url'], '" target="_blank"><i class="fas fa-external-link-alt"></i> 出版社の書籍ページ</a></div>';
	echo '<div class="mt-1">ISBN番号：', $row['isbn'], '</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM rentdata WHERE book_id=? and return_check=0');
	$sql->execute([$row['id']]);
	$rent = 0;
	foreach ($sql->fetchAll() as $book) {
	$rent++;
	}
	echo '<div class="mt-1">貸出状況：', $row['count'], '冊中、', $rent, '冊貸出中</div>';
	echo '</div>';
	echo '<div class="col-md-3 p-2">';
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM favorite WHERE member_id=? and book_id=? and unsub=0');
	$sql->execute([$_SESSION['customer']['id'], $row['id']]);
	if (empty($sql->fetchAll())) {
		echo '<form class="mt-2" action="favorite.php" method="post">';
		echo '	<input type="hidden" name="member_id" value="', $_SESSION['customer']['id'], '">';
		echo '	<input type="hidden" name="book_id" value="', $row['id'], '">';
		echo '	<input type="hidden" name="unsub" value="0">';
		echo '	<button class="btn btn-sm btn-outline-success" type="submit"><i class="fas fa-heart"></i> お気に入りに追加</button>';
		echo '</form>';
	} else {
		echo '	<button class="mt-2 btn btn-sm btn-secondary" disabled><i class="fas fa-heart"></i> お気に入りに追加済み</button>';
	}

	if ($row['count'] > $rent) {
		$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
		$sql=$pdo->prepare('SELECT * FROM rentdata WHERE member_id=? and book_id=? and return_check=0');
		$sql->execute([$_SESSION['customer']['id'], $row['id']]);
		if (empty($sql->fetchAll())) {
			echo '<form class="mt-1" action="lending-newinput.php" method="post">';
			echo '	<input type="hidden" name="book_id" value="', $row['id'], '">';
			echo '	<button class="btn btn-sm btn-outline-success" type="submit"><i class="fas fa-file-alt"></i> 貸出申請を出す</button>';
			echo '</form>';
		} else {
			echo '	<button class="mt-2 btn btn-sm btn-secondary" disabled><i class="fas fa-file-alt"></i> 貸出申請中</button>';
		}
	} else {
		echo '	<button class="mt-2 btn btn-sm btn-danger" disabled><i class="fas fa-file-alt"></i> 返却待ち</button>';
	}

	}
	echo '</div>';
	echo '</div><!-- /.row -->';
	$i++;
}
if ($i == 0) {
		echo '<div class="text-center p-5 mx-1 bg-white mb-2">';
		echo '現在、関連書籍がありません。';
		echo '</div>';
}
?>
      </div><!-- /.product-area -->

</main>

<?php require 'include/footer.php'; ?>