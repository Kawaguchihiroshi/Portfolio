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
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update staff set name=?, email=?, password=? WHERE id=?');
$sql->execute([
	$_REQUEST['name'], 
	$_REQUEST['email'], 
	$_REQUEST['password'], 
	$_REQUEST['id']
]);

	echo '<h2 class="mt-5">以下の内容に変更いたしました。</h2>';
	echo '<hr>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">氏名</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['name'], '</div>';
 	echo '   	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">メールアドレス</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['email'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">パスワード</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['password'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>