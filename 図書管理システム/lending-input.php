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
<h2><i class="fas fa-file-alt"></i> 返却予定日の変更</h2>
<hr>
<form action="lending-output.php" method="post">
<?php
echo '<input type="hidden" name="id" value="', $_GET['id'], '">';

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
if (isset($_REQUEST['id'])) {
	$b_id = htmlspecialchars($_REQUEST['id']);
} else if (isset($_GET['id'])) {
	$b_id = htmlspecialchars($_GET['id']);
} else {
	$b_id = '';
}

$sql = "SELECT * FROM rentdata WHERE id=$b_id";
foreach ($pdo->query($sql) as $row) {

$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
$sql->execute([$row['book_id']]);
foreach ($sql->fetchAll() as $book) {
	echo '<h2 class="h3">申請図書データ</h2>';
	echo '<hr />';
	echo '<div class="row mx-1 mb-2">';
	echo '<div class="col-md-2 p-2"><img class="w-100" src="img/', $book['topimg'], '"></div>';
	echo '<div class="col-md-10 p-2">';
	echo '<h5>', $book['booktitle'], '</h5>';
	echo '<div class="mt-1">著者：', $book['author'], '</div>';
	echo '<div class="mt-1">出版社：', $book['publishers'], '</div>';
	echo '<div class="mt-1">ISBN番号：', $book['isbn'], '</div>';
	echo '</div>';
	echo '</div><!-- /.row -->';
echo '<input type="hidden" name="book_id" value="', $book['id'], '">';
}

echo '</div>';
echo '';
echo '<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '		<label>返却予定日</label>';
echo '		</div>';
echo '	<div class="col-md-5">';
echo '	<input id="datepicker" type="text" class="form-control" placeholder="返却予定日(yyyy-mm-ddで記入)" name="plan_return_date" value="', $row['plan_return_date'], '" required>';
echo '	</div>';
echo '		<div class="col-md-4"></div>';
echo '</div>';
}
?>
	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">返却予定日を変更する</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>

      </div><!-- /.product-area -->

</main>
<script>
$( "#datepicker" ).datepicker({
dateFormat: 'yy-mm-dd',
monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
dayNames:["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
dayNamesShort:["日","月","火","水","木","金","土"],
dayNamesMin:["日","月","火","水","木","金","土"],
prevText:"&#x3C;前",
nextText:"次&#x3E;",
});
</script>
<?php require 'include/footer.php'; ?>