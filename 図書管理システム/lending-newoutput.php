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
<h2>以下の内容で貸出申請を行いました。</h2>
<hr>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('insert into rentdata values(null,?,?,?,?,?,?)');
$sql->execute([
	$_REQUEST['member_id'],
	$_REQUEST['book_id'],
	$_REQUEST['lend_date'],
	$_REQUEST['plan_return_date'],
	$_REQUEST['return_date'],
	$_REQUEST['return_check']
]);

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');

if (isset($_REQUEST['book_id'])) {
	$b_id = htmlspecialchars($_REQUEST['book_id']);
	$book_id_value = $b_id;
} else {
	$b_id = '';
	$b_id_va = '';
}

$sql = "SELECT * FROM book WHERE id LIKE '%$b_id%'";

foreach ($pdo->query($sql) as $row) {
	echo '<div class="p-3 bg-white rounded-lg">';
	echo '<h2 class="h3">申請図書データ</h2>';
	echo '<hr />';
	echo '<div class="row mx-1 mb-2">';
	echo '<div class="col-md-2 p-2"><img class="w-100" src="img/', $row['topimg'], '"></div>';
	echo '<div class="col-md-10 p-2">';
	echo '<div class="mt-1">';
	echo '<h5>', $row['booktitle'], '</h5>';
	echo '</div>';
	echo '<div class="mt-1">著者：', $row['author'], '</div>';
	echo '<div class="mt-1">出版社：', $row['publishers'], '</div>';
	echo '<div class="mt-1">ISBN番号：', $row['isbn'], '</div>';
	echo '</div>';
	echo '</div><!-- /.row -->';
	echo '';
	echo '<div class="row pt-4">';
	echo '<div class="col-md-3">返却予定日</div>';
	echo '<div class="col-md-9">', $_REQUEST['plan_return_date'], '</div>';
	echo '</div>';
	echo '';
	echo '</div>';
}
	echo '	<div class="pt-4">※返却の際は、本を指導員にお渡しください。</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>';

?>
</div>
</main>

<?php require 'include/footer.php'; ?>