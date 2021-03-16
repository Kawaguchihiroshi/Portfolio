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
if ($_REQUEST['order'] != 1) {
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
echo '<h1 class="m-0">ご注文内容確認</h1>';
echo '</div>';

echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// お客様情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">お客様情報</h2>';
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
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=1');
$sql->execute([$_SESSION['customer']['id']]);
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

echo '<form class="mt-3  text-right" action="order.php" method="post">';
echo '<input type="hidden" name="pay" value="', $_REQUEST['pay'], '">';
echo '<input type="hidden" name="order" value="2">';
echo '<button class="btn btn-lg btn-primary" type="submit">注文を確定する</button>';
echo '</form>';
}
?>
    </div><!-- /.list-area -->
    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>