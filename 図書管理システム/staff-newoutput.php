<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
if (!isset($_SESSION['staff'])) {
	header('Location: admin.php');
}
if ($_SESSION['staff']['login_name'] != "administrator") {
	header('Location: admin-login-output.php');
}
if ($_SESSION['staff']['login_name'] != "a_test") {
	header('Location: admin-login-output.php');
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
<h1 class="display-4">指導員登録</h1>
</div>

<div class="p-5 mt-3 bg-white">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM staff WHERE login_name=?');
$sql->execute([$_REQUEST['login_name']]);

if (empty($sql->fetchAll())) {
	
$title = "【図書管理システム】指導員登録完了しました。";
$content = "※このメールは国立職業リハビリテーションセンターの図書管理システムより自動送信されています。";
$content .= "\r\n";
$content .= "\r\n";
$content .= $_REQUEST['name']." 様";
$content .= "\r\n";
$content .= "\r\n";
$content .= "以下、内容にて指導員登録を行いました。";
$content .= "\r\n";
$content .= "\r\n";
$content .= "【氏名】".$_REQUEST['name'];
$content .= "\r\n";
$content .= "【メールアドレス】".$_REQUEST['email'];
$content .= "\r\n";
$content .= "【ログインID】".$_REQUEST['login_name'];
$content .= "\r\n";
$content .= "【パスワード】".$_REQUEST['password'];
$content .= "\r\n";
$content .= "\r\n";
$content .= "※指導員のログインページは以下になります。";
$content .= "\r\n";
$content .= "[https://pf02.newheadworks.com/admin.php]";
$content .= "\r\n";
$content .= "※このメールに身に覚えがない場合は、以下までご一報お願いいたします。";
$content .= "\r\n";
$content .= "[国立職業リハビリテーションセンター図書管理システム：kawaguchihiroshi0212@gmail.com]";
$mail_header = "From: 国立職業リハビリテーションセンター図書管理システム<kawaguchihiroshi0212@gmail.com>";

if(mb_send_mail($to, $title, $content, $mail_header)){
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('insert into staff values(null,?,?,?,?,?)');
	$sql->execute([
		$_REQUEST['name'], 
		$_REQUEST['email'], 
		$_REQUEST['login_name'], 
		$_REQUEST['password'], 
		$_REQUEST['unsub']
	]);
	echo '<h2 class="mt-5">以下の内容で指導員登録を行いました。</h2>';
	echo '<hr>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">氏名</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['name'], '</div>';
 	echo '   	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">メールアドレス</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['email'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">指導員ログインID</div>';
	echo '	    	<div class="col-md-5">', $_REQUEST['login_name'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">ログインパスワード</div>';
  	echo '  	<div class="col-md-5">', $_REQUEST['password'], '</div>';
  	echo '  	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';
} else {
	echo '<h2 class="mt-5">以下、ご確認ください。</h2>';
	echo '<hr>';
	echo '<div class="mt-3 text-danger">・自動送信メールが正常に送信されませんでした。<br />システム制作者にご報告ください。</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="staff-newinput.php">登録画面に戻る</a></div>';
}

} else {
	echo '<h2 class="mt-5">以下、ご確認ください。</h2>';
	echo '<hr>';
	echo '<div class="mt-3 text-danger">・ログイン名がすでに使用されている為、変更してください。</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="staff-newinput.php">登録画面に戻る</a></div>';
}
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>