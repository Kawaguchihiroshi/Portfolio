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
echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">基本情報</h3>';
echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white">会員IDabel></div>';
echo '<div class="col-md-10 h4">', $row['customer_no'], '</div>';
echo '</div>';

echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white">ステータス</div>';
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
echo '<div class="col-md-5 bg-secondary text-white">会員氏名</div>';
echo '<div class="col-md-7"><input type="text" id="inputName" class="form-control" placeholder="会員氏名" name="name" value="', $row['name'], '" required autofocus></div>';
echo '</div>';
echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white">電話番号</div>';
echo '<div class="col-md-7"><input type="text" id="inputTell" class="form-control" placeholder="ハイフンなし11桁" name="tell" value="', $row['tell'], '" required></div>';
echo '</div>';
echo '<div class="col-md-5"></div>';
echo '</div>';

echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white">郵便番号</div>';
echo '<div class="col-md-6"><input type="text" id="inputPostad" class="form-control" placeholder="郵便番号" name="post_no" value="', $row['post_no'], '" required></div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white">住所</div>';
echo '<div class="col-md-11"><input type="text" id="inputAddress" class="form-control" placeholder="住所" name="adrs" value="', $row['adrs'], '" required></div>';
echo '</div>';
echo '</div>';

echo '<div class="row mt-4">';
echo '<div class="col-md-2 bg-secondary text-white">メールアドレス</div>';
echo '<div class="col-md-5"><input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $row['email'], '" required></div>';
echo '<div class="col-md-5"></div>';
echo '</div>';

echo '<div class="row mt-4">';
echo '<div class="col-md-3 bg-secondary text-white">パスワード</div>';
echo '<div class="col-md-4"><input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" value="', $row['password'], '" required></div>';
echo '<div class="col-md-5"></div>';
echo '</div>';

echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">配送先情報</h3>';

echo '<div class="row mt-4">';
echo '<div class="row col-md-5">';
echo '<div class="col-md-4 bg-secondary text-white">配送先名前</div>';
echo '<div class="col-md-8"><input type="text" id="inputDeliveryName" class="form-control" placeholder="配送先名前" name="delivery_name" value="', $row['delivery_name'], '" required></div>';
echo '</div>';

echo '<div class="row col-md-4">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 bg-secondary text-white">電話番号</div>';
echo '<div class="col-md-7"><input type="text" id="inputDeliveryTell" class="form-control" placeholder="ハイフンなし11桁" name="delivery_tell" value="', $row['delivery_tell'], '" required></div>';
echo '</div>';

echo '<div class="col-md-3"></div>';
echo '</div>';
echo '<div class="row mt-4">';
echo '<div class="row col-md-3">';
echo '<div class="col-md-5 bg-secondary text-white">郵便番号</div>';
echo '<div class="col-md-6"><input type="text" id="inputDeliveryPostad" class="form-control" placeholder="郵便番号" name="delivery_post_no" value="', $row['delivery_post_no'], '" required></div>';
echo '<div class="col-md-1"></div>';
echo '</div>';
echo '<div class="row col-md-9">';
echo '<div class="col-md-1 bg-secondary text-white">住所</div>';
echo '<div class="col-md-11"><input type="text" id="inputDeliveryAddress" class="form-control" placeholder="住所" name="delivery_adrs" value="', $row['delivery_adrs'], '" required></div>';
echo '</div>';
echo '</div>';

echo '<div class="pt-5">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="level" value="0">';
echo '<button class="btn btn-info d-inline" type="submit">変更</button>';
echo '</form>';

echo '<a href="admin-customer-output.php?level=4&id=', $row['id'], '&customer_no=', $row['customer_no'], '&name=', $row['name'], '&email=', $row['email'], '" class="btn btn-info ml-3">会員に送信</a>';
if ($row['status'] == 0) {
echo '<div class="col-md-3 ml-3"><a href="admin-customer-output.php?level=3&id=', $row['id'], '&customer_no=', $row['customer_no'], '&name=', $row['name'], '&email=', $row['email'], '" class="btn btn-info">アドレス確認を再送信</a>';
}
echo '<button class="btn btn-light d-inline ml-3" type="reset">クリア</button></div>';
echo '</div>';

}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>