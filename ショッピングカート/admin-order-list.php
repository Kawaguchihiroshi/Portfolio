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
<title>管理画面 / <?php require 'include/admin_order.php'; ?>｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;"><?php require 'include/admin_order.php'; ?></h1>


<?php
$pref = $_REQUEST['level'];

switch ($pref){
case '0':	// 注文者一覧に関する処理 ---------------------------------------------------------------------------------------------------------------
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE ( status=0 OR status=1 ) AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white px-2 py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-1">確認</div>';
echo '<div class="col-2">注文番号</div>';
echo '<div class="col-2">購入者</div>';
echo '<div class="col-2">注文日</div>';
echo '<div class="col-5">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE ( status=0 OR status=1 ) AND cancel=0 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	if ($NUMBER % 2 == 0) {
		echo '<div class="row bg-light p-2" style="border-bottom: dotted 1px #444;">';
	} else {
		echo '<div class="row bg-white p-2" style="border-bottom: dotted 1px #444;">';
	}
	echo '<div class="col-1 h5 mb-0">';
	if ($row['status'] == 0) {
		echo '<span class="badge badge-secondary">未確認</span>';
	} else {
		echo '<span class="badge badge-success">確認済み</span>';
	}
	echo '</div>';
	echo '<div class="col-2">', $row['order_no'], '</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
	$sql->execute([$row['cost_id']]);
	foreach($sql->fetchAll() as $cust){
		echo '<div class="col-2">', $cust['name'], '</div>';
	}
	echo '<div class="col-2">', $row['order_date'], '</div>';
	echo '<div class="col-5">';
	if ($row['status'] == 0) {
		echo '<form class="d-inline" action="admin-order-input.php" method="post">';
		echo '<input type="hidden" name="id" value="', $row['id'], '">';
		echo '<input type="hidden" name="level" value="', $_REQUEST['level'], '">';
		echo '<input type="hidden" name="cost_id" value="', $row['cost_id'], '">';
		echo '<button class="btn btn-info btn-sm" type="submit">注文内容を確認</button>';
		echo '</form>';
	} else {
		echo '<form class="d-inline" action="admin-order-input.php" method="post">';
		echo '<input type="hidden" name="id" value="', $row['id'], '">';
		echo '<input type="hidden" name="level" value="', $_REQUEST['level'], '">';
		echo '<input type="hidden" name="cost_id" value="', $row['cost_id'], '">';
		echo '<button class="btn btn-info btn-sm" type="submit">支払い金額を確認</button>';
		echo '</form>';
	}
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '現在、購入者はいません。';
	echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE ( status=0 OR status=1 ) AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '1':	// 支払完了者一覧に関する処理 ---------------------------------------------------------------------------------------------------------------
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE status=2 AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white px-2 py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">注文番号</div>';
echo '<div class="col-2">購入者</div>';
echo '<div class="col-2">注文日</div>';
echo '<div class="col-2">支払い日</div>';
echo '<div class="col-4">操作</div>';
echo '</div>';


