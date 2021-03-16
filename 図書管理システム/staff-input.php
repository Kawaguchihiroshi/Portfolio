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
<h1 class="display-4">指導員管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2 class="mt-5">指導員の情報を変更します。</h2>
<hr>
<form action="staff-output.php" method="post">
	<input type="hidden" name="unsub" value="0">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM staff WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {
	echo '	<input type="hidden" name="id" value="', $_GET['id'], '">';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputName">氏名</label>';
	echo '		</div>';
    	echo '	<div class="col-md-5">';
	echo '			<input type="text" id="inputName" class="form-control" name="name" value="', $row['name'], '" required autofocus>';
	echo '		</div>';
	echo '<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputEmail">メールアドレス</label>';
	echo '		</div>';
	echo '<div class="col-md-5">';
	echo '			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $row['email'], '" required>';
	echo '		</div>';
	echo '<div class="col-md-4"></div>';
	echo '</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputPassword">ログインパスワード</label>';
	echo '		</div>';
	echo '	<div class="col-md-5">';
	echo '			<input type="text" id="inputPassword" class="form-control" placeholder="ログインパスワード" name="password" value="', $row['password'], '" required>';
	echo '		</div>';
	echo '	<div class="col-md-4"></div>';
	echo '	</div>';
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