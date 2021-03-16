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
<title>管理画面 / 
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 会員一覧に関する処理
echo '会員一覧';
break;

case '1':	// 退会者一覧に関する処理
echo '退会者一覧';
break;

case '2':	// 仮登録者一覧に関する処理
echo '仮登録者一覧';
break;

case '10':	// 会員検索結果に関する処理
echo '会員検索';
break;

case '11':	// 退会者検索結果に関する処理
echo '退会者検索';
break;

case '12':	// 仮登録者検索結果に関する処理
echo '仮登録者検索';
break;
}
?>
｜NERVE FACTORY</title>
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
<h1 class="mb-4" style="border-bottom: solid 3px #444;">
<?php
$pref = $_REQUEST['level'];
switch ($pref){
case '0':	// 会員一覧に関する処理
echo '会員一覧';
break;

case '1':	// 退会者一覧に関する処理
echo '退会者一覧';
break;

case '2':	// 仮登録者一覧に関する処理
echo '仮登録者一覧';
break;

case '10':	// 会員検索結果に関する処理
echo '会員検索';
break;

case '11':	// 退会者検索結果に関する処理
echo '退会者検索';
break;

case '12':	// 仮登録者検索結果に関する処理
echo '仮登録者検索';
break;
}
?>
</h1>

<?php
$pref = $_REQUEST['level'];

switch ($pref){
case '0':	// 会員一覧に関する処理
echo '<form action="admin-customer-list.php?level=10" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">会員検索</div></div>';
echo '<input type="text" class="form-control" placeholder="会員検索" name="word">';
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※会員検索は「会員ID」「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-customer-newinput.php">新しく会員を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE status=1 AND del=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">会員ID</div>';
echo '<div class="col-2">名前</div>';
echo '<div class="col-1">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-5">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE status=1 AND del=0 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-2">', $row['customer_no'], '</div>';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-1">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-5">';
	echo '<form action="admin-customer-input.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">変更</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="1">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '現在、会員はいません。';
	echo '</div>';
}


echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE status=1 AND del=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '1':	// 退会者一覧に関する処理
echo '<form action="admin-customer-list.php?level=11" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">退会者検索</div></div>';
echo '<input type="text" class="form-control" placeholder="退会者検索" name="word">';
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※退会者検索は「会員ID」「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-5"></div>';
echo '</div>';
echo '</form>';

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE del=1 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">会員ID</div>';
echo '<div class="col-1">会員区分</div>';
echo '<div class="col-2">名前</div>';
echo '<div class="col-2">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-3">操作</div>';
echo '</div>';


$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE del=1 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-2">', $row['customer_no'], '</div>';
	echo '<div class="col-1">';
	if ($row['status'] == 0) {
		echo '<span class="badge badge-danger">仮会員</span>';
	} else if ($row['status'] == 1) {
		echo '<span class="badge badge-danger">会員</span>';
	}
	echo '</div>';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-2">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-3">';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="0">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会解除</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '現在、退会者はいません。';
	echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE del=1 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '2':	// 仮登録者一覧に関する処理
echo '<form action="admin-customer-list.php?level=12" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">仮登録者検索</div></div>';
echo '<input type="text" class="form-control" placeholder="仮登録者検索" name="word">';
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※仮登録者検索は「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-customer-newinput.php">新しく仮会員を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE status=0 AND del=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}
for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';


echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">名前</div>';
echo '<div class="col-1">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-3">メールアドレス</div>';
echo '<div class="col-4">操作</div>';
echo '</div>';

$count = ($_REQUEST['pg'] - 1) * 10;
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE status=0 AND del=0 AND id NOT IN ('1') ORDER BY id DESC LIMIT 10 OFFSET " . $count . "";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-1">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-3">', $row['email'], '</div>';
	echo '<div class="col-4">';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="email" value="', $row['email'], '">';
	echo '<input type="hidden" name="customer_no" value="', $row['customer_no'], '">';
	echo '<input type="hidden" name="level" value="3">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">アドレス確認の再送信</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="email" value="', $row['email'], '">';
	echo '<input type="hidden" name="status" value="1">';
	echo '<input type="hidden" name="level" value="2">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">会員に変更</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="1">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '現在、仮会員はいません。';
	echo '</div>';
}

echo '<hr>';
echo '<div class="row px-3">';
echo '<div class="col-md-6 mt-2">';
echo '<span>全';
$i=0;
$j=0;
$sql = "SELECT * FROM customer WHERE status=0 AND del=0 AND id NOT IN ('1')";
foreach ($pdo->query($sql) as $row) { $i++; }
echo $i, '人</span>';
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
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] - 1, '&level=', $_REQUEST['level'], '">前へ</a></li>';
}

for ($j=1; $j<=$allpage; $j++) {
    if ($j == $_REQUEST['pg']) {
    	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">', $j, '</a></li>';
    } else {
    	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $j, '&level=', $_REQUEST['level'], '">', $j, '</a></li>';
    }
}

if ($_REQUEST['pg'] + 1 < $j) {
	echo '<li class="page-item"><a class="page-link" href="admin-customer-list.php?pg=', $_REQUEST['pg'] + 1, '&level=', $_REQUEST['level'], '">次へ</a></li>';
} else {
	echo '<li class="page-item disabled" tabindex="-1" aria-disabled="true"><a class="page-link" href="#">次へ</a></li>';
}

echo '</ul>';
echo '</div><!-- /col-md-6 -->';
echo '</div><!-- /row -->';
echo '<hr>';
break;

