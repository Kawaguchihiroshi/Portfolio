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
<title>管理画面 / お知らせ変更｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">お知らせ変更</h1>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$id = $_REQUEST['id'];
$sql = "SELECT * FROM information WHERE id=$id";
foreach ($pdo->query($sql) as $row) {
echo '<form action="admin-information-output.php" method="post">';
echo '<input type="hidden" name="admin_id" value="', $_SESSION['admin']['id'], '">';
echo '<input type="hidden" name="id" value="', $_REQUEST['id'], '">';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputTitle">タイトル</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<input type="text" id="inputTitle" class="form-control" placeholder="タイトル" name="title" value="', $row['title'], '" required autofocus>';
echo '</div>';
echo '</div>';
echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="textareaContent">本文</label>';
echo '</div>';
echo '<div class="col-md-9">';
echo '<textarea class="form-control" placeholder="本文" id="textareaContent" rows="5" name="content" required>', $row['content'], '</textarea>';
echo '</div>';
echo '</div>';

echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputFlag">表示区分</label>';
echo '</div>';
echo '<div class="col-md-9">';
if ($row['flag'] == 1) {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio11" value="1" checked>';
	echo '  <label class="form-check-label" for="inlineRadio11">トップページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio12" value="2">';
	echo '  <label class="form-check-label" for="inlineRadio12">会員ページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio13" value="3">';
	echo '  <label class="form-check-label" for="inlineRadio13">両方表示</label>';
	echo '</div>';
} else if ($row['flag'] == 2) {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio11" value="1">';
	echo '  <label class="form-check-label" for="inlineRadio11">トップページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio12" value="2" checked>';
	echo '  <label class="form-check-label" for="inlineRadio12">会員ページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio13" value="3">';
	echo '  <label class="form-check-label" for="inlineRadio13">両方表示</label>';
	echo '</div>';
} else {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio11" value="1">';
	echo '  <label class="form-check-label" for="inlineRadio11">トップページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio12" value="2">';
	echo '  <label class="form-check-label" for="inlineRadio12">会員ページのみ表示</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="flag" id="inlineRadio13" value="3" checked>';
	echo '  <label class="form-check-label" for="inlineRadio13">両方表示</label>';
	echo '</div>';
}
echo '</div>';
echo '</div>';

echo '<div class="row mt-3">';
echo '<div class="col-md-3 py-2 bg-info text-white rounded">';
echo '<label for="inputStatus">表示設定</label>';
echo '</div>';
echo '<div class="col-md-9">';
if ($row['status'] == 1) {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>';
	echo '  <label class="form-check-label" for="inlineRadio1">下書き</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2">';
	echo '  <label class="form-check-label" for="inlineRadio2">公開</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">';
	echo '  <label class="form-check-label" for="inlineRadio3">非公開</label>';
	echo '</div>';
} else if ($row['status'] == 2) {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">';
	echo '  <label class="form-check-label" for="inlineRadio1">下書き</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2" checked>';
	echo '  <label class="form-check-label" for="inlineRadio2">公開</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">';
	echo '  <label class="form-check-label" for="inlineRadio3">非公開</label>';
	echo '</div>';
} else {
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">';
	echo '  <label class="form-check-label" for="inlineRadio1">下書き</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2">';
	echo '  <label class="form-check-label" for="inlineRadio2">公開</label>';
	echo '</div>';
	echo '<div class="form-check form-check-inline">';
	echo '  <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3" checked>';
	echo '  <label class="form-check-label" for="inlineRadio3">非公開</label>';
	echo '</div>';
}
echo '</div>';
echo '</div>';

echo '<div class="pt-5"><button class="btn btn-info" type="submit">変更</button>　<button class="btn btn-light" type="reset">クリア</button></div>';
echo '</form>';
}
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>