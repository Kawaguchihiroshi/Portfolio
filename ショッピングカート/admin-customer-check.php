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
<title>管理画面 / 会員情報確認｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">会員情報確認</h1>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM customer WHERE id=$id";
foreach ($pdo->query($sql) as $row) {
echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">基本情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white py-2">ステータス</div>';
echo '<div class="col-md-10">';
if ($row['status'] == 0) {
echo '<button class="btn btn-success d-inline" disabled>仮会員</button> ';
echo '<button class="btn btn-outline-secondary d-inline" disabled>一般会員</button> ';
echo '<button class="btn btn-outline-secondary d-inline" disabled>退会済</button>';
} else if ($row['status'] == 1) {
echo '<button class="btn btn-outline-secondary d-inline" disabled>仮会員</button> ';
echo '<button class="btn btn-success d-inline" disabled>一般会員</button> ';
echo '<button class="btn btn-outline-secondary d-inline" disabled>退会済</button>';
} else if ($row['del'] == 1) {
echo '<button class="btn btn-outline-secondary d-inline" disabled>仮会員</button> ';
echo '<button class="btn btn-outline-secondary d-inline" disabled>一般会員</button> ';
echo '<button class="btn btn-success d-inline" disabled>退会済</button>';
}
echo '</div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">会員氏名</div>';
echo '<div class="col-md-7 py-2">', $row['name'], '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
echo '<div class="col-md-7 py-2">', $row['tell'], '</div>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
echo '<div class="col-md-6 py-2">', $row['post_no'], '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
echo '<div class="col-md-11 py-2">', $row['adrs'], '</div>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white py-2">メールアドレス</div>';
echo '<div class="col-md-5 py-2">', $row['email'], '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="col-md-3 bg-secondary text-white py-2">パスワード</div>';
echo '<div class="col-md-4 py-2">', $row['password'], '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';
echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">配送先情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-5">';
echo '<div class="col-md-4 bg-secondary text-white py-2">配送先名前</div>';
echo '<div class="col-md-8 py-2">', $row['delivery_name'], '</div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
echo '<div class="col-md-7 py-2">', $row['delivery_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-3"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
echo '<div class="col-md-6 py-2">', $row['delivery_post_no'], '</div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
echo '<div class="col-md-11 py-2">', $row['delivery_adrs'], '</div>';
echo '</div>';
echo '</div>';
echo '<div class="pt-5">';
echo '<a href="admin-customer-del-list.php" class="btn btn-info">退会者一覧</a>';
echo '<a href="admin-index.php" class="ml-3 btn btn-info">管理画面トップ</a>';
echo '</div>';
}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>