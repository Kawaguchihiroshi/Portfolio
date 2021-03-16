<?php session_start(); ?>
<?php require 'include/header.php'; ?>
	<title>パスワードを忘れた方｜NERVE FACTORY</title>
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
<h1 class="m-0">パスワードを忘れた方</h1>
</div>
      
<div class="mt-3 p-3 bg-white rounded">
<h2 class="pt-4 pl-3">登録された内容を入力して下さい。</h2>
<hr />

<form action="customer-output.php" method="post">
<input type="hidden" name="level" value="3">
<input type="hidden" name="name" value="ゲスト">
	<div class="row pt-5">
		<div class="col-md-3"></div>
		<div class="col-md-2 text-center">
			<label for="inputEmail">メールアドレス</label>
		</div>
    		<div class="col-md-4">
			<input type="text" id="inputEmail" class="form-control" placeholder="nervetaro@newheadworks.com" name="email" required>
		</div>
		<div class="col-md-3"></div>
	</div>
	<div class="row pt-3">
		<div class="col-md-3"></div>
		<div class="col-md-2 text-center">
			<label for="inputpost">郵便番号</label>
		</div>
    		<div class="col-md-4">
			<input type="text" id="inputpost" class="form-control" placeholder="123-4567" name="post_no" required>
		</div>
		<div class="col-md-3"></div>
	</div>

	<div class="row py-5">
		<div class="col-md-2"></div>
		<div class="col-md-5"><button class="btn btn-lg btn-info btn-block" type="submit">パスワードリセットURLを送信</button></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>

</div><!-- /.news-area -->
</div><!-- /.col-md-10 -->
<!-- // 左カラム終了 -->
<!-- // 右カラム開始 -->
<?php require 'include/sideber.php'; ?>
<!-- // 右カラム終了 -->
</div><!-- /.row -->
</main><!-- /.container -->
<?php require 'include/footer.php'; ?>