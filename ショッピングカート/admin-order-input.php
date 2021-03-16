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
	
case '0':	// 注文者一覧に関する処理 ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// お客様情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">お客様情報</h2>';
echo '<hr>';
echo '<div class="pl-3">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div><strong>【配送先情報】</strong></div>';
echo '<div><strong>お名前</strong>：', $row['d_name'], ' 様</div>';
echo '<div class="pt-2"><strong>お届け先</strong></div>';
echo '<div>〒', $row['d_post_no'], '</div>';
echo '<div>', $row['d_adrs'], '</div>';
echo '<div class="pt-2"><strong>ご連絡先</strong>：', $row['d_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<div><strong>【お支払方法】</strong></div>';
if($row['pay'] == 0){
echo '銀行振込';
echo '<input type="hidden" name="pay" value="0">';
} else if($row['pay'] == 1){
echo 'クレジット決済';
echo '<input type="hidden" name="pay" value="1">';
} else if($row['pay'] == 2){
echo 'コンビニ支払い';
echo '<input type="hidden" name="pay" value="2">';
} else {
echo '支払い方法を選択してください。';
}
echo '</div>';
echo '</div>';
echo '</div>';
}
// 購入商品確認　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">購入商品確認</h2>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=? AND cancel_date IS NULL');
$sql->execute([
$_REQUEST['cost_id'],
$_REQUEST['id']
]);
$total=0;
foreach ($sql->fetchAll() as $row) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([$row['prod_id']]);

	foreach ($sql as $prod) {
		echo '<div class="row mx-1 bg-light mb-2">';
		echo '<div class="col-md-2 p-2"><img class="w-100" src="', $prod['img_main'], '"></div>';
		echo '<div class="col-md-5 p-2">';
		echo '<h4><a href="detail.php?id=', $row['prod_id'], '" target="_blank">', $prod['name'], '</a></h4>';
		echo '<div class="mt-1">単価：', number_format($prod['price']), ' 円</div>';
		echo '<div class="mt-1">購入個数：', $row['number'], ' 個</div>';
		echo '<div class="mt-1">小計：', number_format($row['number'] * $prod['price']), ' 円</div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '</div><!-- /.row -->';
		$tmp=$row['number'] * $prod['price'];
	}

	$total+=$tmp;
}

$souryou = 800;

echo '<hr>';
echo '<div class="pr-3 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '合計：', number_format($total), ' 円<br />';
echo '送料：', $souryou, ' 円<br />';
echo '<span class="h4">合計金額(ご請求金額)：', number_format($total+$total*0.1+$souryou), ' 円</span><br />';
echo '</div>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
if ($row['status'] == 0) {
echo '<form class="mt-3 text-right" action="admin-order-output.php" method="post">';
echo '<input type="hidden" name="level" value="0">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="status" value="1">';
echo '<button class="btn btn-lg btn-primary" type="submit">「確認済み」にする</button>';
echo '</form>';
} else {
echo '<form class="mt-3 text-right" action="admin-order-output.php" method="post">';
echo '<div class="row">';
echo '<div class="col-md-5 bg-info text-white">';
echo '<label for="inputPayDate">お支払日時</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputPayDate" class="form-control" placeholder="YYYY-mm-dd HH:ss:ii" name="pay_date" required autofocus>';
echo '</div>';
echo '</div>';
echo '<input type="hidden" name="level" value="1">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="status" value="2">';
echo '<button class="btn btn-lg btn-primary" type="submit">支払い確認完了</button>';
echo '</form>';
}
}
break;

case '1':	// 支払完了者一覧に関する処理 -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// お客様情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">お客様情報</h2>';
echo '<hr>';
echo '<div class="pl-3">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div><strong>【配送先情報】</strong></div>';
echo '<div><strong>お名前</strong>：', $row['d_name'], ' 様</div>';
echo '<div class="pt-2"><strong>お届け先</strong></div>';
echo '<div>〒', $row['d_post_no'], '</div>';
echo '<div>', $row['d_adrs'], '</div>';
echo '<div class="pt-2"><strong>ご連絡先</strong>：', $row['d_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<div><strong>【お支払方法】</strong></div>';

if($row['pay'] == 0){
	echo '銀行振込';
	echo '<input type="hidden" name="pay" value="0">';
} else if($row['pay'] == 1){
	echo 'クレジット決済';
	echo '<input type="hidden" name="pay" value="1">';
} else if($row['pay'] == 2){
	echo 'コンビニ支払い';
	echo '<input type="hidden" name="pay" value="2">';
} else {
	echo '支払い方法を選択してください。';
}
echo '</div>';
echo '</div>';
echo '</div>';
}
// 購入商品確認　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">購入商品確認</h2>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=? AND cancel_date IS NULL');
$sql->execute([
$_REQUEST['cost_id'],
$_REQUEST['id']
]);
$total=0;
foreach ($sql->fetchAll() as $row) {
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([$row['prod_id']]);

	foreach ($sql as $prod) {
		echo '<div class="row mx-1 bg-light mb-2">';
		echo '<div class="col-md-2 p-2"><img class="w-100" src="', $prod['img_main'], '"></div>';
		echo '<div class="col-md-5 p-2">';
		echo '<h4><a href="detail.php?id=', $row['prod_id'], '" target="_blank">', $prod['name'], '</a></h4>';
		echo '<div class="mt-1">単価：', number_format($prod['price']), ' 円</div>';
		echo '<div class="mt-1">購入個数：', $row['number'], ' 個</div>';
		echo '<div class="mt-1">小計：', number_format($row['number'] * $prod['price']), ' 円</div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '</div><!-- /.row -->';
		$tmp=$row['number'] * $prod['price'];
	}

	$total+=$tmp;
}

