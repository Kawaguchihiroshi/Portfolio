<?php session_start(); ?>
<?php
//　指定パラメータなしでアクセス　⇒　トップページへリダイレクト
if (!isset($_REQUEST['cid']) or !isset($_REQUEST['customer_no']) or !isset($_REQUEST['id'])) {
	http_response_code( 302 ) ;
	header( "Location: https://pf01.newheadworks.net/" ) ;
	exit ;
}

//　メール送信後、1時間以内にアクセスされているか？　⇒　id,customer_noから会員が存在するか？　⇒　会員ステータス変更の処理
//　真：会員ステータスを1にアップデート
//　偽：トップページへリダイレクト

date_default_timezone_set('Japan');
$nowtime = new DateTime();
$posttime = new DateTime($_REQUEST['cid']);
$interval = $nowtime->diff($posttime);

if ($interval->format('%I') <= 59) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM customer WHERE customer_no=? AND id=?');
	$sql->execute([
		$_REQUEST['customer_no'],
		$_REQUEST['id']
	]);
	if ($sql->fetchAll()) {
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql=$pdo->prepare('UPDATE customer SET status=1 WHERE customer_no=? AND id=?');
		$sql->execute([
			$_REQUEST['customer_no'],
			$_REQUEST['id']
		]);
	} else {
		//　URLが不正
		http_response_code( 302 ) ;
		header( "Location: https://pf01.newheadworks.net/" ) ;
		exit ;
	}

} else {
	//　時間内にアクセスできていない
	http_response_code( 302 ) ;
	header( "Location: https://pf01.newheadworks.net/" ) ;
	exit ;
}
?>
<?php require 'include/header.php'; ?>
    <title>本登録完了｜NERVE FACTORY</title>

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
<h1 class="m-0">本登録完了</h1>
</div>

<div class="p-3 bg-white rounded">
<h2 class="mb-4" style="border-bottom: solid 1px #444;">会員登録が完了いたしました。</h2>
<div>ありがとうございます。<br />ログインを行い、お楽しみください。</div>
<?php
$regist = 1;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
require 'include/sendmail.php';
}
?>
<div class="mt-4"><a href="index.php" class="btn btn-info">TOPに戻る</a></div>
</div>

<?php require 'include/newitem.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>