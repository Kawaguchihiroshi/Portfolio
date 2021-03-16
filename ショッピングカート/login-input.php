<?php session_start(); ?>
<?php require 'include/header.php'; ?>
	<title>ログイン｜NERVE FACTORY</title>
	<link rel="stylesheet" href="css/signin.css">
</head>

<body class="text-center">
<?php
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
?>

<form class="form-signin mt-5" action="login-output.php" method="post">
	<div class="text-center"><a class="blog-header-logo text-dark">NERVE FACTORY</a></div>
	<h1 class="h4 mb-3 font-weight-normal">～ ログイン ～</h1>
	<label for="inputEmail" class="sr-only">Emailアドレス</label>
	<input type="text" id="inputEmail" class="form-control" placeholder="Emailアドレス" name="login_name" required autofocus>
	<label for="inputPassword" class="sr-only">パスワード</label>
	<input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
</form>

<div class="pt-2 pb-5">アイテムの購入には<a href="customer-newinput.php">会員登録</a>が必要です。</div>

<?php require 'include/footer.php'; ?>