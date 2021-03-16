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
<title>管理画面 / お問い合わせ一覧｜NERVE FACTORY</title>
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
<h1 class="mb-5" style="border-bottom: solid 3px #444;">お問い合わせ一覧</h1>

<?php
echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM contact WHERE del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '件</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-1">状態</div>';
echo '<div class="col-2">名前</div>';
echo '<div class="col-2">お問い合わせ日時</div>';
echo '<div class="col-5">お問い合わせタイトル</div>';
echo '<div class="col-2">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM contact WHERE del=0 ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
if ($NUMBER % 2 == 0) {
echo '<div class="row bg-light py-2" style="border-bottom: dotted 1px #444;">';
} else {
echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
}   
if ($row['status'] == 0) {
echo '<div class="col-1 h5 pb-0"><span class="badge badge-secondary">未対応</span></div>';
} else if ($row['status'] == 1) {
echo '<div class="col-1 h5 pb-0"><span class="badge badge-primary">返信済み</span></div>';
} else {
echo '<div class="col-1 h5 pb-0"><span class="badge badge-success">解決済み</span></div>';
}
echo '<div class="col-2">', $row['name'], '</div>';
echo '<div class="col-2">', $row['contact_date'], '</div>';
echo '<div class="col-5 text-truncate">', $row['title'], '</div>';
echo '<div class="col-2">';
echo '<form action="admin-contact-input.php" method="post" class="d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '" />';
echo '<input type="hidden" name="email" value="', $row['email'], '" />';
echo '<button class="btn btn-info btn-sm" type="submit">確認・対応</button>';
echo '</form>';
echo '<form action="admin-contact-output.php" method="post" class="ml-3 d-inline">';
echo '<input type="hidden" name="id" value="', $row['id'], '" />';
echo '<input type="hidden" name="del" value="1" />';
echo '<button class="btn btn-info btn-sm" type="submit">削除</button>';
echo '</form>';
echo '</div>';
echo '</div>';
$NUMBER++;
}
if($NUMBER == 0) {
echo '<div class="bg-white p-5">';
echo '現在、お問い合わせはありません。';
echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM contact WHERE del=0";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '件</span>';
echo '</div><!-- /col-md-6 -->';
echo '<div class="col-md-6">';
echo '<ul class="pagination justify-content-end p-0 m-0">';
if($i%10 == 0){
	$allpage = floor($i/10);
} else {
	$allpage = floor($i/10) + 1;
}

if ($_REQUEST['pg'] == 1) {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">前へ</a></li>';
} else {
	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $_REQUEST['pg'] - 1, '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $j, '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-contact-list.php?pg=', $_REQUEST['pg'] + 1, '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
?>
</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>