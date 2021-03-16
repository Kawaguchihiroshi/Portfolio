<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
	header('Location: admin.php');
}
ini_set('display_errors',1);
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/staff_header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/staff_menu.php';?>

<main role="main" class="container py-5">
<div class="p-4 text-white rounded bg-dark">
<h1 class="display-4">図書管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
<?php
if (is_uploaded_file($_FILES['topimg']['tmp_name'])) {
	if (!file_exists('img')) {
		mkdir('img');
	}

	// 先頭7桁をアップロードファイルの先頭につける（ファイル名かぶり防止）
	$str = str_shuffle('abcdefghijkmnpqrstuvwxyz0123456789');
	$first_name = substr(str_shuffle($str), 0, 7);

	$file = 'img/'.$first_name.basename($_FILES['topimg']['name']);
	if (move_uploaded_file($_FILES['topimg']['tmp_name'], $file)) {
		$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
		$sql=$pdo->prepare('update book set booktitle=?, author=?, publishers=?, publishers_url=?, isbn=?, topimg=?, count=?, keyword=?, category01=?, category02=?, category03=?, category04=?, category05=?, onoff=? WHERE id=?');
		$sql->execute([
			$_REQUEST['booktitle'],
			$_REQUEST['author'],
			$_REQUEST['publishers'],
			$_REQUEST['publishers_url'],
			$_REQUEST['isbn'],
			$first_name.basename($_FILES['topimg']['name']),
			$_REQUEST['count'],
			$_REQUEST['keyword'],
			$_REQUEST['category01'],
			$_REQUEST['category02'],
			$_REQUEST['category03'],
			$_REQUEST['category04'],
			$_REQUEST['category05'],
			$_REQUEST['onoff'],
			$_REQUEST['id']
		]);

			echo '<h2>以下の内容で図書を変更しました。</h2>';
			echo '<hr>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">本のタイトル</div>';
			echo '<div class="col-md-9">', $_REQUEST['booktitle'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">著者</div>';
			echo '<div class="col-md-9">', $_REQUEST['author'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">出版社</div>';
			echo '<div class="col-md-9">', $_REQUEST['publishers'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">出版社の書籍ページURL</div>';
			echo '<div class="col-md-9">', $_REQUEST['publishers_url'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">ISBN番号</div>';
			echo '<div class="col-md-9">', $_REQUEST['isbn'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">表紙画像</div>';
			echo '<div class="col-md-2"><img class="w-100" src="', $file, '"></div>';
			echo '<div class="col-md-7"></div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">冊数</div>';
			echo '<div class="col-md-9">', $_REQUEST['count'], '冊</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">キーワード</div>';
			echo '<div class="col-md-9">', $_REQUEST['keyword'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">表示カテゴリー</div>';
			echo '<div class="col-md-9">';
			if ($_REQUEST['category01'] == 1) {
				echo '<div>・プログラム言語</div>';
			}
			if ($_REQUEST['category02'] == 1) {
				echo '<div>・データーベース</div>';
			}
			if ($_REQUEST['category03'] == 1) {
				echo '<div>・マイクロソフトオフィス</div>';
			}
			if ($_REQUEST['category04'] == 1) {
				echo '<div>・資格関連</div>';
			}
			if ($_REQUEST['category05'] == 1) {
				echo '<div>・雑誌関連</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">公開設定</div>';
			echo '<div class="col-md-9">';
			if ($_REQUEST['onoff'] == 0) {
				echo '公開中';
			} else {
				echo '非公開';
			}
			echo '</div>';
			echo '';
			echo '<div class="mt-5"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';

	} else {
		echo '<h1>ファイルのアップロードに失敗しました。</h1>';
		echo '<a href="book-list.php">図書管理ページに戻る</a>';
	}
} else {
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('update book set booktitle=?, author=?, publishers=?, publishers_url=?, isbn=?, count=?, keyword=?, category01=?, category02=?, category03=?, category04=?, category05=?, onoff=? WHERE id=?');
$sql->execute([
	$_REQUEST['booktitle'],
	$_REQUEST['author'],
	$_REQUEST['publishers'],
	$_REQUEST['publishers_url'],
	$_REQUEST['isbn'],
	$_REQUEST['count'],
	$_REQUEST['keyword'],
	$_REQUEST['category01'],
	$_REQUEST['category02'],
	$_REQUEST['category03'],
	$_REQUEST['category04'],
	$_REQUEST['category05'],
	$_REQUEST['onoff'],
	$_REQUEST['id']
]);

			echo '<h2>以下の内容で図書を変更しました。</h2>';
			echo '<hr>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">本のタイトル</div>';
			echo '<div class="col-md-9">', $_REQUEST['booktitle'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">著者</div>';
			echo '<div class="col-md-9">', $_REQUEST['author'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">出版社</div>';
			echo '<div class="col-md-9">', $_REQUEST['publishers'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">出版社の書籍ページURL</div>';
			echo '<div class="col-md-9">', $_REQUEST['publishers_url'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">ISBN番号</div>';
			echo '<div class="col-md-9">', $_REQUEST['isbn'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">表紙画像</div>';
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
$sql->execute([$_REQUEST['id']]);
foreach ($sql->fetchAll() as $row) {
			echo '<div class="col-md-2"><img class="w-100" src="img/', $row['topimg'], '"></div>';
}
			echo '<div class="col-md-7"></div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">冊数</div>';
			echo '<div class="col-md-9">', $_REQUEST['count'], '冊</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">キーワード</div>';
			echo '<div class="col-md-9">', $_REQUEST['keyword'], '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">表示カテゴリー</div>';
			echo '<div class="col-md-9">';
			if ($_REQUEST['category01'] == 1) {
				echo '<div>・プログラム言語</div>';
			}
			if ($_REQUEST['category02'] == 1) {
				echo '<div>・データーベース</div>';
			}
			if ($_REQUEST['category03'] == 1) {
				echo '<div>・マイクロソフトオフィス</div>';
			}
			if ($_REQUEST['category04'] == 1) {
				echo '<div>・資格関連</div>';
			}
			if ($_REQUEST['category05'] == 1) {
				echo '<div>・雑誌関連</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '';
			echo '<div class="row pt-4">';
			echo '<div class="col-md-3">公開設定</div>';
			echo '<div class="col-md-9">';
			if ($_REQUEST['onoff'] == 0) {
				echo '公開中';
			} else {
				echo '非公開';
			}
			echo '</div>';
			echo '';
			echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';

}
?>

</div>
</main>

<?php require 'include/staff_footer.php';?>