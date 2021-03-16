<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
	header('Location: admin.php');
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
<?php require 'include/staff_menu.php';?>

<main role="main" class="container py-5">
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">貸出申請管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
	<h2>現在提出されている貸出申請は以下の通りです。</h2>
	<hr />
	<div class="row  py-2">
		<div class="col-md-2 text-center" style="font-weight:bold;">返却予定日</div>
		<div class="col-md-5" style="font-weight:bold;">本のタイトル</div>
		<div class="col-md-2" style="font-weight:bold;">申請者</div>
	  	<div class="col-md-3 text-center" style="font-weight:bold;">返却処理</div>
	</div>
<hr />
<?php
$i = 0;

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql = "SELECT * FROM rentdata WHERE return_check like 0";
foreach ($pdo->query($sql) as $row) {
	$date1 = new DateTime($row['plan_return_date']);
	$date2 = new DateTime(date("Y-m-d"));

	if ($date1 < $date2) {
		echo '	<div class="row py-2 bg-danger">';
		$i++;
	} else {
		if ($i % 2 == 1) {
			echo '	<div class="row py-2">';
			$i++;
		} else {
			echo '	<div class="row py-2 bg-light">';
			$i++;
		}
	}
	echo '		<div class="col-md-2 text-center">', $row['plan_return_date'], '</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM book WHERE id like ?');
	$sql->execute([$row['book_id']]);
	foreach ($sql->fetchAll() as $book) {
		echo '		<div class="col-md-1"><img class="w-100" src="img/', $book['topimg'], '"></div>';
		echo '		<div class="col-md-4">', $book['booktitle'], '</div>';
	}
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM member WHERE id like ?');
	$sql->execute([$row['member_id']]);
	foreach ($sql->fetchAll() as $mem) {
		echo '		<div class="col-md-2">', $mem['name'], '</div>';
	}
	echo ' 		<div class="col-md-3 text-center"><a class="btn btn-sm btn-info" href="return-input.php?id=', $row['id'], '">変更</a></div>';
	echo '	</div>';
}
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>