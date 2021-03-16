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
    <title>キャンセル手続きを完了｜NERVE FACTORY</title>

  </head>
  <body>
  <div class="container">

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">
<?php
echo '<div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">';
echo '<h1 class="m-0">キャンセル手続きを完了いたしました。</h1>';
echo '</div>';

// 現在の時間　------------------------------------------------------------------------------------------
date_default_timezone_set('Japan');
$cancel_date = date('Y-m-d H:i:s');


// 【SQL】カート情報のキャンセル日を更新　------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('UPDATE cart SET cancel_date=? WHERE cost_id=? AND order_id=? AND prod_id=?');
$sql->execute([
	$cancel_date,
	$_SESSION['customer']['id'],
	$_REQUEST['order_id'],
	$_REQUEST['prod_id']
]);

// 【SQL】カート情報内に注文情報を持つカート情報がなくなった場合、注文情報のキャンセル日を入力　--------------------------------------
// （注文情報にひもずくカート情報が全てキャンセルされた時、注文情報のキャンセル日を入力）　--------------------------------------
// （※発送をする必要の有無のため必要）　--------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE order_id=? AND cancel_date IS NULL');
$sql->execute([$_REQUEST['order_id']]);
if (empty($sql->fetchAll())) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('UPDATE purchases SET cancel_date=? where order_id=?');
	$sql->execute([
		$cancel_date,
		$_REQUEST['order_id']
	]);
}



// 【SQL】商品在庫を更新　------------------------------------------------------------------------------------------
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=? AND prod_id=?');
$sql->execute([
	$_SESSION['customer']['id'],
	$_REQUEST['order_id'],
	$_REQUEST['prod_id']
]);
foreach ($sql->fetchAll() as $row) {

// 注文数：$row['number']

	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([	$row['prod_id']	]);
	foreach ($sql->fetchAll() as $prod) {

		// 注文前の在庫数：$prod['stock']

		$new_stock = $prod['stock'] + $row['number'];	// 注文後の在庫数

		// 在庫を更新
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql=$pdo->prepare('UPDATE product SET stock=? WHERE id=?');
		$sql->execute([
			$new_stock,
			$row['prod_id']
		]);
	}
}

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE id=?');
$sql->execute([$_REQUEST['order_id']]);
foreach ($sql->fetchAll() as $row) {
	echo '<div class="list-area mb-5 p-4 bg-white rounded">';
	echo '<h2 class="mt-3 pl-3">ご注文番号</h2>';
	echo '<hr>';
	echo '<div class="pl-3">';
	echo $row['order_no'];
	echo '</div>';
	echo '<h2 class="mt-5 pl-3">お客様情報</h2>';
	echo '<hr>';
	echo '<div class="pl-3">';
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
	} else if($_REQUEST['pay'] == 1){
		echo 'クレジット決済';
	} else if($_REQUEST['pay'] == 2){
		echo 'コンビニ支払い';
	} else {
		echo '支払い方法を選択してください。';
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';

	// キャンセル商品確認　------------------------------------------------------------------------------------------
	echo '<h2 class="mt-5 pl-3">キャンセル商品確認</h2>';
	echo '<hr>';

	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=? AND prod_id=?');
	$sql->execute([
		$_SESSION['customer']['id'],
		$_REQUEST['order_id'],
		$_REQUEST['prod_id']
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
			echo '</div><!-- /.col-md-5 -->';
			echo '</div><!-- /.row -->';
			$total=$row['number'] * $prod['price'];
		}
	}

	echo '<hr>';
	echo '<div class="pr-3 text-right">';
	echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
	echo '合計：', number_format($total), ' 円<br />';
	echo '<span class="h4">キャンセル金額：', number_format($total+$total*0.1), ' 円</span><br />';
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