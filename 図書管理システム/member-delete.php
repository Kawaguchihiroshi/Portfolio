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
<h1 class="display-4">訓練生管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update member set unsub=? WHERE id=?');
$sql->execute([
	$_REQUEST['unsub'], 
	$_REQUEST['id']
]);

echo '<h2>以下の内容を削除しました。</h2>';
echo '<hr>';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">氏名</div>';
echo '	    <div class="col-md-9">', $_REQUEST['name'], '</div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">電話番号</div>';
echo '	    <div class="col-md-9 text-truncate">', $_REQUEST['tell'], '</div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">メールアドレス</div>';
echo '	    <div class="col-md-9 text-truncate">', $_REQUEST['email'], '</div>';
echo '	</div>';
echo '';
echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>