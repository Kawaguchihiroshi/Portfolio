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
<title>管理画面 / 商品登録｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">商品登録</h1>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');

$file_main='img/no_image.png';
$file01='img/no_image.png';
$file02='img/no_image.png';
$file03='img/no_image.png';
if (empty($_REQUEST['cate_id01'])) {
$cat01='100';
} else {
$cat01=$_REQUEST['cate_id01'];
}
if (empty($_REQUEST['cate_id02'])) {
$cat02='100';
} else {
$cat02=$_REQUEST['cate_id02'];
}
if (empty($_REQUEST['cate_id03'])) {
$cat03='100';
} else {
$cat03=$_REQUEST['cate_id03'];
}

$sql=$pdo->prepare('insert into product values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,0)');
$sql->execute([
	$_REQUEST['name'], 
	$_REQUEST['cord'], 
	$_REQUEST['price'], 
	$_REQUEST['stock'], 
	$file_main, 
	$file01, 
	$file02, 
	$file03, 
	$_REQUEST['prod_content'], 
	$_REQUEST['prod_attention'], 
	$_REQUEST['recommended'], 
	$cat01, 
	$cat02, 
	$cat03, 
	$_REQUEST['onoff']
]);

if (!file_exists('img')) {
	mkdir('img');
}

if (is_uploaded_file($_FILES['img_main']['tmp_name'])) {

	$file_main='img/'.rand(00000, 99999).basename($_FILES['img_main']['name']);

	if (move_uploaded_file($_FILES['img_main']['tmp_name'], $file_main)) {

		$sql=$pdo->prepare('update product set img_main=? where cord=?');
		$sql->execute([
			$file_main, 
			$_REQUEST['cord']
		]);
	}
}
if (is_uploaded_file($_FILES['img001']['tmp_name'])) {

	$file01='img/'.rand(00000, 99999).basename($_FILES['img001']['name']);

	if (move_uploaded_file($_FILES['img001']['tmp_name'], $file01)) {

		$sql=$pdo->prepare('update product set img001=? where cord=?');
		$sql->execute([
			$file01, 
			$_REQUEST['cord']
		]);
	}
}
if (is_uploaded_file($_FILES['img002']['tmp_name'])) {

	$file02='img/'.rand(00000, 99999).basename($_FILES['img002']['name']);

	if (move_uploaded_file($_FILES['img002']['tmp_name'], $file02)) {

		$sql=$pdo->prepare('update product set img002=? where cord=?');
		$sql->execute([
			$file02, 
			$_REQUEST['cord']
		]);
	}
}
if (is_uploaded_file($_FILES['img003']['tmp_name'])) {

	$file03='img/'.rand(00000, 99999).basename($_FILES['img003']['name']);

	if (move_uploaded_file($_FILES['img003']['tmp_name'], $file03)) {

		$sql=$pdo->prepare('update product set img003=? where cord=?');
		$sql->execute([
			$file03, 
			$_REQUEST['cord']
		]);
	}
}

echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">以下、内容を登録しました。</h2>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">商品名</div>';
echo '<div class="col-md-9">', $_REQUEST['name'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">単価</div>';
echo '<div class="col-md-9">', $_REQUEST['price'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">在庫数</div>';
echo '<div class="col-md-9">', $_REQUEST['stock'], '</div>';
echo '</div>';
if (!empty($_FILES['img_main'])) {
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">メイン画像</div>';
echo '<div class="col-md-3"><img class="w-100" src="', $file_main, '"></div>';
echo '<div class="col-md-6"></div>';
echo '</div>';
}
if (!empty($_FILES['img001'])) {
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">サブ画像001</div>';
echo '<div class="col-md-3"><img class="w-100" src="', $file01, '"></div>';
echo '<div class="col-md-6"></div>';

echo '</div>';
}
if (!empty($_FILES['img002'])) {
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">サブ画像002</div>';
echo '<div class="col-md-3"><img class="w-100" src="', $file02, '"></div>';
echo '<div class="col-md-6"></div>';
echo '</div>';
}
if (!empty($_FILES['img003'])) {
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">サブ画像003</div>';
echo '<div class="col-md-3"><img class="w-100" src="', $file03, '"></div>';
echo '<div class="col-md-6"></div>';
echo '</div>';
}
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">商品詳細</div>';
echo '<div class="col-md-9">', $_REQUEST['prod_content'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">注意事項</div>';
echo '<div class="col-md-9">', $_REQUEST['prod_attention'], '</div>';
echo '</div>';
echo '<div class="row mb-2">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">おすすめ商品</div>';
if ($_REQUEST['recommended'] == 0) {
echo '<div class="col-md-9">表示する</div>';
} else {
echo '<div class="col-md-9">表示しない</div>';
}
echo '</div>';
if (!empty($_REQUEST['cate_id01'])) {
	echo '<div class="row mb-2">';
	echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示カテゴリー</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM category WHERE id=?');
	$sql->execute([$_REQUEST['cate_id01']]);
	foreach ($sql as $row) {
		echo '<div class="col-md-9">', $row['name'], '</div>';
	}
	echo '</div>';
}
if (!empty($_REQUEST['cate_id02'])) {
	echo '<div class="row mb-2">';
	echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示カテゴリー</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM category WHERE id=?');
	$sql->execute([$_REQUEST['cate_id02']]);
	foreach ($sql as $row) {
		echo '<div class="col-md-9">', $row['name'], '</div>';
	}
	echo '</div>';
}
if (!empty($_REQUEST['cate_id03'])) {
	echo '<div class="row mb-2">';
	echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示カテゴリー</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM category WHERE id=?');
	$sql->execute([$_REQUEST['cate_id03']]);
	foreach ($sql as $row) {
		echo '<div class="col-md-9">', $row['name'], '</div>';
	}
	echo '</div>';
}
echo '<div class="row mb-5">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">表示設定</div>';
if ($_REQUEST['onoff'] == 0) {
echo '<div class="col-md-9">表示</div>';
} else {
echo '<div class="col-md-9">非表示</div>';
}
echo '</div>';
echo '<a href="admin-product-list.php" class="btn btn-info">商品一覧</a>';
echo '<a href="admin-index.php" class="ml-3 btn btn-info">管理画面トップ</a>';
echo '</div>';
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>