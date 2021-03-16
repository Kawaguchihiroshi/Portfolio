<?php session_start(); ?>
<?php
//　指定パラメータなしでアクセス　⇒　トップページへリダイレクト
if (!isset($_REQUEST['cid']) or !isset($_REQUEST['customer_no']) or !isset($_REQUEST['id'])) {
	http_response_code( 302 ) ;
	header( "Location: https://pf01.newheadworks.net/" ) ;
	exit ;
}

//　メール送信後、1時間以内にアクセスされているか？　⇒　id,customer_noから会員が存在するか？　⇒　パスワード変更の処理
//　真：パスワード変更
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

	} else {
		//　URLが不正
		http_response_code( 302 ) ;
		header( "Location: https://pf01.newheadworks.net/" ) ;
		exit ;
	}

} else {
	//　1時間以内にアクセスできていない
	http_response_code( 302 ) ;
	header( "Location: https://pf01.newheadworks.net/" ) ;
	exit ;
}
?>
<?php require 'include/header.php'; ?>
    <title>パスワードリセット｜NERVE FACTORY</title>

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
<h1 class="m-0">パスワードリセット</h1>
</div>

<div class="p-3 bg-white rounded">
<h2 class="mb-4" style="border-bottom: solid 1px #444;">新しいパスワードを設定してください。</h2>
<form action="customer-output.php" method="post">
<input type="hidden" name="level" value="33">
<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
<input type="hidden" name="customer_no" value="<?php echo $_REQUEST['customer_no']; ?>">
	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputPassword">新しいパスワード</label>
		</div>
    		<div class="col-md-4">
			<input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" required>
		</div>
    		<div class="col-md-4"></div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputPassword01">パスワードの確認</label>
		</div>
    		<div class="col-md-4">
			<input type="password" id="inputPassword01" class="form-control" placeholder="確認用パスワード" name="password01" required>
		</div>
    		<div class="col-md-4"></div>
	</div>
	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button id="input-data" class="btn btn-info btn-block" type="submit">パスワードの変更</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>

</div>

<?php require 'include/newitem.php'; ?>

    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>