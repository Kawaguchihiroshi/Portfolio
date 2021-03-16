<?php
session_start();
if (!isset($_SESSION['customer'])) {
//　会員ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: login-input.php" ) ;
exit ;
}
?>
<?php require 'include/header.php'; ?>
    <title>NERVE FACTORY</title>

  </head>
  <body>
  <div class="container">

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark" href="index.php">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">
<?php
if ($_REQUEST['order'] != 2) {
// エラー　------------------------------------------------------------------------------------------
echo '<div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">';
echo '<h1 class="m-0">ご確認ください</h1>';
echo '</div>';

echo '<div class="list-area mb-5 p-4 bg-white rounded">';

echo '<h2 class="pl-3">注文を以下リンクから再度行ってください。</h2>';
echo '<hr>';
echo '<div class="pl-3"><a href="customer-cart-list.php" class="btn btn-sm btn-outline-success">買い物カゴ</a></div>';


}else {
echo '<div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">';
echo '<h1 class="m-0">ご注文が完了いたしました。</h1>';
echo '</div>';

// 現在の時間　------------------------------------------------------------------------------------------
date_default_timezone_set('Japan');
$order_date = date('Y-m-d H:i:s');

// 注文IDをふる　------------------------------------------------------------------------------------------
$min = 1000;
$max = 9999;
$no = 1;
$oder_no = '';

while($no != 0){ 
$no = 0;
$oder_no01 = mt_rand($min, $max);
$oder_no02 = mt_rand($min, $max);
$oder_no03 = mt_rand($min, $max);
$order_no = 'oid-'.$oder_no01.'-'.$oder_no02.'-'.$oder_no03;

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE order_no=?');
$sql->execute([$order_no]);
foreach ($sql->fetchAll() as $row) { $no++; }
} // 重複がなくなるまでループ

// 【SQL】注文情報を追加　------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('INSERT INTO purchases values(null,?,?,?,null,null,null,1,1,1,1,0,0,0,?,?,?,?,?)');
$sql->execute([
	$_SESSION['customer']['id'],
	$_REQUEST['pay'],
	$order_date,
	$order_no,
	$_SESSION['customer']['delivery_name'],
	$_SESSION['customer']['delivery_post_no'],
	$_SESSION['customer']['delivery_adrs'],
	$_SESSION['customer']['delivery_tell']
]);

// 【SQL】カート情報の注文IDを更新　------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE order_no=?');
$sql->execute([$order_no]);
foreach ($sql->fetchAll() as $row) { $order_id=$row['id']; }

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('UPDATE cart SET order_id=? where cost_id=? AND order_id=1');
$sql->execute([
	$order_id,
	$_SESSION['customer']['id']
]);

// 【SQL】商品在庫を更新　------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE order_id=?');
$sql->execute([$order_id]);
foreach ($sql->fetchAll() as $row) {

// 注文数：$row['number']

	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([	$row['prod_id']	]);
	foreach ($sql->fetchAll() as $prod) {

		// 注文前の在庫数：$prod['stock']

		$new_stock = $prod['stock'] - $row['number'];	// 注文後の在庫数

		// 在庫を更新
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql=$pdo->prepare('UPDATE product SET stock=? where id=?');
		$sql->execute([
			$new_stock,
			$row['prod_id']
		]);
	}
}


echo '<div class="list-area mb-5 p-4 bg-white rounded">';
echo '<h2 class="mt-3 pl-3">ご注文番号</h2>';
echo '<hr>';
echo '<div class="pl-3">';
echo $order_no;
echo '</div>';
echo '<h2 class="mt-5 pl-3">お客様情報</h2>';
echo '<hr>';
echo '<div class="pl-3">';
echo '<div class="row">';
echo '<div class="col-md-6">';
echo '<div><strong>【配送先情報】</strong></div>';
echo '<div><strong>お名前</strong>：', $_SESSION['customer']['delivery_name'], ' 様</div>';
echo '<div class="pt-2"><strong>お届け先</strong></div>';
echo '<div>〒', $_SESSION['customer']['delivery_post_no'], '</div>';
echo '<div>', $_SESSION['customer']['delivery_adrs'], '</div>';
echo '<div class="pt-2"><strong>ご連絡先</strong>：', $_SESSION['customer']['delivery_tell'], '</div>';
echo '</div>';
echo '<div class="col-md-6">';
echo '<div><strong>【お支払方法】</strong></div>';
if($_REQUEST['pay'] == 0){
echo '銀行振込';
echo '<input type="hidden" name="pay" value="0">';
} else if($_REQUEST['pay'] == 1){
echo 'クレジット決済';
echo '<input type="hidden" name="pay" value="1">';
} else if($_REQUEST['pay'] == 2){
echo 'コンビニ支払い';
echo '<input type="hidden" name="pay" value="2">';
} else {
echo '支払い方法を選択してください。';
}
echo '</div>';
echo '</div>';
echo '</div>';

// 購入商品確認　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">購入商品確認</h2>';
echo '<hr>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=?');
$sql->execute([
$_SESSION['customer']['id'],
$order_id
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
		echo '<h4>', $prod['name'], '</h4>';
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

echo '<div class="small">';
echo '※上記ご注文内容は、印刷などによって大切に保管ください。';
echo '</div>';
}
?>
    </div><!-- /.list-area -->
    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>