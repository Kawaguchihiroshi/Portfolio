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
<title>管理画面 / お問い合わせ内容確認｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">お問い合わせ内容確認</h1>

<?php
echo '<h3 class="mt-5" style="border-bottom: solid 1px #444;">基本情報</h3>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE email=?');
$sql->execute([$_REQUEST['email']]);
foreach ($sql->fetchAll() as $cust) { 
	echo '<div class="row mt-4">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">会員ID</div>';
	echo '<div class="py-2 col-md-10">', $cust['customer_no'], '</div>';
	echo '</div>';
	echo '<div class="row mt-2">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">ステータス</div>';
	echo '<div class="py-2 col-md-10">';
	if ($cust['status'] == 0) {
		echo '<button class="btn btn-success d-inline" disabled>仮会員</button> ';
		echo '<button class="btn btn-outline-secondary d-inline" disabled>一般会員</button> ';
		echo '<button class="btn btn-outline-secondary d-inline" disabled>退会済</button>';
	} else if ($cust['status'] == 1) {
		echo '<button class="btn btn-outline-secondary d-inline" disabled>仮会員</button> ';
		echo '<button class="btn btn-success d-inline" disabled>一般会員</button> ';
		echo '<button class="btn btn-outline-secondary d-inline" disabled>退会済</button>';
	} else if ($cust['del'] == 1) {
		echo '<button class="btn btn-outline-secondary d-inline" disabled>仮会員</button> ';
		echo '<button class="btn btn-outline-secondary d-inline" disabled>一般会員</button> ';
		echo '<button class="btn btn-success d-inline" disabled>退会済</button>';
	}
	echo '</div>';
	echo '</div>';
}

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM contact WHERE id=$id";
foreach ($pdo->query($sql) as $row) {

	echo '<div class="row mt-4">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">氏名</div>';
	echo '<div class="py-2 col-md-10">', $row['name'], '</div>';
	echo '</div>';
	echo '<div class="row mt-2">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">メールアドレス</div>';
	echo '<div class="py-2 col-md-10">', $row['email'], '</div>';
	echo '</div>';


	echo '<h3 class="mt-5" style="border-bottom: solid 1px #444;">お問い合わせ情報</h3>';
	echo '<div class="row mt-4">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">タイトル</div>';
	echo '<div class="py-2 col-md-10">', $row['title'], '</div>';
	echo '</div>';
	echo '<div class="row mt-2">';
	echo '<div class="py-2 col-md-2 bg-secondary text-white">お問い合わせ内容</div>';
	echo '<div class="py-2 col-md-10">', $row['content'], '</div>';
	echo '</div>';

	echo '<div class="pt-5">';
	echo '<form action="admin-contact-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '" />';
	echo '<input type="hidden" name="status" value="2" />';
	echo '<button class="btn btn-info d-inline" type="submit">返信済み</button>';
	echo '</form>';
	echo '<form action="admin-contact-output.php" method="post" class="ml-3 d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '" />';
	echo '<input type="hidden" name="status" value="3" />';
	echo '<button class="btn btn-info d-inline" type="submit">解決済み</button>';
	echo '</form>';
	echo '<form action="admin-contact-output.php" method="post" class="ml-3 d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '" />';
	echo '<input type="hidden" name="del" value="1" />';
	echo '<button class="btn btn-info d-inline" type="submit">削除</button>';
	echo '</form>';
	echo '</div>';

}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>