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
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update info set title=?, article=?, onoff=? WHERE id=?');
$sql->execute([
	$_REQUEST['title'], 
	$_REQUEST['article'], 
	$_REQUEST['onoff'], 
	$_REQUEST['id']
]);

	echo '<h2 class="mt-5">以下の内容に変更いたしました。</h2>';
	echo '<hr>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">お知らせタイトル</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['title'], '</div>';
 	echo '   	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">お知らせ内容</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['article'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">公開状態</div>';
	echo '	    	<div class="col-md-5">';
	if ($_REQUEST['onoff'] == 0) {
	echo '公開中';
	} else {
	echo '非表示';
	}
	echo '	    	</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>