$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=2 AND cancel=0 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	if ($NUMBER % 2 == 0) {
		echo '<div class="row bg-light p-2" style="border-bottom: dotted 1px #444;">';
	} else {
		echo '<div class="row bg-white p-2" style="border-bottom: dotted 1px #444;">';
	}
	echo '<div class="col-2">', $row['order_no'], '</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
	$sql->execute([$row['cost_id']]);
	foreach($sql->fetchAll() as $ad){
		echo '<div class="col-2">', $ad['name'], '</div>';
	}
	echo '<div class="col-2">', $row['order_date'], '</div>';
	echo '<div class="col-2">', $row['payment_date'], '</div>';

	echo '<div class="col-4">';
	echo '<form class="d-inline" action="admin-order-input.php" method="post">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<input type="hidden" name="cost_id" value="', $row['cost_id'], '">';
	echo '<button class="btn btn-info btn-sm" type="submit">発送内容入力</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
	}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '現在、支払い完了者はいません。';
	echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE status=2 AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '2':	// 発送完了者一覧に関する処理 ---------------------------------------------------------------------------------------------------------------
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE status=3 AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white px-2 py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">注文番号</div>';
echo '<div class="col-2">購入者</div>';
echo '<div class="col-2">注文日</div>';
echo '<div class="col-2">発送日</div>';
echo '<div class="col-2">伝票番号</div>';
echo '<div class="col-2">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=3 AND cancel=0 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
if ($NUMBER % 2 == 0) {
    echo '<div class="row bg-light p-2" style="border-bottom: dotted 1px #444;">';
} else {
    echo '<div class="row bg-white p-2" style="border-bottom: dotted 1px #444;">';
}
echo '<div class="col-2">', $row['order_no'], '</div>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
$sql->execute([$row['cost_id']]);
foreach($sql->fetchAll() as $ad){
    echo '<div class="col-2">', $ad['name'], '</div>';
}
echo '<div class="col-2">', $row['order_date'], '</div>';
echo '<div class="col-2">', $row['shipment_date'], '</div>';
echo '<div class="col-2">', $row['voucher_no'], '</div>';
echo '<div class="col-2">';
echo '<form class="d-inline" action="admin-order-input.php" method="post">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="level" value="2">';
echo '<input type="hidden" name="cost_id" value="', $row['cost_id'], '">';
echo '<button class="btn btn-info btn-sm" type="submit">確認</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$NUMBER++;
}
if($NUMBER == 0) {
echo '<div class="bg-white p-5">';
echo '現在、発送完了者はいません。';
echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM purchases WHERE status=3 AND cancel=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
  break;

case '5':	// キャンセル一覧に関する処理 ---------------------------------------------------------------------------------------------------------------
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM cart WHERE cancel_date IS NOT NULL";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white px-2 py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">状態</div>';
echo '<div class="col-2">注文番号</div>';
echo '<div class="col-2">購入者</div>';
echo '<div class="col-2">キャンセル日</div>';
echo '<div class="col-2">注文日</div>';
echo '<div class="col-2">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM cart WHERE cancel_date IS NOT NULL ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
if ($NUMBER % 2 == 0) {
    echo '<div class="row bg-light p-2" style="border-bottom: dotted 1px #444;">';
} else {
    echo '<div class="row bg-white p-2" style="border-bottom: dotted 1px #444;">';
}
//　状態　--------------------------------------------------------------------------------------------------
if ($row['refund_date'] == "2000-01-01 00:00:00") {	// 払い戻し日が2000年01月01日の場合
	echo '<div class="col-2"><span class="badge badge-success h5">処理済み</span></div>';
} else if ($row['refund_date'] != null) {	// 払い戻し日が入っている場合
	echo '<div class="col-2"><span class="badge badge-success h5">返金済み</span></div>';
} else if ($row['cancel_checker'] != 1) {	// キャンセル確認者が入っている場合
	echo '<div class="col-2"><span class="badge badge-warning h5">確認済み</span></div>';
} else {
	echo '<div class="col-2"><span class="badge badge-danger h5">確認待ち</span></div>';
}

//　注文番号　--------------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$row['order_id']]);
foreach($sql->fetchAll() as $pur){
echo '<div class="col-2">', $pur['order_no'], '</div>';
}

//　購入者　--------------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
$sql->execute([$row['cost_id']]);
foreach($sql->fetchAll() as $ad){
    echo '<div class="col-2">', $ad['name'], '</div>';
}

//　キャンセル日　--------------------------------------------------------------------------------------------------
echo '<div class="col-2">', $row['cancel_date'], '</div>';

//　注文日　--------------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$row['order_id']]);
foreach($sql->fetchAll() as $pur){
echo '<div class="col-2">', $pur['order_date'], '</div>';
}

//　操作　--------------------------------------------------------------------------------------------------
echo '<div class="col-2">';
echo '<form class="d-inline" action="admin-order-input.php" method="post">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="level" value="5">';
echo '<input type="hidden" name="cost_id" value="', $row['cost_id'], '">';
echo '<button class="btn btn-info btn-sm" type="submit">内容確認</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$NUMBER++;
}
if($NUMBER == 0) {
echo '<div class="bg-white p-5">';
echo '現在、キャンセルはありません。';
echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM cart WHERE cancel_date IS NOT NULL";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-order-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
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