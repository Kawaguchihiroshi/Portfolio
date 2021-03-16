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
<title>管理画面 / 商品情報変更｜NERVE FACTORY</title>
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
<h1 class="mb-4" style="border-bottom: solid 3px #444;">商品情報変更</h1>

<form action="admin-product-output.php" method="post" enctype="multipart/form-data">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM product WHERE id=$id";
foreach ($pdo->query($sql) as $row) {
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputName">商品名</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<input type="text" id="inputName" class="form-control" placeholder="商品名" name="name" value="', $row['name'], '" required>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputCord">商品コード</label>';
echo '</div>';
echo '<div class="col-md-2">';
echo '<input type="text" id="inputCord" class="form-control" placeholder="商品コード" name="cord" value="', $row['cord'], '" required>';
echo '</div>';
echo '<div class="col-md-7"></div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputPrice">単価</label>';
echo '</div>';
echo '<div class="col-md-2">';
echo '<input type="text" id="inputPrice" class="form-control" placeholder="単価" name="price" value="', $row['price'], '" required>';
echo '</div>';
echo '<div class="col-md-7"></div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStock">在庫数</label>';
echo '</div>';
echo '<div class="col-md-1">';
echo '<input type="text" id="inputStock" class="form-control" placeholder="在庫数" name="stock" value="', $row['stock'], '" required>';
echo '</div>';
echo '<div class="col-md-8"></div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputMainImg">メイン画像</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<div><img src="', $row['img_main'], '" width="100"></div>';
echo '<div class="py-2 small">※差し替える場合のみファイルを選択してください。</div>';
echo '<input type="file" class="form-control-file" id="inputMainImg" name="img_main">';
	echo '<input type="hidden" name="main_img" value="', $row['img_main'], '">';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputSubImg001">サブ画像001</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<div><img src="', $row['img001'], '" width="100"></div>';
echo '<div class="py-2 small">※差し替える場合のみファイルを選択してください。</div>';
echo '<input type="file" class="form-control-file" id="inputSubImg001" name="img001">';
		echo '<input type="hidden" name="001img" value="', $row['img001'], '">';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputSubImg002">サブ画像002</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<div><img src="', $row['img002'], '" width="100"></div>';
echo '<div class="py-2 small">※差し替える場合のみファイルを選択してください。</div>';
echo '<input type="file" class="form-control-file" id="inputSubImg002" name="img002">';
		echo '<input type="hidden" name="002img" value="', $row['img002'], '">';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputSubImg003">サブ画像003</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<div><img src="', $row['img003'], '" width="100"></div>';
echo '<div class="py-2 small">※差し替える場合のみファイルを選択してください。</div>';
echo '<input type="file" class="form-control-file" id="inputSubImg003" name="img003">';
	echo '<input type="hidden" name="003img" value="', $row['img003'], '">';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="textareaContent">商品詳細</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<textarea class="form-control" placeholder="商品詳細" id="textareaContent" rows="5" name="prod_content" required>', $row['prod_content'], '</textarea>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="textareaAttention">注意事項</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<textarea class="form-control" placeholder="注意事項" id="textareaAttention" rows="5" name="prod_attention" required>', $row['prod_attention'], '</textarea>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">表示設定</label>';
echo '</div>';
if($row['onoff'] == 0) {
echo '<div class="col-md-9">';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="onoff" id="inlineRadio2" value="0" checked>';
echo '<label class="form-check-label" for="inlineRadio2">表示</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="onoff" id="inlineRadio3" value="1">';
echo '<label class="form-check-label" for="inlineRadio3">非表示</label>';
echo '</div>';
echo '</div>';
} else {
echo '<div class="col-md-9">';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="onoff" id="inlineRadio2" value="0">';
echo '<label class="form-check-label" for="inlineRadio2">表示</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="onoff" id="inlineRadio3" value="1" checked>';
echo '<label class="form-check-label" for="inlineRadio3">非表示</label>';
echo '</div>';
echo '</div>';
}
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">おすすめ商品表示</label>';
echo '</div>';
if($row['recommended'] == 0) {
echo '<div class="col-md-9">';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="recommended" id="inlineRadio2" value="0" checked>';
echo '<label class="form-check-label" for="inlineRadio2">表示する</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="recommended" id="inlineRadio3" value="1">';
echo '<label class="form-check-label" for="inlineRadio3">表示しない</label>';
echo '</div>';
echo '</div>';
} else {
echo '<div class="col-md-9">';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="recommended" id="inlineRadio2" value="0">';
echo '<label class="form-check-label" for="inlineRadio2">表示する</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="recommended" id="inlineRadio3" value="1" checked>';
echo '<label class="form-check-label" for="inlineRadio3">表示しない</label>';
echo '</div>';
echo '</div>';
}
echo '</div>';

echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">カテゴリー設定01</label>';
echo '</div>';
echo '<div class="col-md-9">';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $cote) {
echo '<div class="form-check form-check-inline">';
if ($row['cate_id01'] == $cote['id']) {
echo '<input class="form-check-input" type="radio" name="cate_id01" id="inlineRadio1', $NUMBER, '" value="', $cote['id'], '" checked>';
} else {
echo '<input class="form-check-input" type="radio" name="cate_id01" id="inlineRadio1', $NUMBER, '" value="', $cote['id'], '">';
}
echo '<label class="form-check-label" for="inlineRadio1', $NUMBER, '">', $cote['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}

echo '</div>';
echo '</div>';

echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">カテゴリー設定02</label>';
echo '</div>';
echo '<div class="col-md-9">';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $cote) {
echo '<div class="form-check form-check-inline">';
if ($row['cate_id02'] == $cote['id']) {
echo '<input class="form-check-input" type="radio" name="cate_id02" id="inlineRadio2', $NUMBER, '" value="', $cote['id'], '" checked>';
} else {
echo '<input class="form-check-input" type="radio" name="cate_id02" id="inlineRadio2', $NUMBER, '" value="', $cote['id'], '">';
}
echo '<label class="form-check-label" for="inlineRadio2', $NUMBER, '">', $cote['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}

echo '</div>';
echo '</div>';

echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">カテゴリー設定03</label>';
echo '</div>';
echo '<div class="col-md-9">';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $cote) {
echo '<div class="form-check form-check-inline">';
if ($row['cate_id03'] == $cote['id']) {
echo '<input class="form-check-input" type="radio" name="cate_id03" id="inlineRadio3', $NUMBER, '" value="', $cote['id'], '" checked>';
} else {
echo '<input class="form-check-input" type="radio" name="cate_id03" id="inlineRadio3', $NUMBER, '" value="', $cote['id'], '">';
}
echo '<label class="form-check-label" for="inlineRadio3', $NUMBER, '">', $cote['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}

echo '</div>';
echo '</div>';
}
?>
<div class="pt-5">
<button class="btn btn-info" type="submit">変更</button> <button class="btn btn-light" type="reset">クリア</button>
</div>
</form>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>