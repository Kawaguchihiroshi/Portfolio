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
    <title>お知らせ一覧｜NERVE FACTORY</title>

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
          <h1 class="m-0">お知らせ</h1>
      </div>

      <div class="list-area mb-5">
        <h2 class="">お知らせ一覧</h2>


<?php
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM information WHERE ( flag=2 OR flag=3 ) AND del=0');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) { $i++; }
echo '<span>全 ', $i, ' 件</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
$allpage = floor($i/5);
$nowpage = $_REQUEST['pg'];

if ($nowpage == 1) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
}

for ($j=1; $j<=$allpage+1; $j++) {
if ($j == $nowpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news-list.php?pg=', $j, '">', $j, '</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $j, '">', $j, '</a></li>';
}
}
if ($allpage != 0 && $nowpage == $allpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news.php?pg=', $nowpage - 1, '">次へ</a></li>';
} else if ($allpage == 0) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news.php?pg=', $nowpage - 1, '">次へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
}
echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
echo '<div class="px-3">';

$view=$_REQUEST['pg']*5;
$noview=($_REQUEST['pg']-1)*5;
$id=$_SESSION['customer']['id'];
		echo '<div class="row bg-white py-2" style="border-bottom: solid 2px #666;">';
		echo '<div class="col-md-2 p-2 text-center" style="font-weight:bold;">投稿日</div>';
		echo '<div class="col-md-10 p-2" style="font-weight:bold;">お知らせタイトル</div>';
		echo '</div>';
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM information WHERE del=0 AND status=2');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) {
if ($i%2 == 0) {
		echo '<div class="row bg-white" style="border-bottom: dotted 1px #666;">';
} else {
		echo '<div class="row bg-light" style="border-bottom: dotted 1px #666;">';
}
		echo '<div class="col-md-2 py-2 text-center">', substr($row['write_date'], 0, 10), '</div>';
		echo '<div class="col-md-10 py-2 text-truncate"><a class="" href="customer-news-detail.php?id=', $row['id'], '">', $row['title'], '</a></div>';
		echo '</div>';
$i++;
}
if ($i == 0) {
		echo '<div class="bg-light">';
		echo '<div class="p-5 text-center">新しいお知らせは、ありません。</div>';
		echo '</div>';
}
echo '</div><!-- /.px-3 -->';
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
$i=0;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM information WHERE del=0');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) { $i++; }
echo '<span>全 ', $i, ' 件</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
$allpage = floor($i/5);
$nowpage = $_REQUEST['pg'];

if ($nowpage == 1) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $nowpage - 1, '">前へ</a></li>';
}

for ($j=1; $j<=$allpage+1; $j++) {
if ($j == $nowpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news-list.php?pg=', $j, '">', $j, '</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $j, '">', $j, '</a></li>';
}
}
if ($allpage != 0 && $nowpage == $allpage) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news.php?pg=', $nowpage - 1, '">次へ</a></li>';
} else if ($allpage == 0) {
echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="customer-news.php?pg=', $nowpage - 1, '">次へ</a></li>';
} else {
echo '<li class="page-item"><a class="page-link" href="customer-news-list.php?pg=', $nowpage + 1, '">次へ</a></li>';
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