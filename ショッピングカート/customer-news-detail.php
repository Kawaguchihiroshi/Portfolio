<?php
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM information WHERE id=? AND status=2 AND del=0');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
	if ($row['flag'] == 2) {
		if (!isset($_SESSION['customer'])) {
			//　会員ログインを行っていない場合
			http_response_code( 302 ) ;
			header( "Location: login-input.php" ) ;
			exit ;
		}
	}
}
?>
<?php $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart'); ?>
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

<main class="container">
<div class="row">
<!-- // 左カラム開始 -->
<div class="col-md-10">
<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
<h1 class="m-0">お知らせ詳細</h1>
</div>

<?php
$sql=$pdo->prepare('SELECT * FROM information WHERE id=? AND status=2 AND del=0');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {

echo '<div class="mt-3 mb-4 p-3 bg-white rounded">';
echo '<div class="h2 mt-4 mb-0 pl-3">';
echo $row['title'];
echo '</div>';
echo '<div class="row">';
echo '<div class="col-md-8 mt-2 mb-0 pt-3">';
echo '<span class="pl-4">', substr($row['write_date'], 0, 10), ' 更新</span>';
echo '</div>';
echo '<div class="col-md-4">';
require 'include/sns.php';
echo '</div>';
echo '</div>';

echo '<hr />';

echo '<div class="mt-2 mb-0 pl-3">';
echo $row['content'];
echo '</div>';
if (isset($_SESSION['customer'])) {
echo '<div class="pt-4 text-right"><a href="customer-news-list.php?pg=1" class="btn btn-info">お知らせ一覧に戻る <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
} else {
echo '<div class="pt-4 text-right"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
}

}
?>

</div><!-- /.news-area -->
</div><!-- /.col-md-10 -->
<!-- // 左カラム終了 -->
<!-- // 右カラム開始 -->
<?php require 'include/sideber.php'; ?>
<!-- // 右カラム終了 -->
</div><!-- /.row -->
</main><!-- /.container -->

<?php require 'include/footer.php'; ?>