<?php session_start(); ?>
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

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from customer where email=? and password=? and status=1');
$sql->execute([$_REQUEST['login_name'], $_REQUEST['password']]);
foreach ($sql->fetchAll() as $row) {
	$_SESSION['customer']=[
		'id'=>$row['id'], 
		'name'=>$row['name'],
		'email'=>$row['email'], 
		'password'=>$row['password'], 
		'post_no'=>$row['post_no'], 
		'adrs'=>$row['adrs'],
		'tell'=>$row['tell'], 
		'delivery_name'=>$row['delivery_name'], 
		'delivery_post_no'=>$row['delivery_post_no'], 
		'delivery_adrs'=>$row['delivery_adrs'], 
		'delivery_tell'=>$row['delivery_tell'],
		'status'=>$row['status'], 
		'del'=>$row['del']
	];
}
if (isset($_SESSION['customer'])) {
	if ($_SESSION['customer']['del'] == 1) {
		echo '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">';
		echo '  <strong>ご確認ください!</strong>　このアカウントは退会されいるためご利用できません。ご不明な点がございましたらお問い合わせをお願いいたします。';
		echo '  <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">';
		echo '    <span aria-hidden="true">&times;</span>';
		echo '  </button>';
		echo '</div>';
	}
} else {
	echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">';
	echo '  <strong>ご確認ください!</strong>　ログイン名またはパスワードが違います。';
	echo '  <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">';
	echo '    <span aria-hidden="true">&times;</span>';
	echo '  </button>';
	echo '</div>';
}
?>

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