$souryou = 800;

echo '<hr>';
echo '<div class="pr-3 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '合計：', number_format($total), ' 円<br />';
echo '送料：', $souryou, ' 円<br />';
echo '<span class="h4">合計金額(ご請求金額)：', number_format($total+$total*0.1+$souryou), ' 円</span><br />';
echo '</div>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<form class="mt-3 text-right" action="admin-order-output.php" method="post">';
echo '<div class="row">';
echo '<div class="col-md-6"></div>';
echo '<div class="col-md-6">';
echo '<div class="row">';
echo '<div class="col-md-5 bg-info text-white pt-2">';
echo '<label for="inputShipmentDate">発送日時</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputShipmentDate" class="form-control" placeholder="YYYY-mm-dd HH:ss:ii" name="shipment_date" required autofocus>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-2">';
echo '<div class="col-md-5 bg-info text-white pt-2">';
echo '<label for="inputShipmentDate">発送伝票番号</label>';
echo '</div>';
echo '<div class="col-md-7">';
echo '<input type="text" id="inputShipmentDate" class="form-control" placeholder="発送伝票番号" name="voucher_no" required autofocus>';
echo '</div>';
echo '</div>';
echo '<input type="hidden" name="level" value="2">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
echo '<input type="hidden" name="status" value="3">';
echo '<button class="btn btn-lg btn-primary mt-2" type="submit">発送確認完了</button>';
echo '</form>';
echo '</div>';
echo '</div>';
}
break;

case '2':	// 発送完了者一覧に関する処理 ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// 確認履歴情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">確認履歴情報</h2>';
echo '<hr>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<div class="row">';
echo '<div class="col-md-2 text-center"><strong>注文日</strong></div>';
echo '<div class="col-md-1 text-center"><strong>注文確認者</strong></div>';
echo '<div class="col-md-2 text-center"><strong>支払い日</strong></div>';
echo '<div class="col-md-1 text-center"><strong>支払い確認者</strong></div>';
echo '<div class="col-md-1 text-center"><strong>発送日</strong></div>';
echo '<div class="col-md-2 text-center"><strong>発送伝票番号</strong></div>';
echo '<div class="col-md-1 text-center"><strong>発送確認者</strong></div>';
echo '<div class="col-md-2 text-center"></div>';
echo '</div>';
echo '<div class="row">';
echo '<div class="col-md-2 text-center">', $row['order_date'], '</div>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
$sql->execute([$row['order_checker']]);
foreach ($sql->fetchAll() as $ad) {
echo '<div class="col-md-1 text-center">', $ad['name'], '</div>';
}
echo '<div class="col-md-2 text-center">', $row['payment_date'], '</div>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
$sql->execute([$row['payment_checker']]);
foreach ($sql->fetchAll() as $ad) {
echo '<div class="col-md-1 text-center">', $ad['name'], '</div>';
}
echo '<div class="col-md-1 text-center">', $row['shipment_date'], '</div>';
echo '<div class="col-md-2 text-center">', $row['voucher_no'], '</div>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
$sql->execute([$row['shipment_checker']]);
foreach ($sql->fetchAll() as $ad) {
echo '<div class="col-md-1 text-center">', $ad['name'], '</div>';
}
echo '<div class="col-md-2 text-center"><a href="admin-order-list.php?pg=1&level=2" class="btn btn-info btn-sm">発送完了者一覧に戻る</a></div>';
echo '</div>';
}

