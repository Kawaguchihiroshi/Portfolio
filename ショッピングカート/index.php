<?php session_start(); ?>
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

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">

<?php require 'include/top_topics01.php'; ?>

<div class="news-area p-3">
<h2 class="h3">お知らせ</h2>
<hr>
<?php
foreach ($pdo->query('select * from information where ( flag=1 OR flag=3 ) AND del=0') as $row) {
echo '<div class="row py-2">';
echo '<div class="col-md-2">', substr($row['write_date'], 0, 10), ' 更新</div>';
echo '<div class="col-md-10"><a href="customer-news-detail.php?id=', $row['id'], '">', $row['title'], '</a></div>';
echo '</div>';
echo '<div class="bd-dot"></div>';
}
?>
</div><!-- /.news-area -->

<?php require 'include/newitem.php'; ?>
<?php require 'include/recommended.php'; ?>
<?php require 'include/hititem.php'; ?>

</div><!-- /.blog-main -->

<?php require 'include/sideber.php'; ?>
</div><!-- /.row -->
</main><!-- /.container -->

<?php require 'include/footer.php'; ?>