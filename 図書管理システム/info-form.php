<?php
session_start();
if (!isset($_SESSION['customer'])) {
	header('Location: index.php');
}
?>
<!DOCTYPE  html>
<html lang="ja">
<head>
<?php require 'include/header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/menu.php';?>

<main role="main" class="container py-5">
<div class="p-4 text-white bg-dark rounded">
<h1 class="display-4">訓練生メニュー</h1>
</div>
<div class="p-5 mt-3 bg-white rounded">
<h2><i class="far fa-envelope"></i> 登録情報変更依頼</h2>
<hr>

	<form action="info-sendmail.php" method="post">
		<input type="hidden" name="member_id" value="<?php echo $_SESSION['customer']['id']; ?>">
<input type="hidden" name="to" value="kawaguchihiroshi0212@gmail.com">
		<div class="row pt-4">
			<div class="col-md-3">
				<label for="inputName">氏名</label>
			</div>
    			<div class="col-md-5">
				<div class="pb-1">登録されている氏名：<?php echo $_SESSION['customer']['name']; ?></div>
				<input type="text" id="inputName" class="form-control" placeholder="変更後の氏名" name="name" value="<?php echo $_SESSION['customer']['name'];?>" required autofocus>
			</div>
    			<div class="col-md-4"></div>
		</div>

		<div class="row pt-4">
			<div class="col-md-3">
				<label for="inputTELL">電話番号</label>
			</div>
    			<div class="col-md-5">
				<div class="pb-1">登録されている電話番号：<?php echo $_SESSION['customer']['tell'];?></div>
				<input type="text" id="inputTELL" class="form-control" placeholder="変更後の電話番号" name="tell" value="<?php echo $_SESSION['customer']['tell'];?>" required>
			</div>
    			<div class="col-md-4"></div>
		</div>

		<div class="row pt-5">
			<div class="col-md-2"></div>
			<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更依頼を送信</button></div>
			<div class="col-md-2"></div>
			<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
			<div class="col-md-2"></div>
		</div>
	</form>

	</div><!-- /.product-area -->

</main>

<?php require 'include/footer.php'; ?>