// お客様情報　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">お客様情報</h2>';
echo '<hr>';
echo '<div class="pl-3">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div><strong>【配送先情報】</strong></div>';
echo '<div><strong>お名前</strong>：', $row['d_name'], ' 様</div>';
echo '<div class="pt-2"><strong>お届け先</strong></div>';
echo '<div>〒', $row['d_post_no'], '</div>';
echo '<div>', $row['d_adrs'], '</div>';
echo '<div class="pt-2"><strong>ご連絡先</strong>：', $row['d_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<div><strong>【お支払方法】</strong></div>';
if($row['pay'] == 0){
echo '銀行振込';
echo '<input type="hidden" name="pay" value="0">';
} else if($row['pay'] == 1){
echo 'クレジット決済';
echo '<input type="hidden" name="pay" value="1">';
} else if($row['pay'] == 2){
echo 'コンビニ支払い';
echo '<input type="hidden" name="pay" value="2">';
} else {
echo '支払い方法を選択してください。';
}
echo '</div>';
echo '</div>';
echo '</div>';
}
// 購入商品確認　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">購入商品確認</h2>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=? AND cancel_date IS NULL');
$sql->execute([
$_REQUEST['cost_id'],
$_REQUEST['id']
]);
$total=0;
foreach ($sql->fetchAll() as $row) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([$row['prod_id']]);

	foreach ($sql as $prod) {
		echo '<div class="row mx-1 bg-light mb-2">';
		echo '<div class="col-md-2 p-2"><img class="w-100" src="', $prod['img_main'], '"></div>';
		echo '<div class="col-md-5 p-2">';
		echo '<h4><a href="detail.php?id=', $row['prod_id'], '" target="_blank">', $prod['name'], '</a></h4>';
		echo '<div class="mt-1">単価：', number_format($prod['price']), ' 円</div>';
		echo '<div class="mt-1">購入個数：', $row['number'], ' 個</div>';
		echo '<div class="mt-1">小計：', number_format($row['number'] * $prod['price']), ' 円</div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '</div><!-- /.row -->';
		$tmp=$row['number'] * $prod['price'];
	}

	$total+=$tmp;
}

$souryou = 800;

echo '<hr>';
echo '<div class="pr-3 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '合計：', number_format($total), ' 円<br />';
echo '送料：', $souryou, ' 円<br />';
echo '<span class="h4">合計金額(ご請求金額)：', number_format($total+$total*0.1+$souryou), ' 円</span><br />';
echo '</div>';
echo '<hr>';
break;

