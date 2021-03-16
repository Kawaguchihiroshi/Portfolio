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
    <title>購入履歴｜NERVE FACTORY</title>

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

<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
<h1 class="m-0">購入履歴</h1>
</div>

      <div class="list-area mb-5">
        <h2 class="">購入履歴一覧</h2>


<?php
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM favorite WHERE cost_id=?');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) { $i++; }
echo '<span>全 ', $i, ' 商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
$allpage = floor($i/5)+1;
$nowpage = $_REQUEST['pg'];

if ($nowpage == 1) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
}

for ($j=1; $j<$allpage+1; $j++) {
if ($j == $nowpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $j, '">', $j, '</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $j, '">', $j, '</a></li>';
}
}
if ($nowpage == $allpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
}
echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

$view=$_REQUEST['pg']*5;
$noview=($_REQUEST['pg']-1)*5;
$x = 0;

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM purchases WHERE cost_id=?');
$sql->execute([ $_SESSION['customer']['id'] ]);
$total=0;
foreach ($sql->fetchAll() as $row) {
	echo '<div class="row p-3 mx-1 bg-white mb-2 rounded">';
	echo '<div class="col-md-6 p-2">';
	$order_date = substr($row['order_date'], 0, 10);
	echo '<div class="mt-1"><strong>注文日：', $order_date, '</strong></div>';
	echo '<div class="mt-1"><strong>注文番号：', $row['order_no'], '</strong></div>';
	echo '<hr>';
	echo '<div class="mt-1"><strong>注文者情報</strong></div>';
	echo '<div class="mt-1">氏名：', $_SESSION['customer']['name'], ' 様</div>';
	echo '<div class="mt-1">住所：〒', $_SESSION['customer']['post_no'], '　', $_SESSION['customer']['adrs'], '</div>';
	echo '<div class="mt-1">電話番号：', $_SESSION['customer']['tell'], '</div>';
	echo '<div class="mt-3"><strong>配送先情報</strong></div>';
	echo '<div class="mt-1">氏名：', $row['d_name'], ' 様</div>';
	echo '<div class="mt-1">住所：〒', $row['d_post_no'], '　', $row['d_adrs'], '</div>';
	echo '<div class="mt-1">電話番号：', $row['d_tell'], '</div>';

	echo '<div class="mt-3"><strong>お支払情報</strong></div>';
	echo '<div class="mt-1">お支払方法：';
		if ($row['pay'] == 0){
			echo '銀行振込';
		} else if ($row['pay'] == 1){
			echo 'クレジット決済';
		} else if ($row['pay'] == 2){
			echo 'コンビニ支払い';
		}
	echo '</div>';
	echo '</div><!-- /.col-md-6 -->';
	echo '<div class="col-md-6 p-3">';

	echo '<div class="p-3 bg-white mb-2 rounded" style="border: solid 1px #666;">';
	echo '<div><strong>処理状況</strong></div>';
	echo '<div class="mt-1 small">※処理状況は各項目、サイト反映まで数日かかる場合がございます。</div>';
	echo '<div class="mt-1">注文確認：';
		if ($row['order_checker'] == 1){
			echo '<span class="text-danger">未確認</span>';
		} else{
			echo '<span class="text-success">確認済</span>';
		}
	echo '</div>';
	echo '<div class="mt-1">お支払状況：';
		if ($row['payment_date'] == null){
			echo '<span class="text-danger">未支払い</span>';
		} else{
			echo '<span class="text-success">支払い済み（', $row['payment_date'], '）</span>';
		}
	echo '</div>';
	echo '<div class="mt-1">配送状況：';
		if ($row['payment_date'] == null){
			echo '<span class="text-danger">発送準備中</span>';
		} else{
			echo '<span class="text-success">発送済み（', $row['shipment_date'], '）</span><br>';
			echo '<span>伝票番号【', $row['voucher_no'], '】</span>';
		}
	echo '</div>';
	echo '</div>';

	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM cart WHERE order_id=? AND cancel_date IS NULL');
	$sql->execute([$row['id']]);
	foreach ($sql->fetchAll() as $prod) {
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
		$sql->execute([$prod['prod_id']]);
		foreach ($sql->fetchAll() as $buy) {
			if ($x % 2 == 0) {
				echo '<div class="row bg-white" style="border-bottom: dotted 1px #666;">';
			} else {
				echo '<div class="row bg-light" style="border-bottom: dotted 1px #666;">';
			}
			echo '<div class="col-md-2 py-2 text-right"><img class="w-75" src="', $buy['img_main'], '"></div>';
			echo '<div class="col-md-5 py-2">';
			echo '<h5>', $buy['name'], '</h5>';
			echo '<div class="mt-1">購入数：', $prod['number'], '点</div>';
			echo '<div>小計：', $buy['price'] * $prod['number'], '円</div>';
			echo '</div><!-- /.col-md-5 -->';
			echo '<div class="col-md-5 py-2">';

			echo '<div class="text-right"><a href="detail.php?id=', $buy['id'], '" class="btn btn-sm btn-outline-success">商品詳細</a></div>';

			if ($row['status'] == 0 or $row['status'] == 1){
				echo '<div class="text-right mt-1"><a href="cancel.php?order_id=', $row['id'], '&cost_id=', $_SESSION['customer']['id'], '&prod_id=', $prod['prod_id'], '" class="btn btn-sm btn-outline-success">キャンセル</a></div>';
			} else {
				echo '<div class="text-right mt-1">配送済みのためキャンセルを行えません。<br>';
				echo '大変恐縮ではございますが、返品をお願いいたします。<br>';
				echo '返品商品を確認後、キャンセル処理いたします。</div>';
			}
			echo '</div><!-- /.col-md-5 -->';
			echo '</div><!-- /.row -->';
			$tmp=$buy['price'] * $prod['number'];
			$total+=$tmp;
			$x++;
		}
	}
$souryou = 800;

echo '<hr>';
echo '<div class="pr-3 text-right">';
echo '消費税(10%)：', number_format($total*0.1), ' 円<br />';
echo '合計：', number_format($total), ' 円<br />';
echo '送料：', $souryou, ' 円<br />';
echo '<span class="h5">合計金額(ご請求金額)：', number_format($total+$total*0.1+$souryou), ' 円</span><br />';
echo '</div>';

	echo '</div><!-- /.col-md-6 -->';
	echo '</div><!-- /.row -->';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM favorite WHERE cost_id=?');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) { $i++; }
echo '<span class="ml-2 mt-2">全 ', $i, ' 商品</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
$allpage = floor($i/5)+1;
$nowpage = $_REQUEST['pg'];

if ($nowpage == 1) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
}

for ($j=1; $j<$allpage+1; $j++) {
if ($j == $nowpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $j, '">', $j, '</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $j, '">', $j, '</a></li>';
}
}
if ($nowpage == $allpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-favorite-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
}
echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
?>

      </div><!-- /.list-area -->

<?php require 'include/newitem.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>