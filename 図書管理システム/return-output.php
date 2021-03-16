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
<?php
if ($_REQUEST['return_check'] == 1) {
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update rentdata set return_date=?, return_check=? WHERE id=?');
$sql->execute([
	$_REQUEST['return_date'],
	$_REQUEST['return_check'],
	$_REQUEST['id']
]);

	echo '<h2>返却処理を行いました。</h2>';
	echo '<hr />';
	echo '<div class="pt-4">返却された本を本棚に戻してください。</div>';
	echo '';
	echo '<div class="mt-5"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る <i class="fas fa-chevron-circle-right"></i></a></div>';


} else {

	echo '<h2 class="text-danger">返却処理が行えませんでした。</h2>';
	echo '<hr />';
	echo '<div class="pt-4">返却された本が手元にあるか確認し、返却確認を「返却完了」にチェックを入れてください。</div>';
	echo '';
	echo '<div class="mt-5"><a class="btn btn-secondary" href="lending-list-allmember.php">貸出申請管理に戻る <i class="fas fa-chevron-circle-right"></i></a></div>';

}
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>