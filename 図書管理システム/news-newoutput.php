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
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('insert into info values(null,?,?,?,?,?,?)');
$sql->execute([
	$_REQUEST['staff_id'], 
	$_REQUEST['do_date'], 
	$_REQUEST['title'], 
	$_REQUEST['article'], 
	$_REQUEST['onoff'],
	$_REQUEST['unsub']
]);

	echo '<h2>以下の内容でお知らせ記事を制作いたしました。</h2>';
	echo '<hr>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">公開状態</div>';
	echo '	    	<div class="col-md-5">';
	if ($_REQUEST['onoff'] == 0) {
		echo '<span class="badge badge-primary">表示中</span>';
	} else {
		echo '<span class="badge badge-secondary">非表示</span>';
	}
	echo '	    	</div>';
 	echo '   	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">お知らせタイトル</div>';
	echo '	    <div class="col-md-9">', $_REQUEST['title'], '</div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">お知らせ内容</div>';
	echo '    	<div class="col-md-9">', $_REQUEST['article'], '</div>';
	echo '	</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';

?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>