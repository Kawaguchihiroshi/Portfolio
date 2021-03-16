<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
	header('Location: admin.php');
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
<h1 class="display-4">お知らせ管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2>お知らせ記事の情報を変更します。</h2>
<hr>
<form action="news-output.php" method="post">
	<input type="hidden" name="unsub" value="0">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM info WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {
	echo '	<input type="hidden" name="id" value="', $_GET['id'], '">';
	echo '	<div class="row pt-4">';
	echo '	<div class="col-md-3">';
	echo '		<label for="inputTitle">お知らせタイトル</label>';
	echo '	</div>';
	echo '		<div class="col-md-5">';
	echo '		<input type="text" id="inputTitle" class="form-control" placeholder="お知らせタイトル" name="title" value="', $row['title'], '" required autofocus>';
	echo '	</div>';
	echo '	<div class="col-md-4"></div>';
	echo '</div>';
	echo '';
	echo '<div class="row pt-4">';
	echo '	<div class="col-md-3">';
	echo '		<label for="inputArticle">お知らせ内容</label>';
	echo '	</div>';
	echo '	<div class="col-md-7">';
	echo '		<textarea class="form-control" id="inputArticle" rows="4" placeholder="お知らせ内容" name="article" required>', $row['article'], '</textarea>';
	echo '	</div>';
	echo '	<div class="col-md-2"></div>';
	echo '</div>';
	echo '';
	echo '<div class="row pt-4">';
	echo '	<div class="col-md-3">';
	echo '		<label for="customRadioOnOff">公開状態</label>';
	echo '	</div>';
	if ($row['onoff'] == 1) {
		echo '	<div class="col-md-7">';
		echo '	<div class="custom-control custom-radio custom-control-inline">';
		echo '		<input type="radio" id="customRadioOnOff0" name="onoff" class="custom-control-input" value="0">';
		echo '		<label class="custom-control-label" for="customRadioOnOff0">公開する</label>';
		echo '	</div>';
		echo '	<div class="custom-control custom-radio custom-control-inline">';
		echo '		<input type="radio" id="customRadioOnOff1" name="onoff" class="custom-control-input" value="1" checked>';
		echo '		<label class="custom-control-label" for="customRadioOnOff1">非公開</label>';
		echo '	</div>';
	} else {
		echo '	<div class="col-md-7">';
		echo '	<div class="custom-control custom-radio custom-control-inline">';
		echo '		<input type="radio" id="customRadioOnOff0" name="onoff" class="custom-control-input" value="0" checked>';
		echo '		<label class="custom-control-label" for="customRadioOnOff0">公開する</label>';
		echo '	</div>';
		echo '	<div class="custom-control custom-radio custom-control-inline">';
		echo '		<input type="radio" id="customRadioOnOff1" name="onoff" class="custom-control-input" value="1">';
		echo '		<label class="custom-control-label" for="customRadioOnOff1">非公開</label>';
		echo '	</div>';
	}

	echo '	</div>';
	echo '	<div class="col-md-2"></div>';
	echo '</div>';
}
?>
	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>