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
<title>管理画面 / カテゴリーの管理｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">カテゴリー一覧</h1>

<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">
<div class="col-1 text-center">状態</div>
<div class="col-3">カテゴリー名</div>
<div class="col-2 text-center">状態変更</div>
<div class="col-1 text-center">表示順位</div>
<div class="col-1">操作</div>
<div class="col-4"></div>
</div>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM category WHERE id NOT IN ('100')";
$NUMBER = 0;
foreach ($pdo->query($sql) as $row) {
echo '<form action="admin-category-output.php" method="post">';
echo '<input type="hidden" name="id" value="', $row['id'], '">';
if ($NUMBER % 2 == 0) {
    echo '<div class="row bg-light py-2" style="border-bottom: dotted 1px #444;">';
} else {
    echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
}
if ($row['status'] == 2) {
    echo '<div class="col-1 h5 pb-0 text-center"><span class="badge badge-primary">公開中</span></div>';
} else {
    echo '<div class="col-1 h5 pb-0 text-center"><span class="badge badge-success">非表示</span></div>';
}
echo '<div class="col-3"><input type="text" class="form-control" placeholder="カテゴリー名" name="name" value="', $row['name'], '" required></div>';
echo '<div class="col-2 text-center">';
if ($row['status'] == 2) {
    echo '<div class="form-check form-check-inline">';
    echo '<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2" checked>';
    echo '<label class="form-check-label" for="inlineRadio2">公開</label>';
    echo '</div>';
    echo '<div class="form-check form-check-inline ml-3">';
    echo '<input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">';
    echo '<label class="form-check-label" for="inlineRadio3">非公開</label>';
    echo '</div>';
} else {
    echo '<div class="form-check form-check-inline">';
    echo '<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="2">';
    echo '<label class="form-check-label" for="inlineRadio2">公開</label>';
    echo '</div>';
    echo '<div class="form-check form-check-inline ml-3">';
    echo '<input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3" checked>';
    echo '<label class="form-check-label" for="inlineRadio3">非公開</label>';
    echo '</div>';
}
echo '</div>';
echo '<div class="col-1"><input type="text" class="form-control" placeholder="順番" name="number" value="', $row['number'], '" required></div>';
echo '<div class="col-1">';
echo '<button class="btn btn-info btn-sm" type="submit">変更</button>';
echo '</div>';
echo '<div class="col-4"></div>';
echo '</div>';
echo '</form>';
$NUMBER++;
}
?>
</div>
</main>
<?php require 'include/footer.php'; ?>