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
<h1 class="display-4">図書登録</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2>新しく図書を登録します。</h2>
<hr>
<form action="book-newoutput.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="onoff" value="0">
	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputBookTitle">本のタイトル</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputBookTitle" class="form-control" placeholder="本のタイトル" name="booktitle" required autofocus>
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputAuthor">著者</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputAuthor" class="form-control" placeholder="著者" name="author" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputPublishers">出版社</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputPublishers" class="form-control" placeholder="出版社" name="publishers" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputPublishersURL">出版社の書籍ページURL</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputPublishersURL" class="form-control" placeholder="出版社の書籍ページURL" name="publishers_url" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputISBN">ISBN番号</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputISBN" class="form-control" placeholder="ISBN番号" name="isbn" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputTopImg">表紙画像</label>
		</div>
    		<div class="col-md-5">
			<input type="file" class="form-control-file" id="inputTopImg" accept=".png, .jpg, .jpeg, .gif" name="topimg" required>
		</div>
    		<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputCount">冊数</label>
		</div>
		<div class="col-md-1">
			<?php
			echo '<div class="form-group">';
			echo '<select class="form-control" id="selectCount" name="count" required>';
			echo '<option value="1" checked>1</option>';
			for ($i=2; $i<21; $i++) {
				echo '<option value="', $i, '">', $i, '</option>';
			}
			echo '</select>';
			echo '</div>';
			?>
		</div>
		<div class="col-md-8"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="inputPostad">キーワード</label>
		</div>
    	<div class="col-md-7">
			<textarea class="form-control" id="inputPostad" rows="4" placeholder="キーワード" name="keyword" required></textarea>
		</div>
    		<div class="col-md-2"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3">
			<label for="customRadioCategory01">カテゴリ</label>
		</div>
		<div class="col-md-9">
			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">プログラム言語関連</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0101" name="category01" class="custom-control-input" value="1">
				<label class="custom-control-label" for="customRadioCategory0101">表示させる</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0102" name="category01" class="custom-control-input" value="0" checked>
				<label class="custom-control-label" for="customRadioCategory0102">表示させない</label>
			</div>
		</div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">データーベース関連</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0103" name="category02" class="custom-control-input" value="1">
				<label class="custom-control-label" for="customRadioCategory0103">表示させる</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0104" name="category02" class="custom-control-input" value="0" checked>
				<label class="custom-control-label" for="customRadioCategory0104">表示させない</label>
			</div>
		</div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">マイクロソフトオフィス関連</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0105" name="category03" class="custom-control-input" value="1">
				<label class="custom-control-label" for="customRadioCategory0105">表示させる</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0106" name="category03" class="custom-control-input" value="0" checked>
				<label class="custom-control-label" for="customRadioCategory0106">表示させない</label>
			</div>
		</div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">資格関連</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0107" name="category04" class="custom-control-input" value="1">
				<label class="custom-control-label" for="customRadioCategory0107">表示させる</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0108" name="category04" class="custom-control-input" value="0" checked>
				<label class="custom-control-label" for="customRadioCategory0108">表示させない</label>
			</div>
		</div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">雑誌関連</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0109" name="category05" class="custom-control-input" value="1">
				<label class="custom-control-label" for="customRadioCategory0109">表示させる</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" id="customRadioCategory0110" name="category05" class="custom-control-input" value="0" checked>
				<label class="custom-control-label" for="customRadioCategory0110">表示させない</label>
			</div>
		</div>
	</div>

	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">登録</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>