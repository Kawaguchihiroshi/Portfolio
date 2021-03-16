<?php session_start(); ?>
<?php
 ini_set('display_errors',1);
 $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');

if (isset($_POST['search'])) {
  $search = htmlspecialchars($_POST['search']);
  $search_value = $search;
}else {
  $search = '';
  $search_value = '';
}
$sql = "SELECT * FROM product where name LIKE '%$search%'";
 ?>
<?php require 'include/header.php'; ?>
    <title>商品検索｜NERVE FACTORY</title>

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

      <div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
          <h1 class="m-0">商品検索</h1>
      </div>
      

      <div class="product-area mb-5">
        <h2 class="">商品検索結果</h2>
<div class="mt-3 mb-4 p-3" style="border-radius: 3px; background-color: #ccc;">
<form action="search.php" method="post" class="m-0 text-center">
<div class="input-group input-group-sm w-100">
<input type="text" class="form-control" name="search" value="<?php echo $search_value ?>">
<div class="input-group-append"><input type="submit" class="btn btn-outline-secondary" name="" value="検索"></div>
</div>
</form>
</div>
<?php
foreach ($pdo->query($sql) as $row) {
		echo '<div class="row mx-1 bg-white mb-2">';
		echo '<div class="col-md-4 p-2"><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="col-md-8 p-2">';
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
		echo '</div><!-- /.col-md-9 -->';
		echo '</div><!-- /.row -->';
}
?>
      </div><!-- /.product-area -->

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>