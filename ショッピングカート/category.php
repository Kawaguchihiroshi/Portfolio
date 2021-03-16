<?php session_start(); ?>
<?php require 'include/header.php'; ?>
    <title>NERVE FACTORY</title>

  </head>
  <body>
  <?php $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart'); ?>

  <div class="container">

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark" href="index.php">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">

      <div class="p-4 p-md-5 text-white rounded bg-dark">
          <h1 class="m-0"><?php require 'include/category_name.php'; ?></h1>
      </div>

<?php require 'include/newitem.php'; ?>

      <div class="list-area mt-5">
        <h2 class=""><?php require 'include/category_name.php'; ?>カテゴリ内の商品一覧</h2>

<?php
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE ( cate_id01=" . $_REQUEST['level'] . " OR cate_id02=" . $_REQUEST['level'] . " OR cate_id03=" . $_REQUEST['level'] . " ) AND del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, 'アイテム</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%5 == 0){
	$allpage = floor($i/5);
} else {
	$allpage = floor($i/5) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $_REQUEST['pg'] - 1, '&level=',$_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $j, '&level=',$_REQUEST['level'], '">', $j, '</a></li>';
    }
}
if ($allpage == 0) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">1</a></li>';
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $_REQUEST['pg'] + 1, '&level=',$_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

$count = ($_REQUEST['pg'] - 1) * 5;

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM product WHERE ( cate_id01=" . $_REQUEST['level'] . " OR cate_id02=" . $_REQUEST['level'] . " OR cate_id03=" . $_REQUEST['level'] . " ) AND del=0 LIMIT 5 OFFSET " . $count . "";
$count = 0;
foreach ($pdo->query($sql) as $row) {		  
	echo '<div class="row mx-1 bg-white mb-2">';
	echo '<div class="col-md-3 p-2"><img class="w-100" src="', $row['img_main'], '"></div>';
	echo '<div class="col-md-9 p-2">';
	echo '<div class="mt-1">';
	if ($row['stock'] > 0) {
		echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
	} else {
		echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
	}
	echo '</div>';
	echo '<div class="mt-1">';
	echo '<h5>', $row['name'], '</h5>';
	echo '</div>';
	echo '<div class="mt-1">', $row['price'], '円</div>';
	echo '<div class="mt-2 text-right"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success">詳細はこちら</a></div>';
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

	echo '</div><!-- /.col-md-9 -->';
	echo '</div><!-- /.row -->';
	$count++;
}
if ($count == 0) {
	echo '<div class="mx-1 mb-2 p-5 bg-white rounded">';
	echo 'このカテゴリーには現在、商品がありません。';
	echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM product WHERE ( cate_id01=" . $_REQUEST['level'] . " OR cate_id02=" . $_REQUEST['level'] . " OR cate_id03=" . $_REQUEST['level'] . " ) AND del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, 'アイテム</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%5 == 0){
	$allpage = floor($i/5);
} else {
	$allpage = floor($i/5) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $_REQUEST['pg'] - 1, '&level=',$_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $j, '&level=',$_REQUEST['level'], '">', $j, '</a></li>';
    }
}
if ($allpage == 0) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">1</a></li>';
}
if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="category.php?pg=', $_REQUEST['pg'] + 1, '&level=',$_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
?>

      </div><!-- /.list-area -->

<?php require 'include/recommended.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>