case '5':	// キャンセル商品に関する処理 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// 確認履歴情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">確認履歴情報</h2>';
echo '<hr>';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cancel_date IS NOT NULL AND id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
    //　状態確認　--------------------------------------------------------------------------------------------------
    $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
    $sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
    $sql->execute([$row['order_id']]);
    foreach($sql->fetchAll() as $pur){
        echo '<div class="row">';
        echo '<div class="col-md-2 text-center"><strong>注文日</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>支払い日</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>発送日</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>キャンセル日</strong></div>';
        echo '<div class="col-md-4 text-center"></div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-md-2 text-center">', $pur['order_date'], '</div>';
        echo '<div class="col-md-2 text-center">', $pur['payment_date'], '</div>';
        echo '<div class="col-md-2 text-center">', $pur['shipment_date'], '</div>';
        echo '<div class="col-md-2 text-center">', $row['cancel_date'], '</div>';
        echo '<div class="col-md-4 text-center">';
		if ($row['cancel_date'] > $pur['shipment_date']) {
				echo '<span class="text-danger"><strong>1) 返品商品確認の必要有</strong></span>';
				echo '<span class="text-danger"><strong>2) 払い戻しの必要有</strong></span>';
		} else if ($row['cancel_date'] > $pur['payment_date']) {
				echo '<span class="text-danger"><strong>払い戻しの必要有</strong></span>';
		} else if ($row['cancel_date'] <= $pur['payment_date']) {
				echo '<span class="text-warning"><strong>お払いに関して確認の必要有</strong></span>';
		}
		echo '</div>';
        echo '</div>';
        echo '<div class="row mt-3">';
        echo '<div class="col-md-2 text-center"><strong>注文確認者</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>支払い確認者</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>発送確認者</strong></div>';
        echo '<div class="col-md-2 text-center"><strong>発送伝票番号</strong></div>';
        echo '<div class="col-md-4 text-center"></div>';
        echo '</div>';
        echo '<div class="row">';
        $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
        $sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
        $sql->execute([$pur['order_checker']]);
        foreach ($sql->fetchAll() as $ad) {
        echo '<div class="col-md-2 text-center">', $ad['name'], '</div>';
        }
        $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
        $sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
        $sql->execute([$pur['payment_checker']]);
        foreach ($sql->fetchAll() as $ad) {
        echo '<div class="col-md-2 text-center">', $ad['name'], '</div>';
        }
        $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
        $sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
        $sql->execute([$pur['shipment_checker']]);
        foreach ($sql->fetchAll() as $ad) {
        echo '<div class="col-md-2 text-center">', $ad['name'], '</div>';
        }
        echo '<div class="col-md-2 text-center">', $pur['voucher_no'], '</div>';
		echo '<div class="col-md-4 text-center">';
		
		if ($row['cancel_checker'] == 1) {
				echo '<a href="admin-order-output.php?level=3" class="btn btn-info btn-sm">確認完了</a>';
		} else {
                $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
                $sql=$pdo->prepare('SELECT * FROM admin WHERE id=?');
                $sql->execute([$row['cancel_checker']]);
                foreach ($sql->fetchAll() as $ad) {
                		echo 'キャンセル確認者：', $ad['name'];
                }
		}
		
		echo '</div>';
        echo '</div>';
		echo '<form class="mt-4 text-right" action="admin-order-output.php" method="post">';
        echo '<div class="row">';
        echo '<div class="col-md-6"></div>';
        echo '<div class="col-md-6">';
		echo '<div class="row">';
        echo '<div class="col-md-3 bg-info text-white pt-2">';
        echo '<label for="inputShipmentDate">返金日時</label>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<input type="text" id="inputShipmentDate" class="form-control" placeholder="YYYY-mm-dd HH:ss:ii" name="refund_date" required autofocus>';
        echo '</div><!-- /col-md-6 -->';
        echo '<div class="col-md-3 text-left">';
        echo '<input type="hidden" name="level" value="4">';
        echo '<input type="hidden" name="id" value="', $row['id'], '">';
        echo '<button class="btn btn-primary" type="submit">返金確認完了</button>';
		echo '</div><!-- /col-md-4 -->';
		echo '</div><!-- /row -->';		
		echo '</div><!-- /col-md-6 -->';
		echo '</div><!-- /row -->';
        echo '</form>';

		// お客様情報　------------------------------------------------------------------------------------------
        echo '<h2 class="mt-5 pl-3">お客様情報</h2>';
        echo '<hr>';
        echo '<div class="row pl-3">';
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
        $sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
        $sql->execute([$pur['cost_id']]);
        foreach ($sql->fetchAll() as $cust) {
		echo '<div class="col-md-4">';
        echo '<div><strong>【注文者情報】</strong></div>';
		echo '<div><strong>お名前</strong>：', $cust['name'], ' 様</div>';
        echo '<div class="pt-2"><strong>ご住所</strong></div>';
        echo '<div>〒', $cust['post_no'], '</div>';
        echo '<div>', $cust['adrs'], '</div>';
        echo '<div class="pt-2"><strong>ご連絡先</strong>：', $cust['tell'], '</div>';
        echo '</div>';
		}
        echo '<div class="col-md-4">';
        echo '<div><strong>【配送先情報】</strong></div>';
        echo '<div><strong>お名前</strong>：', $pur['d_name'], ' 様</div>';
        echo '<div class="pt-2"><strong>お届け先</strong></div>';
        echo '<div>〒', $pur['d_post_no'], '</div>';
        echo '<div>', $pur['d_adrs'], '</div>';
        echo '<div class="pt-2"><strong>ご連絡先</strong>：', $pur['d_tell'], '</div>';
        echo '</div>';
		echo '<div class="col-md-4">';
        echo '<div><strong>【お支払方法】</strong></div>';
        if($pur['pay'] == 0){
        echo '銀行振込';
        } else if($pur['pay'] == 1){
        echo 'クレジット決済';
        } else if($pur['pay'] == 2){
        echo 'コンビニ支払い';
        } else {
        echo '支払い方法を選択してください。';
        }
        echo '</div>';
        echo '</div>';
    }
}


// 購入商品確認　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">キャンセル商品確認</h2>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE id=?');
$sql->execute([$_REQUEST['id']]);
$total=0;
foreach ($sql->fetchAll() as $row) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([$row['prod_id']]);

	foreach ($sql as $prod) {
		echo '<div class="row mx-1 bg-light mb-2">';
		echo '<div class="col-md-2 p-2"><img class="w-100" src="', $prod['img_main'], '"></div>';
		echo '<div class="col-md-5 p-2">';
		echo '<h4><a href="detail.php?id=', $row['prod_id'], '" target="_blank">', $prod['name'], '</a></h4>';
		echo '<div class="mt-1">単価：', number_format($prod['price']), ' 円</div>';
		echo '<div class="mt-1">購入個数：', $row['number'], ' 個</div>';
		echo '<div class="mt-1">小計：', number_format($row['number'] * $prod['price']), ' 円</div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '</div><!-- /.row -->';
		$tmp=$row['number'] * $prod['price'];
	}

	$total+=$tmp;
}

echo '<hr>';
echo '<div class="pr-3 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '小計：', number_format($total), ' 円<br />';
echo '<span class="h4">合計：', number_format($total+$total*0.1), ' 円</span><br />';
echo '</div>';
echo '<hr>';
break;
}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>