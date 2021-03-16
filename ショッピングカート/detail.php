<?php session_start(); ?>
<?php $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart'); ?>
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

<main class="container">
<div class="row">
<!-- // 左カラム開始 -->
<div class="col-md-10">
<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
<h1 class="m-0">商品詳細</h1>
</div>

<?php
$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_GET['id']]);

echo '<div class="mt-3 mb-4 p-3 bg-white rounded">';

echo '<div class="row">';
echo '<div class="col-md-8 h2 mt-2 mb-0 pl-5">';
foreach ($sql->fetchAll() as $row) {echo $row['name'];}
echo '</div>';
echo '<div class="col-md-4">';
require 'include/sns.php';
echo '</div>';
echo '</div>';

echo '<hr />';

$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
echo '<form action="customer-cart-output.php" method="post">';
echo '<div class="row">';
echo '<div class="col-md-7 text-center">';
echo '<img src="', $row['img_main'], '" class="w-75">';
echo '<div class="row mt-3">';
echo '<div class="px-2 text-center" id="myimages">';
echo '<viewer :images="images">';
echo '<div class="col-md-4 img" v-for="src in images"><img :src="src" :key="src" class="w-100"></div>';
echo '</viewer>';
echo '</div>';
echo '</div>';
echo '</div><!-- /col-md-7 -->';
echo '<div class="col-md-5">';

echo '<div class="row">';
echo '<div class="p-2 col-md-4 bg-light">商品ID</div>';
echo '<div class="p-2 col-md-8">', $row['id'], '</div>';
echo '</div>';

echo '<div class="row mt-2">';
echo '<div class="p-2 col-md-4 bg-light">商品コード</div>';
echo '<div class="p-2 col-md-8">', $row['cord'], '</div>';
echo '</div>';

echo '<div class="row mt-2">';
echo '<div class="p-2 col-md-4 bg-light">商品名</div>';
echo '<div class="p-2 col-md-8">', $row['name'], '</div>';
echo '</div>';

echo '<div class="row mt-2">';
echo '<div class="p-2 col-md-4 bg-light">価　格</div>';
echo '<div class="p-2 col-md-8">', $row['price'], '</div>';
echo '</div>';

echo '<div class="row mt-2">';
echo '<div class="p-2 col-md-4 bg-light">注文数</div>';
echo '<div class="p-2 col-md-8"><input type="text" name="pty" value="1" size="3"></div>';
echo '</div>';

echo '<input type="hidden" name="prod_id" value="', $row['id'], '">';
echo '<div class="mt-2 text-right">';

if ($row['stock'] == 0) {
	echo '<div class="text-danger small">現在、在庫がありません。</div>';
	echo '<button class="btn btn-secondary" type="submit" disabled>買い物カゴに入れる</button>';
} else {
	if (isset($_SESSION['customer'])) {
		echo '<button class="btn btn-primary" type="submit">買い物カゴに入れる</button>';
	} else {
		echo '<div class="text-danger small">買い物カゴのご利用は会員登録が必要になります。</div>';
		echo '<button class="btn btn-secondary" type="submit" disabled>買い物カゴに入れる</button>';
	}
}
echo '</div>';
echo '</form>';
echo '<div class="mt-3"><strong>【注意事項】</strong></div>';
echo '<div class="small">', $row['prod_attention'], '</div>';


if (isset($_SESSION['customer'])) {
	echo '<div class="mt-2 text-right">';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM favorite WHERE prod_id=? AND cost_id=?');
	$sql->execute([
		$row['id'],
		$_SESSION['customer']['id']
	]);
	if (empty($sql->fetchAll())) {
		echo '<form action="customer-output.php?level=5" method="post">';
		echo '<input type="hidden" name="cost_id" value="', $_SESSION['customer']['id'], '">';
		echo '<input type="hidden" name="prod_id" value="', $row['id'], '">';
		echo '<button class="btn btn-sm btn-outline-primary" type="submit">お気に入りに追加</button>';
		echo '</form>';
	} else {
		echo '<form action="customer-output.php?level=55" method="post">';
		echo '<input type="hidden" name="cost_id" value="', $_SESSION['customer']['id'], '">';
		echo '<input type="hidden" name="prod_id" value="', $row['id'], '">';
		echo '<button class="btn btn-sm btn-secondary" type="submit">お気に入りから削除</button>';
		echo '</form>';
	}
	echo '</div>';
}
echo '</div><!-- /col-md-5 -->';
echo '</div><!-- /row -->';
echo '<div class="bd-dot mt-3"></div>';
echo '<div class="row mt-3 pl-3">';
echo '<div class="col-md-3 p-3 text-white bg-dark rounded">商品説明</div>';
echo '<div class="col-md-9">', $row['prod_content'], '</div>';
echo '</div>';
echo '<div class="bd-dot mt-3"></div>';
}
?>

<script type="text/javascript">//<![CDATA[
const Viewer = window['VueViewer'].default;

Vue.use(Viewer)
new Vue({
  el: '#myimages',
  data: {
    images: [
'<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
echo $row['img001'];
}
?>
',
'<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
echo $row['img002'];
}
?>
',
'<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from product where id=?');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
echo $row['img003'];
}
?>
'
   ]
 }
});
//]]></script>

</div><!-- /.news-area -->
</div><!-- /.col-md-10 -->
<!-- // 左カラム終了 -->
<!-- // 右カラム開始 -->
<?php require 'include/sideber.php'; ?>
<!-- // 右カラム終了 -->
</div><!-- /.row -->
</main><!-- /.container -->

<?php require 'include/footer.php'; ?>