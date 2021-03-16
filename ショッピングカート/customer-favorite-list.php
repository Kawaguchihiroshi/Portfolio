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

<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
<h1 class="m-0">お気に入り</h1>
</div>

      <div class="list-area mb-5">
        <h2 class="">お気に入り一覧</h2>


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
$id=$_SESSION['customer']['id'];

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
// $sql=$pdo->prepare('SELECT * FROM favorite WHERE cost_id=".$id." limit ".$view." offset ".$noview."');
$sql=$pdo->prepare('SELECT * FROM favorite WHERE cost_id=?');
$sql->execute([$_SESSION['customer']['id']]);
$count = 0;
foreach ($sql->fetchAll() as $row) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM product WHERE id=?');
	$sql->execute([$row['prod_id']]);
	foreach ($sql as $prod) {
		echo '<div class="row mx-1 bg-white mb-2">';
		echo '<div class="col-md-2 p-2"><img class="w-100" src="', $prod['img_main'], '"></div>';
		echo '<div class="col-md-5 p-2">';
		echo '<div class="mt-1">';
		if ($prod['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $prod['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $prod['price'], '円</div>';
		echo '</div>';
		echo '<div class="col-md-5 p-2">';
		echo '<div class="mt-2 text-right"><a href="detail.php?id=', $prod['id'], '" class="btn btn-sm btn-outline-success">商品詳細</a></div>';
		echo '<div class="mt-2 text-right">';
		echo '<form action="customer-output.php?level=55" method="post">';
		echo '<input type="hidden" name="prod_id" value="', $prod['id'], '">';
		echo '<button class="btn btn-sm btn-outline-primary" type="submit">削除</button>';
		echo '</form>';
		echo '</div>';
		echo '</div><!-- /.col-md-9 -->';
		echo '</div><!-- /.row -->';
	}
	$count++;
}
if ($count == 0) {
	echo '<div class="mx-1  mb-2 p-5 bg-white">お気に入りは登録されていません。</div>';
}
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
?>

      </div><!-- /.list-area -->

<?php require 'include/newitem.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>