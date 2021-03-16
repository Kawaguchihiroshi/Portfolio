<!DOCTYPE html>
<html lang="ja">
<head>
<?php
session_start();
if (!isset($_SESSION['admin'])) {
//　管理画面ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: admin-login-input.php" ) ;
exit ;
}
?>
<?php require 'include/admin_header.php'; ?>
<title>管理画面 / お知らせ登録｜NERVE FACTORY</title>
</head>
<body>
<header class="p-4 bg-dark text-white">
<div class="row">
<div class="col-md-3 text-left"><a href="admin-login-output.php"><img src="images/admin_logo.png"></a></div>
<div class="col-md-9 text-right">
<a href="admin-login-output.php" class="btn btn-info btn-sm">ダッシュボード</a>
<a href="index.php" class="btn btn-info btn-sm" target="_blank">サイトを確認</a>
<a href="admin-logout.php" class="btn btn-info btn-sm ml-3">ログアウト</a>
</div>
</div>
</header>
<main class="row">
<?php require 'include/admin_menu.php'; ?>
<div id="main" class="col-md-10 py-5">
<h1 class="mb-5" style="border-bottom: solid 3px #444;">お知らせ登録</h1>

<form action="admin-information-newoutput.php" method="post">
<input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin']['id']; ?>">
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputTitle">タイトル</label>
</div>
<div class="col-md-9">
<input type="text" id="inputTitle" class="form-control" placeholder="タイトル" name="title" required>
</div>
</div>
<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputContent">本文</label>
</div>
<div class="col-md-9">
<textarea class="form-control" placeholder="本文" id="textareaContent" rows="5" name="content" required></textarea>
</div>
</div>

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputFlag">表示分類</label>
</div>
<div class="col-md-9">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="flag" id="inlineRadio11" value="1">
<label class="form-check-label" for="inlineRadio11">トップページのみ表示</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="flag" id="inlineRadio12" value="2">
<label class="form-check-label" for="inlineRadio12">会員ページのみ表示</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="flag" id="inlineRadio13" value="3" checked>
<label class="form-check-label" for="inlineRadio13">両方表示</label>
</div>
</div>
</div>

<div class="row mt-3">
<div class="col-md-3 py-2 bg-info text-white rounded">
<label for="inputStatus">表示設定</label>
</div>
<div class="col-md-9">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
<label class="form-check-label" for="inlineRadio1">下書き</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2" checked>
<label class="form-check-label" for="inlineRadio2">公開</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">
<label class="form-check-label" for="inlineRadio3">非公開</label>
</div>
</div>
</div>

<div class="pt-5">
<button class="btn btn-info" type="submit">登録</button> <button class="btn btn-light" type="reset">クリア</button>
</div>
</form>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>