<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
	header('Location: admin.php');
}
if ($_SESSION['staff']['login_name'] != "administrator") {
	header('Location: admin-login-output.php');
}
if ($_SESSION['staff']['login_name'] != "a_test") {
	header('Location: admin-login-output.php');
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
<h1 class="display-4">指導員登録</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2>新しく指導員を登録します。</h2>
<hr>
<form action="staff-newoutput.php" method="post">
	<input type="hidden" name="unsub" value="0">
	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputName">氏名</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputName" class="form-control" placeholder="氏名" name="name" required autofocus>
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputEmail">メールアドレス</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputLoginID">指導員ログインID</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputLoginID" class="form-control" placeholder="指導員ログインID" name="login_name" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputPassword">ログインパスワード</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputPassword" class="form-control" placeholder="ログインパスワード" name="password" required>
		</div>
    		<div class="col-md-4"></div>
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