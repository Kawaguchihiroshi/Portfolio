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
<title>管理画面 / 会員情報変更｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">会員情報変更</h1>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM customer WHERE id=$id";
foreach ($pdo->query($sql) as $row) {
echo '<form action="admin-customer-output.php" method="post">';
echo '<h3 class="row mt-5">基本情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-info text-white">';
echo '<label for="inputName">会員氏名</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputName" class="form-control" placeholder="会員氏名" name="name" value="', $row['name'], '" required autofocus>';
echo '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-info text-white">';
echo '<label for="inputTell">電話番号</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputTell" class="form-control" placeholder="ハイフンなし11桁" name="tell" value="', $row['tell'], '" required>';
echo '</div>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-info text-white">';
echo '<label for="inputPostad">郵便番号</label>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<input type="text" id="inputPostad" class="form-control" placeholder="郵便番号" name="post_no" value="', $row['post_no'], '" required>';
echo '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-info text-white">';
echo '<label for="inputAddress">住所</label>';
echo '</div>';
echo '<div class="col-md-11">';
echo '<input type="text" id="inputAddress" class="form-control" placeholder="住所" name="adrs" value="', $row['adrs'], '" required>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-info text-white">';
echo '<label for="inputEmail">メールアドレス</label>';
echo '</div>';
echo '<div class="col-md-5">';
echo '<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $row['email'], '" required>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="col-md-3 bg-info text-white">';
echo '<label for="inputPassword">パスワード</label>';
echo '</div>';
echo '<div class="col-md-4">';
echo '<input type="text" id="inputPassword" class="form-control" placeholder="パスワード" name="password" value="', $row['password'], '" required>';
echo '</div>';
echo '<div class="col-md-2"><button class="btn btn-sm btn-info" type="submit">会員に送信</button></div>';
echo '<div class="col-md-3"></div>';
echo '</div>';
echo '';
echo '<h3 class="row mt-5">配送先情報</h3>';
echo '<div class="row mt-2">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-info text-white">';
echo '<label for="inputName">会員氏名</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputName" class="form-control" placeholder="会員氏名" name="name" value="', $row['name'], '" required autofocus>';
echo '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-info text-white">';
echo '<label for="inputTell">電話番号</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputTell" class="form-control" placeholder="ハイフンなし11桁" name="tell" value="', $row['tell'], '" required>';
echo '</div>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-info text-white">';
echo '<label for="inputPostad">郵便番号</label>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<input type="text" id="inputPostad" class="form-control" placeholder="郵便番号" name="post_no" value="', $row['post_no'], '" required>';
echo '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-info text-white">';
echo '<label for="inputAddress">住所</label>';
echo '</div>';
echo '<div class="col-md-11">';
echo '<input type="text" id="inputAddress" class="form-control" placeholder="住所" name="adrs" value="', $row['adrs'], '" required>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '';
echo '	<div class="row pt-5">';
echo '		<div class="col-md-2"></div>';
echo '		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>';
echo '		<div class="col-md-2"></div>';
echo '		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>';
echo '		<div class="col-md-2"></div>';
echo '	</div>';
echo '</form>';
}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>