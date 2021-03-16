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
<h2>返却処理を行います。</h2>
<hr>


<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM rentdata WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {



	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql = $pdo->prepare('SELECT * FROM book WHERE id=?');
	$sql->execute([$row['book_id']]);

	foreach ($sql->fetchAll() as $row) {
		echo '<div class="p-3 bg-light rounded-lg">';
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
		echo '</div>';
		echo '';
	}
}

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM rentdata WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {
echo '<form action="return-output.php" method="post">';
echo '<input type="hidden" name="id" value="', $_GET['id'], '">';
echo '<div class="px-5 mt-3">';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">貸出日</div>';
echo '    	<div class="col-md-5">', $row['lend_date'], '</div>';
echo '    	<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">返却予定日</div>';
echo '    	<div class="col-md-5">', $row['plan_return_date'], '</div>';
echo '    	<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">返却日</div>';
echo '   	<div class="col-md-5">';
echo '			<input id="datepicker" type="text" class="form-control" placeholder="返却日(yyyy-mm-ddで記入)" name="return_date" value="', date('Y-m-d'), '" required>';
echo '		</div>';
echo '   	<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label>返却確認</label>';
echo '		</div>';
echo '	<div class="col-md-9">';
echo '		<div class="custom-control custom-radio custom-control-inline">';
echo '			<input type="radio" id="customRadioOnOff0" name="return_check" class="custom-control-input" value="0" checked>';
echo '			<label class="custom-control-label" for="customRadioOnOff0">貸出中</label>';
echo '		</div>';
echo '		<div class="custom-control custom-radio custom-control-inline">';
echo '			<input type="radio" id="customRadioOnOff1" name="return_check" class="custom-control-input" value="1">';
echo '			<label class="custom-control-label" for="customRadioOnOff1">返却完了</label>';
echo '		</div>';
echo '	</div>';
echo '	</div>';
}
?>
	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info" type="submit">返却処理をする</button></div>
		<div class="col-md-2"><button class="btn btn-lg btn-light" type="reset">クリア</button></div>
		<div class="col-md-5"></div>
	</div>
</div>
</form>
</main>
<?php require 'include/staff_footer.php' ;?>