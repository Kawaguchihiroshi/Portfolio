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
<h1 class="mb-4" style="border-bottom: solid 3px #444;">商品登録</h1>

<form action="admin-product-outcsv.php" method="post" class="d-inline text-right" enctype="multipart/form-data">
<div class="row mb-4">
<div class="col-md-6">
<div class="input-group">
<div class="input-group-prepend"><div class="input-group-text">CSVインポート</div></div>
<input type="file" class="form-control" name="csv_data">
<div class="input-group-append"><button class="btn btn-info" type="submit">インポート</button></div>
</div>
</div>
<div class="col-md-6 text-left">
<a href="images/sample_exsel.xlsx" class="btn btn-info"><i class="fas fa-download"></i> サンプルエクセルファイル</a>
<a href="images/sample.csv" class="btn btn-info ml-3"><i class="fas fa-download"></i> サンプルCSVファイル</a>
</div>
</div>


</form>

<form action="admin-product-newoutput.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="del" value="0">

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputName">商品名</label>
</div>
<div class="col-md-9">
<input type="text" id="inputName" class="form-control" placeholder="商品名" name="name" required>
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputCord">商品コード</label>
</div>
<div class="col-md-2">
<input type="text" id="inputCord" class="form-control" placeholder="商品コード" name="cord" required>
</div>
<div class="col-md-7"></div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputPrice">単価</label>
</div>
<div class="col-md-2">
<input type="text" id="inputPrice" class="form-control" placeholder="単価" name="price" required>
</div>
<div class="col-md-7"></div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStock">在庫数</label>
</div>
<div class="col-md-1">
<input type="text" id="inputStock" class="form-control" placeholder="在庫数" name="stock" required>
</div>
<div class="col-md-8"></div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputMainImg">メイン画像</label>
</div>
<div class="col-md-9">
<input type="file" class="form-control-file" id="inputMainImg" name="img_main">
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputSubImg001">サブ画像001</label>
</div>
<div class="col-md-9">
<input type="file" class="form-control-file" id="inputSubImg001" name="img001">
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputSubImg002">サブ画像002</label>
</div>
<div class="col-md-9">
<input type="file" class="form-control-file" id="inputSubImg002" name="img002">
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputSubImg003">サブ画像003</label>
</div>
<div class="col-md-9">
<input type="file" class="form-control-file" id="inputSubImg003" name="img003">
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="textareaContent">商品詳細</label>
</div>
<div class="col-md-9">
<textarea class="form-control" placeholder="商品詳細" id="textareaContent" rows="5" name="prod_content" required></textarea>
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="textareaAttention">注意事項</label>
</div>
<div class="col-md-9">
<textarea class="form-control" placeholder="注意事項" id="textareaAttention" rows="5" name="prod_attention" required></textarea>
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">表示設定</label>
</div>
<div class="col-md-9">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="onoff" id="inlineRadio2" value="0" checked>
<label class="form-check-label" for="inlineRadio2">表示</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="onoff" id="inlineRadio3" value="1">
<label class="form-check-label" for="inlineRadio3">非表示</label>
</div>
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">おすすめ商品表示</label>
</div>
<div class="col-md-9">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="recommended" id="inlineRadio2" value="0">
<label class="form-check-label" for="inlineRadio2">表示する</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="recommended" id="inlineRadio3" value="1" checked>
<label class="form-check-label" for="inlineRadio3">表示しない</label>
</div>
</div>
</div>

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">カテゴリー設定01</label>
</div>
<div class="col-md-9">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $row) {
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="cate_id01" id="inlineRadio1', $NUMBER, '" value="', $row['id'], '">';
echo '<label class="form-check-label" for="inlineRadio1', $NUMBER, '">', $row['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}
?>
</div>
</div>

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">カテゴリー設定02</label>
</div>
<div class="col-md-9">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $row) {
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="cate_id02" id="inlineRadio2', $NUMBER, '" value="', $row['id'], '">';
echo '<label class="form-check-label" for="inlineRadio2', $NUMBER, '">', $row['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}
?>
</div>
</div>

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">カテゴリー設定03</label>
</div>
<div class="col-md-9">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE status=2 AND del=0";
$NUMBER = 1;	// 該当記事数
foreach ($pdo->query($sql) as $row) {
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="cate_id03" id="inlineRadio3', $NUMBER, '" value="', $row['id'], '">';
echo '<label class="form-check-label" for="inlineRadio3', $NUMBER, '">', $row['name'], '</label>';
if ($NUMBER == 6) {
echo '</div><br />';
} else {
echo '</div>';
}
$NUMBER++;
}
?>
</div>
</div>

<div class="pt-5">
<button class="btn btn-info" type="submit">登録</button> <button class="btn btn-light" type="reset">クリア</button>
</div>
</form>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>