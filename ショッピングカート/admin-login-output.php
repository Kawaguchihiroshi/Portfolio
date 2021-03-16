<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/admin_header.php'; ?>
    <title>管理画面｜NERVE FACTORY</title>

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

<main>
<div class="row">
<?php
if (isset($_REQUEST['login_name']) and isset($_REQUEST['password'])) {
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from admin where email=? and password=?');
$sql->execute([$_REQUEST['login_name'], $_REQUEST['password']]);
foreach ($sql as $row) {
	$_SESSION['admin']=[
		'id'=>$row['id'], 
		'name'=>$row['name'], 
		'email'=>$row['email'], 
		'tell'=>$row['tell'], 
		'password'=>$row['password'], 
		'del'=>$row['del']
	];
}
}

if (isset($_SESSION['admin'])) {
	if ($_SESSION['admin']['del'] == 1) {
		echo '<div class="col-md-2"></div>';
		echo '<div class="col-md-10 p-5">';
		echo '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">';
		echo '  <strong>ご確認ください!</strong>　このアカウントは退会されいるためご利用できません。ご不明な点がございましたらお問い合わせをお願いいたします。';
		echo '  <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">';
		echo '    <span aria-hidden="true">&times;</span>';
		echo '  </button>';
		echo '</div>';
		echo '</div><!-- /col-md-10 -->';
	} else {
		require 'include/admin_menu.php';
		echo '<div class="col-md-10 p-5">';
		echo '<h1 style="border-bottom: solid 3px #444;">対応必要内容</h1>';
		echo '<div class="row bg-white p-3 mx-4 mt-4" style="border-bottom: solid 2px #444;">';
		echo '<div class="col-3">内容</div>';
		echo '<div class="col-1">件数</div>';
		echo '<div class="col-8">対応ページ</div>';
		echo '</div>';

		echo '<div class="row bg-white p-3 mx-4" style="border-bottom: doted 1px #444;">';
		echo '<div class="col-3">仮会員の人数です。</div>';
		echo '<div class="col-1">';
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql = "SELECT * FROM customer WHERE status=0 AND del=0 AND id NOT IN ('1')";
		$NUMBER = 0;	// 該当件数
		foreach ($pdo->query($sql) as $row) { $NUMBER++; }
		// 仮会員数を表示
		if ($NUMBER > 0) {
			echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
		}
		echo '</div>';
		echo '<div class="col-8"><a href="admin-customer-list.php?level=2">仮会員一覧 <i class="fas fa-angle-double-right"></i></a></div>';
		echo '</div>';

		echo '<div class="row bg-white p-3 mx-4" style="border-bottom: doted 1px #444;">';
		echo '<div class="col-3">注文者の人数です。</div>';
		echo '<div class="col-1">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=0 AND cancel=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
		echo '</div>';
		echo '<div class="col-8"><a href="admin-order-list.php?pg=1&level=0">注文者一覧 <i class="fas fa-angle-double-right"></i></a></div>';
		echo '</div>';

		echo '<div class="row bg-white p-3 mx-4" style="border-bottom: doted 1px #444;">';
		echo '<div class="col-3">支払い完了者の人数です。</div>';
		echo '<div class="col-1">';
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=2 AND cancel=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
		echo '</div>';
		echo '<div class="col-8"><a href="admin-order-list.php?pg=1&level=1">支払完了者一覧 <i class="fas fa-angle-double-right"></i></a></div>';
		echo '</div>';

		echo '<div class="row bg-white p-3 mx-4" style="border-bottom: doted 1px #444;">';
		echo '<div class="col-3">キャンセルの商品です。</div>';
		echo '<div class="col-1">';
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM cart WHERE cancel_date IS NOT NULL";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
		echo '</div>';
		echo '<div class="col-8"><a href="admin-order-list.php?pg=1&level=5">キャンセル一覧 <i class="fas fa-angle-double-right"></i></a></div>';
		echo '</div>';

		echo '<div class="row bg-white p-3 mx-4" style="border-bottom: doted 1px #444;">';
		echo '<div class="col-3">お問い合わせの件数です。</div>';
		echo '<div class="col-1">';
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM contact WHERE status=0";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
		echo '</div>';
		echo '<div class="col-8"><a href="admin-contact-list.php?pg=1">お問い合わせ管理 <i class="fas fa-angle-double-right"></i></a></div>';
		echo '</div>';

		echo '<h1 class="mt-5" style="border-bottom: solid 3px #444;">アクセス分析</h1>';
		echo '<div class="bg-white p-5 mx-4 mt-4 rounded">グーグルアナリティクスを表示させたい。</div>';

		echo '</div><!-- /col-md-10 -->';
	}
} else {
	echo '<div class="col-md-2"></div>';
	echo '<div class="col-md-10 p-5">';
	echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">';
	echo '  <strong>ご確認ください!</strong>　ログイン名またはパスワードが違います。';
	echo '  <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">';
	echo '    <span aria-hidden="true">&times;</span>';
	echo '  </button>';
	echo '</div>';
	echo '</div><!-- /col-md-10 -->';
}
?>
</div><!-- /row -->
</main>

<?php require 'include/footer.php'; ?>