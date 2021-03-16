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
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">訓練生メニュー</h1>
</div>

<div class="p-5 mt-3 bg-white">

        <h2><i class="fas fa-comment"></i> 本のリクエスト</h2>
	<hr>

	<form action="request-sendmail.php" method="post">
		<input type="hidden" name="member_id" value="<?php echo $_SESSION['customer']['id'];?>">
		<input type="hidden" name="to" value="kawaguchihiroshi0212@gmail.com">
		<div class="row pt-4">
			<div class="col-md-3">
				<label for="inputTitle">本のタイトル</label>
			</div>
    			<div class="col-md-5">
				<input type="text" id="inputTitle" class="form-control" placeholder="本のタイトル" name="book_title" required autofocus>
			</div>
    			<div class="col-md-4"></div>
		</div>

		<div class="row pt-4">
			<div class="col-md-3">
				<label for="inputURL">本の詳細がわかるURL</label>
			</div>
    			<div class="col-md-5">
				<input type="text" id="inputURL" class="form-control" placeholder="本の詳細がわかるURL" name="book_url" required>
			</div>
    			<div class="col-md-4"></div>
		</div>

		<div class="row pt-4">
			<div class="col-md-3">
				<label for="textareaRequest">リクエストに至った経緯</label>
			</div>
    		<div class="col-md-5">
				<textarea class="form-control" id="textareaRequest" rows="4" placeholder="リクエストに至った経緯" name="keii" required></textarea>
			</div>
    			<div class="col-md-4"></div>
		</div>

		<div class="row pt-5">
			<div class="col-md-2"></div>
			<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">リクエストを送信</button></div>
			<div class="col-md-2"></div>
			<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
			<div class="col-md-2"></div>
		</div>
	</form>

	</div><!-- /.product-area -->

</main>

<?php require 'include/footer.php'; ?>