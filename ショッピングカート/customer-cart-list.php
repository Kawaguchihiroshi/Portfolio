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
      <div class="col-4"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">

      <div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">
	<h1 class="m-0">買い物カゴ</h1>
      </div>

      <div class="list-area mb-5 p-4 bg-white rounded">
<?php
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM cart WHERE cost_id=? AND order_id=1');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) { $i++; }
if($i > 0) {
	echo '<h2 class="pl-3">';
	echo $i, '個の商品が買い物カゴに入っています。';
	echo '</h2>';
	echo '<hr>';
	echo '<div class="px-3">現在、お客様の買い物かごには以下の商品が入っています。<br />';
	echo '購入手続きを行う際は、購入個数を再度ご確認の上、ページ下の「商品を注文する」ボタンよりご購入お願いいたします。</div>';
} else {
        echo '<h2 class="pl-3">';
	echo '買い物カゴに商品は入っていません。';
	echo '</h2>';
	echo '<hr>';
	echo '<div class="px-3">現在、お客様の買い物かごには商品が入っていません。<br />';
	echo '購入する商品を選び、注文個数を決め、「買い物カゴに追加」ボタンを押してください。</div>';
}
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
		echo '<div class="mt-1">購入個数：<input type="text" size="3" name="number" value="', $row['number'], '"> 個</div>';

		if ($row['number'] < $prod['stock']) {
			echo '<div class="mt-1 text-success">購入個数の在庫はあります。</div>';
		} else if ($prod['stock'] > 0) {
			echo '<div class="mt-1 text-warning">購入個数の在庫がありません。<br />';
			echo '購入個数を1～', $prod['stock'], 'の範囲で設定してください。</div>';
		} else {
			echo '<div class="mt-1 text-danger">現在、在庫がございません。</div>';
		}

		echo '<div class="mt-1">小計：', number_format($row['number'] * $prod['price']), ' 円</div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '<div class="col-md-5 p-2">';
		echo '<div class="mt-2 text-right"><a href="detail.php?id=', $prod['id'], '" class="btn btn-sm btn-outline-success">商品詳細</a></div>';
		echo '<div class="mt-2 text-right"><a href="customer-cart-output.php?id=', $_SESSION['customer']['id'], '&pid=', $prod['id'], '" class="btn btn-sm btn-outline-danger">削除</a></div>';
		echo '</div><!-- /.col-md-5 -->';
		echo '</div><!-- /.row -->';
		$tmp=$row['number'] * $prod['price'];
	}

	$total+=$tmp;
}
if ($i > 0) {
$souryou = 800;
echo '<hr>';
echo '<div class="row">';
echo '<div class="col-md-8 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '合計：', number_format($total), ' 円<br />';
echo '送料：', $souryou, ' 円<br />';
echo '<span class="h4">合計金額(ご請求金額)：', number_format($total+$total*0.1+$souryou), ' 円</span><br />';
echo '</div><!-- /col-md-8 -->';
echo '<div class="col-md-4 text-center">';
echo '<form action="order-pay.php" method="post">';
echo '<input type="hidden" name="cost_id" value="', $_SESSION['customer']['id'], '">';
echo '<input type="hidden" name="prod_id" value="', $prod['id'], '">';
echo '<input type="hidden" name="order" value="0">';
echo '<button class="btn btn-lg btn-primary" type="submit">商品を注文する</button>';
echo '</form>';
echo '</div><!-- /col-md-4 -->';
echo '</div><!-- /row -->';
echo '<hr>';
}
?>

    </div><!-- /.list-area -->
    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>