<?php session_start(); ?>
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
<h1 class="display-4">図書管理システムの使い方</h1>
</div>

<div class="p-5 mt-3 bg-white rounded">
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link py-2 active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-file-alt"></i> 貸出申請を出してみよう</a>
</li>
<li class="nav-item">
<a class="nav-link py-2" id="book-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book" aria-selected="false"><i class="fas fa-book"></i> 本の検索</a>
</li>
<li class="nav-item">
<a class="nav-link py-2" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false"><i class="fas fa-comment"></i> 本のリクエスト</a>
</li>
<li class="nav-item">
<a class="nav-link py-2" id="favorite-tab" data-toggle="tab" href="#favorite" role="tab" aria-controls="favorite" aria-selected="false"><i class="fas fa-heart"></i> お気に入り機能</a>
</li>
<li class="nav-item">
<a class="nav-link py-2" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="far fa-envelope"></i> 情報変更依頼</a>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<div class="h2 mt-4"><i class="fas fa-file-alt"></i> 貸出申請を出してみよう</div>
<hr>
	
<div class="p-2 mb-2">
	<div class="pt-3 pl-3 pb-2 rounded" style="background-color:#ccc;">
		<h3><i class="fas fa-chevron-circle-right"></i> ログインIDとパスワードの確認</h3>
	</div>
	<div class="row mt-2">
		<div class="col-md-6"><img class="w-100 img-thumbnail" src="images/howto_0101.jpg" alt=""></div>
		<div class="col-md-6">まずは、お使いのメーラーを開いてください。<br>左図のような「図書管理システムのログインID、パスワードのお知らせ」メールを確認しましょう。</div>
	</div>
</div>
	
<div class="text-center p-4 display-4">
<i class="fas fa-arrow-alt-circle-down"></i>
</div>
	
<div class="p-2 mb-2">
	<div class="pt-3 pl-3 pb-2 rounded" style="background-color:#ccc;">
		<h3><i class="fas fa-chevron-circle-right"></i> ログインする</h3>
	</div>
	<div class="row mt-2">
		<div class="col-md-6"><img class="w-100 img-thumbnail" src="images/howto_0101.jpg" alt=""></div>
		<div class="col-md-6">まずは、お使いのメーラーを開いてください。<br>左図のような「図書管理システムのログインID、パスワードのお知らせ」メールを確認しましょう。</div>
	</div>
</div>
	
<div class="text-center p-4 display-4">
<i class="fas fa-arrow-alt-circle-down"></i>
</div>
	
<div class="p-2 mb-2">
	<div class="pt-3 pl-3 pb-2 rounded" style="background-color:#ccc;">
		<h3><i class="fas fa-chevron-circle-right"></i> 訓練生メニューを確認</h3>
	</div>
	<div class="row mt-2">
		<div class="col-md-6"><img class="w-100 img-thumbnail" src="images/howto_0101.jpg" alt=""></div>
		<div class="col-md-6">まずは、お使いのメーラーを開いてください。<br>左図のような「図書管理システムのログインID、パスワードのお知らせ」メールを確認しましょう。</div>
	</div>
</div>
	
<div class="text-center p-4 display-4">
<i class="fas fa-arrow-alt-circle-down"></i>
</div>
	
<div class="p-2 mb-2">
	<div class="pt-3 pl-3 pb-2 rounded" style="background-color:#ccc;">
		<h3><i class="fas fa-chevron-circle-right"></i> 本を検索</h3>
	</div>
	<div class="row mt-2">
		<div class="col-md-6"><img class="w-100 img-thumbnail" src="images/howto_0101.jpg" alt=""></div>
		<div class="col-md-6">まずは、お使いのメーラーを開いてください。<br>左図のような「図書管理システムのログインID、パスワードのお知らせ」メールを確認しましょう。</div>
	</div>
</div>

<div class="p-2 text-right bg-light"><a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>
</div><!-- / home-tab --------------------------------------------------------- -->

<div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="book-tab">
<div class="h2 mt-4"><i class="fas fa-book"></i> 本の検索</div>
<hr>
<div class="p-2 mb-2">テキスト</div>
<div class="p-2 text-right bg-light"><a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>
</div><!-- / book-tab --------------------------------------------------------- -->

<div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
<div class="h2 mt-4"><i class="fas fa-comment"></i> 本のリクエスト</div>
<hr>
<div class="p-2 mb-2">テキスト</div>
<div class="p-2 text-right bg-light"><a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>
</div><!-- / request-tab --------------------------------------------------------- -->

<div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
<div class="h2 mt-4"><i class="fas fa-heart"></i> お気に入り機能</div>
<hr>
<div class="p-2 mb-2">テキスト</div>
<div class="p-2 text-right bg-light"><a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>
</div><!-- / favorite-tab --------------------------------------------------------- -->

<div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
<div class="h2 mt-4"><i class="far fa-envelope"></i> 情報変更依頼</div>
<hr>
<div class="p-2 mb-2">テキスト</div>
<div class="p-2 text-right bg-light"><a class="btn btn-outline-success ml-3" href="index.php">ホームに戻る <i class="fas fa-chevron-circle-right"></i></a></div>
</div><!-- / info-tab --------------------------------------------------------- -->
</div><!-- / #myTabContent ----------------------------------------------------------------------------------------------------------- -->

</div>
</main>
<?php require 'include/footer.php'; ?>