case '10':	// 会員検索結果に関する処理
echo '<form action="admin-customer-list.php?level=10" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">会員検索</div></div>';
if (empty($_REQUEST['word'])) {
	echo '<input type="text" class="form-control" placeholder="会員検索" name="word">';
	$search = '';
} else {
	echo '<input type="text" class="form-control" placeholder="会員検索" name="word" value="', $_REQUEST['word'], '">';
	$search = htmlspecialchars($_REQUEST['word']);
}
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※会員検索は「会員ID」「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-customer-newinput.php">新しく会員を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-1">会員ID</div>';
echo '<div class="col-2">名前</div>';
echo '<div class="col-2">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-5">操作</div>';
echo '</div>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE ( name LIKE '%$search%' OR post_no LIKE '%$search%' OR tell LIKE '%$search%' OR email LIKE '%$search%' OR adrs LIKE '%$search%' OR customer_no LIKE '%$search%' ) AND status=1 AND del=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-1">', $row['customer_no'], '</div>';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-2">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-5">';
	echo '<form action="admin-customer-input.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">変更</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="1">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '検索結果がありませんでした。';
	echo '</div>';
}
break;

case '11':	// 退会者検索結果に関する処理
echo '<form action="admin-customer-list.php?level=11" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">退会者検索</div></div>';
if (empty($_REQUEST['word'])) {
	echo '<input type="text" class="form-control" placeholder="退会者検索" name="word">';
	$search = '';
} else {
	echo '<input type="text" class="form-control" placeholder="退会者検索" name="word" value="', $_REQUEST['word'], '">';
	$search = htmlspecialchars($_REQUEST['word']);
}
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※退会者検索は「会員ID」「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-5"></div>';
echo '</div>';
echo '</form>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">会員ID</div>';
echo '<div class="col-1">会員区分</div>';
echo '<div class="col-2">名前</div>';
echo '<div class="col-2">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-3">操作</div>';
echo '</div>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE ( name LIKE '%$search%' OR post_no LIKE '%$search%' OR tell LIKE '%$search%' OR email LIKE '%$search%' OR adrs LIKE '%$search%' OR customer_no LIKE '%$search%' ) AND del=1 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-2">', $row['customer_no'], '</div>';
	echo '<div class="col-1">';
	if ($row['status'] == 0) {
		echo '<span class="badge badge-danger">仮会員</span>';
	} else if ($row['status'] == 1) {
		echo '<span class="badge badge-danger">会員</span>';
	}
	echo '</div>';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-2">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-3">';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="0">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会解除</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '検索結果がありませんでした。';
	echo '</div>';
}
break;

case '12':	// 仮登録者検索結果に関する処理
echo '<form action="admin-customer-list.php?level=12" method="post" class="d-inline">';
echo '<div class="row bg-white py-2 mb-4 rounded">';
echo '<div class="col-7">';
echo '<div class="input-group">';
echo '<div class="input-group-prepend"><div class="input-group-text">仮登録者検索</div></div>';
if (empty($_REQUEST['word'])) {
	echo '<input type="text" class="form-control" placeholder="仮登録者検索" name="word">';
	$search = '';
} else {
	echo '<input type="text" class="form-control" placeholder="仮登録者検索" name="word" value="', $_REQUEST['word'], '">';
	$search = htmlspecialchars($_REQUEST['word']);
}
echo '<div class="input-group-append"><button class="btn btn-info" type="submit">検索</button></div>';
echo '</div>';
echo '<div class="small">※仮登録者検索は「氏名」「郵便番号」「住所」「電話番号」「メールアドレス」の情報で検索できます。</div>';
echo '</div>';
echo '<div class="col-1"></div>';
echo '<div class="col-4 text-right"><a class="btn btn-info" href="admin-customer-newinput.php">新しく仮会員を登録</a></div>';
echo '</div>';
echo '</form>';

echo '<div class="row bg-white py-4" style="border-bottom: solid 2px #444; font-weight: bold;">';
echo '<div class="col-2">名前</div>';
echo '<div class="col-1">郵便番号</div>';
echo '<div class="col-2">電話番号</div>';
echo '<div class="col-3">メールアドレス</div>';
echo '<div class="col-4">操作</div>';
echo '</div>';

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE ( name LIKE '%$search%' OR post_no LIKE '%$search%' OR tell LIKE '%$search%' OR email LIKE '%$search%' OR adrs LIKE '%$search%' ) AND status=0 AND del=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当人数
foreach ($pdo->query($sql) as $row) {
	echo '<div class="row bg-white py-2" style="border-bottom: dotted 1px #444;">';
	echo '<div class="col-2">', $row['name'], '</div>';
	echo '<div class="col-1">', $row['post_no'], '</div>';
	echo '<div class="col-2">', $row['tell'], '</div>';
	echo '<div class="col-3">', $row['email'], '</div>';
	echo '<div class="col-4">';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="email" value="', $row['email'], '">';
	echo '<input type="hidden" name="customer_no" value="', $row['customer_no'], '">';
	echo '<input type="hidden" name="level" value="3">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">アドレス確認の再送信</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="email" value="', $row['email'], '">';
	echo '<input type="hidden" name="status" value="1">';
	echo '<input type="hidden" name="level" value="2">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">会員に変更</button>';
	echo '</form>';
	echo '<form action="admin-customer-output.php" method="post" class="d-inline">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="del" value="1">';
	echo '<input type="hidden" name="level" value="1">';
	echo '<button class="btn btn-info btn-sm ml-2" type="submit">退会</button>';
	echo '</form>';
	echo '</div>';
	echo '</div>';
	$NUMBER++;
}
if($NUMBER == 0) {
	echo '<div class="bg-white p-5">';
	echo '検索結果がありませんでした。';
	echo '</div>';
}
break;

}
?>

</div><!-- /col-md-10 -->
</main>
<?php require 'include/footer.php'; ?>