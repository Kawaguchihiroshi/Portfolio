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
<h1 class="m-0">買い物かごに追加</h1>
</div>

      <div class="list-area mb-5">
        <h2 class="">買い物カゴに追加しました。</h2>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('INSERT INTO cart VALUES(null,?,?,?,1,null,1,null,1)');
$sql->execute([
	$_REQUEST['prod_id'],
	$_SESSION['customer']['id'],
	$_REQUEST['pty']
]);
?>

      </div><!-- /.list-area -->

<?php require 'include/newitem.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>