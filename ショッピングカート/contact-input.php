<?php session_start(); ?>
<?php require 'include/header.php'; ?>
	<title>お問い合わせ｜NERVE FACTORY</title>
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
<h1 class="m-0">お問い合わせ</h1>
</div>
      
<div class="mt-3 p-3 bg-white rounded">
<h2 class="pt-3 pl-3">お問い合わせ内容入力</h2>
<hr />

<form action="contact-output.php" method="post">
<input type="hidden" name="level" value="4">
	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputName">氏名</label>
		</div>
    		<div class="col-md-5">
<?php
if (isset($_SESSION['customer'])) {
echo '			<input type="text" id="inputName" class="form-control" placeholder="山田 太郎" name="name" value="', $_SESSION['customer']['name'], '" required>';
} else {
echo '			<input type="text" id="inputName" class="form-control" placeholder="山田 太郎" name="name" required>';
}
?>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputEmail">メールアドレス</label>
		</div>
    		<div class="col-md-5">
<?php
if (isset($_SESSION['customer'])) {
echo '			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $_SESSION['customer']['email'], '" required>';
} else {
echo '			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" required>';
}
?>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputTitle">お問い合わせタイトル</label>
		</div>
    		<div class="col-md-7">
			<input type="text" id="inputTitle" class="form-control" placeholder="お問い合わせタイトル" name="title" required>
		</div>
    		<div class="col-md-2"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="textareaContent">お問い合わせ内容</label>
		</div>
    		<div class="col-md-7">
			<textarea class="form-control" id="textareaContent" rows="5" name="content" required></textarea>
		</div>
    		<div class="col-md-2"></div>
	</div>

	<div class="row py-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">送信</button></div>
		<div class="col-md-2"></div>
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