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
<h1 class="display-4">訓練生登録</h1>
</div>

<div class="p-5 mt-3 bg-white">
<h2>訓練生情報を変更します。</h2>
<hr>
<form action="member-output.php" method="post">
<?php
$sql=$pdo->prepare('SELECT * FROM member WHERE id=?');
$sql->execute([$_GET['id']]);

foreach ($sql->fetchAll() as $row) {
echo '	<input type="hidden" name="id" value="', $_GET['id'], '">';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputName">氏名</label>';
echo '		</div>';
echo '    		<div class="col-md-3">';
echo '			<input type="text" id="inputName" class="form-control" placeholder="氏名" name="name" value="', $row['name'], '" required autofocus>';
echo '		</div>';
echo '   		<div class="col-md-6"></div>';
echo '	</div>';
echo '';
echo '<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputTell">電話番号</label>';
echo '		</div>';
echo '   		<div class="col-md-3">';
echo '			<input type="text" id="inputTell" class="form-control" placeholder="11桁のハイフンなしで入力" name="tell" value="', $row['tell'], '" required>';
echo '		</div>';
echo '   		<div class="col-md-6"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputEmail">メールアドレス</label>';
echo '		</div>';
echo '   		<div class="col-md-5">';
echo '			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $row['email'], '" required>';
echo '		</div>';
echo '    		<div class="col-md-4"></div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputLoginID">ログインID</label>';
echo '		</div>';
echo '    	<div class="col-md-9">';
echo 			 $row['login_name'], '　<span class="small text-secondary">※ログインIDは変更できません。</span>';
echo '		</div>';
echo '	</div>';
echo '';
echo '	<div class="row pt-4">';
echo '		<div class="col-md-3">';
echo '			<label for="inputPass">パスワード</label>';
echo '		</div>';
echo '   		<div class="col-md-3">';
echo '			<input type="text" id="inputPass" class="form-control" placeholder="パスワード" name="password" value="', $row['password'], '" required>';
echo '		</div>';
echo '    		<div class="col-md-6"></div>';
echo '	</div>';
echo '';
}
?>
	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-lg btn-light btn-block" type="reset">入力前に戻す</button></div>
		<div class="col-md-2"></div>
	</div>
</form>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>