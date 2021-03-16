<?php session_start(); ?>
<!DOCTYPE  html>
<html lang="ja">
<head>
<?php require 'include/header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/menu.php';?>
<div class="jumbotron jumbotron-fluid mb-0">
<div class="container">
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<h1>図書管理システム</h1>
<p>書籍の貸し出しを管理します。<br />書籍を貸りる際は、貸出申請を出してください。</p>
<a class="btn btn-primary btn-lg" href="images/manual.pdf" role="button">詳しい使い方はこちら ≫</a>
<div class="col-lg-2"></div>
</div>
</div>
</div>
</div>

<main role="main">
		<div class="container mt-4">
			<!-- 列の例 -->
			<div class="row p-4 bg-info rounded">
				<div class="col-md-3 text-white text-center" style="font-size:22px; font-weight:bold;">図書検索</div>
				<div class="col-md-9">
				 	<form class="form-inline my-2 my-lg-0" action="search.php">
						<div class="input-group w-100">
							<input class="form-control" type="text" name="search" value="" placeholder="検索ワード" aria-label="検索ワード" aria-describedby="button-addon2">
							<div class="input-group-append">
								<button class="btn btn-outline-light" type="submit" id="button-addon2">検索</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.container -->

<div class="container mt-4 mb-4 rounded">
<h2>お知らせ</h2>
<hr>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$i = 0;
foreach ($pdo->query('SELECT * FROM info WHERE onoff=0 AND unsub=0') as $row) {
	// 最新5件を表示
	if ($i < 5) {
		echo '<div class="row p-3">';
		echo '<div class="col-md-3 text-center h5">', $row['do_date'], ' 更新</div>';
		echo '<div class="col-md-9"><h2 class="h5"><a href="news_detail.php?id=', $row['id'], '" role="button">', $row['title'], '</a></h2></div>';
		echo '</div>';
		echo '<div class="bd-dot"></div>';
		$i++;
	} else {
		$i++;
	}
}
// echo '<div class="mt-2">全', $i, '件中 5 件表示</div>';
?>

</div><!-- /.container -->
</main>
<?php require 'include/footer.php' ;?>