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
<?php
if (isset($_POST['search'])) {
	$search = htmlspecialchars($_POST['search']);
	$search_value = $search;
}else if (isset($_GET['search'])) {
	$search = htmlspecialchars($_GET['search']);
	$search_value = $search;
} else {
	$search = '';
	$search_value = '';
}
?>
		<div class="container">
			<!-- 列の例 -->
			<div class="row p-4 bg-info rounded">
				<div class="col-md-3 text-white text-center" style="font-size:22px; font-weight:bold;">図書検索</div>
				<div class="col-md-9">
				 	<form class="form-inline my-2 my-lg-0" action="book-list.php" method="post">
						<div class="input-group w-100">

							<input class="form-control" type="text" name="search" value="<?php echo $search_value ?>" placeholder="検索ワード" aria-label="検索ワード" aria-describedby="button-addon2">

							<div class="input-group-append">
								<button class="btn btn-outline-light" type="submit" id="button-addon2">検索</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.container -->

<div class="p-5 mt-3 bg-white">
	<h2>現在登録されている図書は以下の通りです。</h2>
	<hr>
	<div class="row my-4">
		<div class="col-md-2 text-center" style="font-weight:bold;">状態</div>
		<div class="col-md-8" style="font-weight:bold;">本のタイトル</div>
    		<div class="col-md-2 text-center" style="font-weight:bold;">変更</div>
	</div>
<?php
$i = 0;
$sql = "SELECT * FROM book WHERE keyword LIKE '%$search%'";

foreach ($pdo->query($sql) as $row) {
if ($i % 2 == 1) {
	echo '	<div class="row py-2">';
	echo '		<div class="col-md-2 text-center">';
	if ($row['onoff'] == 0) {
		echo '<h3><span class="badge badge-primary">表示中</span></h3>';
	} else {
		echo '<h3><span class="badge badge-secondary">非表示</span></h3>';
	}
	echo '</div>';
	echo '		<div class="col-md-2"><img class="w-100" src="img/', $row['topimg'], '"></div>';
	echo '	    	<div class="col-md-6 text-truncate">', $row['booktitle'], '</div>';
	echo '  	<div class="col-md-2 text-center"><a class="btn btn-sm btn-info" href="book-input.php?id=', $row['id'], '">変更</a></div>';
	echo '	</div>';
	$i++;
} else {
	echo '	<div class="row py-2 bg-light">';
	echo '		<div class="col-md-2 text-center">';
	if ($row['onoff'] == 0) {
		echo '<h3><span class="badge badge-primary">表示中</span></h3>';
	} else {
		echo '<h3><span class="badge badge-secondary">非表示</span></h3>';
	}
	echo '</div>';
	echo '		<div class="col-md-2"><img class="w-100" src="img/', $row['topimg'], '"></div>';
	echo '	    	<div class="col-md-6 text-truncate">', $row['booktitle'], '</div>';
	echo '  	<div class="col-md-2 text-center"><a class="btn btn-sm btn-info" href="book-input.php?id=', $row['id'], '">変更</a></div>';
	echo '	</div>';
	$i++;
}
}
?>

</div>
</main>

<?php require 'include/staff_footer.php' ;?>