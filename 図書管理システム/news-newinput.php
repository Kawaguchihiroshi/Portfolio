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
<h1 class="display-4">お知らせ登録</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2>新しくお知らせを登録します。</h2>
<hr>
<form action="news-newoutput.php" method="post">
	<input type="hidden" name="unsub" value="0">
	<input type="hidden" name="staff_id" value="<?php echo $_SESSION['staff']['id']; ?>">
	<input type="hidden" name="do_date" value="<?php echo date('Y-m-d'); ?>">

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputTitle">お知らせタイトル</label>
		</div>
    		<div class="col-md-5">
			<input type="text" id="inputTitle" class="form-control" placeholder="お知らせタイトル" name="title" required autofocus>
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputArticle">お知らせ内容</label>
		</div>
    	<div class="col-md-7">
			<textarea class="form-control" id="inputArticle" rows="4" placeholder="お知らせ内容" name="article" required></textarea>
		</div>
    	<div class="col-md-2"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="customRadioOnOff">公開状態</label>
		</div>
   		<div class="col-md-7">
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioOnOff0" name="onoff" class="custom-control-input" value="0">
				<label class="custom-control-label" for="customRadioOnOff0">公開する</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioOnOff1" name="onoff" class="custom-control-input" value="1" checked>
				<label class="custom-control-label" for="customRadioOnOff1">非公開</label>
			</div>
		</div>
    	<div class="col-md-2"></div>
	</div>

	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">登録</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>