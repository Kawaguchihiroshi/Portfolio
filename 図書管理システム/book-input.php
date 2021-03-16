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
<h2>図書の情報を変更します。</h2>
<hr>
<form action="book-output.php" method="post" enctype="multipart/form-data">
<?php
$sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
$sql->execute([$_GET['id']]);
foreach ($sql->fetchAll() as $row) {
echo '	<input type="hidden" name="id" value="', $_GET['id'], '">';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputBookTitle">本のタイトル</label>';
echo '		</div>';
echo '    	<div class="col-md-5">';
echo '			<input type="text" id="inputBookTitle" class="form-control" placeholder="本のタイトル" name="booktitle" value="', $row['booktitle'], '" required autofocus>';
echo '		</div>';
echo '    	<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputAuthor">著者</label>';
echo '		</div>';
echo '   	<div class="col-md-5">';
echo '			<input type="text" id="inputAuthor" class="form-control" placeholder="著者" name="author" value="', $row['author'], '" required>';
echo '		</div>';
echo '   		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputPublishers">出版社</label>';
echo '		</div>';
echo '   	<div class="col-md-5">';
echo '			<input type="text" id="inputPublishers" class="form-control" placeholder="出版社" name="publishers" value="', $row['publishers'], '" required>';
echo '		</div>';
echo '    		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputPublishersURL">出版社の書籍ページURL</label>';
echo '		</div>';
echo '    	<div class="col-md-5">';
echo '			<input type="text" id="inputPublishersURL" class="form-control" placeholder="出版社の書籍ページURL" name="publishers_url" value="', $row['publishers_url'], '" required>';
echo '		</div>';
echo '    		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputISBN">ISBN番号</label>';
echo '		</div>';
echo '    	<div class="col-md-5">';
echo '			<input type="text" id="inputISBN" class="form-control" placeholder="ISBN番号" name="isbn" value="', $row['isbn'], '" required>';
echo '		</div>';
echo '    		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputTopImg">表紙画像</label>';
echo '		</div>';
echo '   	<div class="col-md-5">';
echo '   		<div><img class="w-25" src="img/', $row['topimg'], '"></div>';
echo '   		<div class="py-2 small">※差し替える場合のみファイルを選択してください。</div>';
echo '			<input type="file" class="form-control-file" id="inputTopImg" accept=".png, .jpg, .jpeg, .gif" name="topimg">';
echo '		</div>';
echo '    		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="selectCount">冊数</label>';
echo '		</div>';
echo '    	<div class="col-md-1">';
echo '<div class="form-group">';
echo '    <select class="form-control" id="selectCount" name="count" required>';
for ($i=1; $i<21; $i++) {
	if ($row['count'] == $i) {
		echo '<option value="', $i, '" selected>', $i, '</option>';
	} else {
		echo '<option value="', $i, '">', $i, '</option>';
	}
}
echo '    </select>';
echo ' </div>';
echo '		</div>';
echo '    		<div class="col-md-8"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputPostad">キーワード</label>';
echo '		</div>';
echo '    	<div class="col-md-7">';
echo '			<textarea class="form-control" id="inputPostad" rows="4" placeholder="キーワード" name="keyword" required>', $row['keyword'], '</textarea>';
echo '		</div>';
echo '    		<div class="col-md-2"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="customRadioCategory01">カテゴリ</label>';
echo '		</div>';
echo '		<div class="col-md-9">';
echo '			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">プログラム言語関連</div>';
if($row['category01'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0101" name="category01" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0101">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0102" name="category01" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0102">表示させない</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0101" name="category01" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0101">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0102" name="category01" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0102">表示させない</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3"></div>';
echo '		<div class="col-md-9">';
echo '			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">データーベース関連</div>';
if($row['category02'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0103" name="category02" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0103">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0104" name="category02" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0104">表示させない</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0103" name="category02" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0103">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0104" name="category02" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0104">表示させない</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3"></div>';
echo '		<div class="col-md-9">';
echo '			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">マイクロソフトオフィス関連</div>';
if($row['category03'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0105" name="category03" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0105">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0106" name="category03" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0106">表示させない</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0105" name="category03" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0105">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0106" name="category03" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0106">表示させない</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3"></div>';
echo '		<div class="col-md-9">';
echo '			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">資格関連</div>';
if($row['category04'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0107" name="category04" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0107">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0108" name="category04" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0108">表示させない</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0107" name="category04" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0107">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0108" name="category04" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0108">表示させない</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3"></div>';
echo '		<div class="col-md-9">';
echo '			<div class="custom-control custom-radio custom-control-inline" style="width: 250px;">雑誌関連</div>';
if($row['category05'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0109" name="category05" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0109">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0110" name="category05" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0110">表示させない</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0109" name="category05" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0109">表示させる</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0110" name="category05" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0110">表示させない</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="customRadioCategory02">本の情報公開設定</label>';
echo '		</div>';
echo '		<div class="col-md-9">';
if($row['onoff'] == 0){
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0201" name="onoff" class="custom-control-input" value="0" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0201">公開中</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0202" name="onoff" class="custom-control-input" value="1">';
echo '				<label class="custom-control-label" for="customRadioCategory0202">非公開</label>';
echo '			</div>';
}else{
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0201" name="onoff" class="custom-control-input" value="0">';
echo '				<label class="custom-control-label" for="customRadioCategory0201">公開中</label>';
echo '			</div>';
echo '			<div class="custom-control custom-radio custom-control-inline">';
echo '				<input type="radio" id="customRadioCategory0202" name="onoff" class="custom-control-input" value="1" checked>';
echo '				<label class="custom-control-label" for="customRadioCategory0202">非公開</label>';
echo '			</div>';
}
echo '		</div>';
echo '	</div>';
}
?>



	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>