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
<title>管理画面 / 
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 商品一覧に関する処理
echo '商品一覧';
break;

case '10':	// 商品検索結果に関する処理
echo '商品検索';
break;
}
?>
｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 商品一覧に関する処理
echo '商品一覧';
break;

case '10':	// 商品検索結果に関する処理
echo '商品検索';
break;
}
?>
</h1>

<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 商品一覧に関する処理 ----------------------------------------------------------------------------------------------------------------------------------
echo '<form action="admin-product-list.php?pg=1&level=10" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">商品検索</div></div>';
echo '<input type="text" class="form-control" placeholder="商品検索" name="word">';
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※商品検索は「商品名」「商品コード」「価格」「商品詳細」「注意事項」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-product-newinput.php">新しく商品を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-1 text-center">状態</div>';
echo '<div class="col-2">商品コード</div>';
echo '<div class="col-5">商品名</div>';
echo '<div class="col-1 text-center">在庫数</div>';
echo '<div class="col-1 text-center">おすすめ</div>';
echo '<div class="col-2">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM product WHERE del=0 ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当商品数
foreach ($pdo->query($sql) as $row) {
if ($NUMBER % 2 == 1) {
echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
} else {
echo '<div class="row bg-light py-2" style="border-bottom: dotted 1px #444;">';
}
if ($row['onoff'] == 0) {
echo '<div class="col-1 text-center h5"><span class="badge badge-primary">表示中</span></div>';
} else {
echo '<div class="col-1 text-center h5"><span class="badge badge-secondary">非表示</span></div>';
}
echo '<div class="col-2">', $row['cord'], '</div>';
echo '<div class="col-1"><img class="w-100" src="', $row['img_main'], '"></div>';
echo '<div class="col-4">', $row['name'], '</div>';
echo '<div class="col-1 text-center">', $row['stock'], '</div>';
if ($row['recommended'] == 0) {
echo '<div class="col-1 text-center text-danger" style="font-weight: bold;">〇</div>';
} else {
echo '<div class="col-1 text-center">×</div>';
}
echo '<div class="col-2">';
echo '<form action="admin-product-input.php" method="post" class="d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<button class="btn btn-info btn-sm ml-2" type="submit">変更</button>';
echo '</form>';
echo '<form action="admin-product-output.php" method="post" class="d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="del" value="1">';
echo '<input type="hidden" name="level" value="2">';
echo '<button class="btn btn-info btn-sm ml-2" type="submit">削除</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$NUMBER++;
}
if($NUMBER == 0) {
echo '<div class="bg-white p-5">';
echo '現在、商品は登録されていません。';
echo '</div>';
}


echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '10':	// 商品検索結果に関する処理 ----------------------------------------------------------------------------------------------------------------------------------
echo '<form action="admin-customer-list.php?pg=1&level=10" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">商品検索</div></div>';
if (empty($_REQUEST['word'])) {
	echo '<input type="text" class="form-control" placeholder="商品検索" name="word">';
	$search = '';
} else {
	echo '<input type="text" class="form-control" placeholder="商品検索" name="word" value="', $_REQUEST['word'], '">';
	$search = htmlspecialchars($_REQUEST['word']);
}
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※商品検索は「商品名」「商品コード」「価格」「商品詳細」「注意事項」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-product-newinput.php">新しく商品を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE ( name LIKE '%$search%' OR cord LIKE '%$search%' OR prod_content LIKE '%$search%' OR prod_attention LIKE '%$search%' OR price LIKE '%$search%' ) AND onoff=0 AND del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-1 text-center">状態</div>';
echo '<div class="col-2">商品コード</div>';
echo '<div class="col-5">商品名</div>';
echo '<div class="col-1 text-center">在庫数</div>';
echo '<div class="col-1 text-center">おすすめ</div>';
echo '<div class="col-2">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM product WHERE ( name LIKE '%$search%' OR cord LIKE '%$search%' OR prod_content LIKE '%$search%' OR prod_attention LIKE '%$search%' OR price LIKE '%$search%' ) AND onoff=0 AND del=0 ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当商品数
foreach ($pdo->query($sql) as $row) {
if ($NUMBER % 2 == 1) {
echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
} else {
echo '<div class="row bg-light py-2" style="border-bottom: dotted 1px #444;">';
}
if ($row['onoff'] == 0) {
echo '<div class="col-1 text-center h5"><span class="badge badge-primary">表示中</span></div>';
} else {
echo '<div class="col-1 text-center h5"><span class="badge badge-secondary">非表示</span></div>';
}
echo '<div class="col-2">', $row['cord'], '</div>';
echo '<div class="col-1"><img class="w-100" src="', $row['img_main'], '"></div>';
echo '<div class="col-4">', $row['name'], '</div>';
echo '<div class="col-1 text-center">', $row['stock'], '</div>';
if ($row['recommended'] == 0) {
echo '<div class="col-1 text-center text-danger" style="font-weight: bold;">〇</div>';
} else {
echo '<div class="col-1 text-center">×</div>';
}
echo '<div class="col-2">';
echo '<form action="admin-product-input.php" method="post" class="d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<button class="btn btn-info btn-sm ml-2" type="submit">変更</button>';
echo '</form>';
echo '<form action="admin-product-output.php" method="post" class="d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="del" value="1">';
echo '<input type="hidden" name="level" value="2">';
echo '<button class="btn btn-info btn-sm ml-2" type="submit">削除</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$NUMBER++;
}
if($NUMBER == 0) {
echo '<div class="bg-white p-5">';
echo '「', $_REQUEST['word'], '」の内容を含む商品はありませんでした。';
echo '</div>';
}


echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE ( name LIKE '%$search%' OR cord LIKE '%$search%' OR prod_content LIKE '%$search%' OR prod_attention LIKE '%$search%' OR price LIKE '%$search%' ) AND onoff=0 AND del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-product-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;
}
?>

</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>