<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
//　管理画面ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: admin-login-input.php" ) ;
exit ;
}
?>
<?php require 'include/admin_header.php'; ?>
<title>管理画面 / カテゴリー情報変更｜NERVE FACTORY</title>
</head>
<body>
<header class="p-4 bg-dark text-white">
<div class="row">
<div class="col-md-3 text-left"><a href="admin-login-output.php"><img src="images/admin_logo.png"></a></div>
<div class="col-md-9 text-right">
<a href="admin-login-output.php" class="btn btn-info btn-sm">ダッシュボード</a>
<a href="index.php" class="btn btn-info btn-sm" target="_blank">サイトを確認</a>
<a href="admin-logout.php" class="btn btn-info btn-sm ml-3">ログアウト</a>
</div>
</div>
</header>
<main class="row">
<?php require 'include/admin_menu.php'; ?>
<div id="main" class="col-md-10 py-5">
<h1 class="mb-5" style="border-bottom: solid 3px #444;">カテゴリー情報変更</h1>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update category set name=?, status=?, number=? where id=?');
$sql->execute([
	$_REQUEST['name'], 
	$_REQUEST['status'], 
	$_REQUEST['number'], 
	$_REQUEST['id']
]);

echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">カテゴリー内容を変更しました。</h2>';
echo '<a href="admin-category-input.php" class="btn btn-info">カテゴリー一覧に戻る</a>';
echo '<a href="admin-login-output.php" class="btn btn-info ml-3">管理画面トップ</a>';
echo '</div>';
?>

</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>