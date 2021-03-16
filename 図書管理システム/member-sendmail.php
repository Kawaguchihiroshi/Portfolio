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
<h1 class="display-4">訓練生管理</h1>
</div>

<div class="p-5 mt-3 bg-white">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM member WHERE id=?');
$sql->execute([$_REQUEST['id']]);
	
foreach ($sql->fetchAll() as $row) {
$title = "図書管理システムのログインID、パスワードのお知らせ";
$content = "※このメールは国立職業リハビリテーションセンターの図書管理システムより送信されています。";
$content .= "\r\n";
$content .= "\r\n";
$content .= $row['name']." 様";
$content .= "\r\n";
$content .= "\r\n";
$content .= "以下、内容にて図書管理システム利用のためのログインID、パスワードをお知らせします。";
$content .= "\r\n";
$content .= "\r\n";
$content .= "【ログインID】".$row['login_name'];
$content .= "\r\n";
$content .= "【パスワード】".$row['password'];
$content .= "\r\n";
$content .= "\r\n";
$content .= "国立職業リハビリテーションセンター図書管理システム";
$content .= "\r\n";
$content .= "[https://pf02.newheadworks.com/index.php]";
$content .= "\r\n";
$content .= "※このメールに身に覚えがない場合は、以下までご一報お願いいたします。";
$content .= "\r\n";
$content .= "[国立職業リハビリテーションセンター図書管理システム：kawaguchihiroshi0212@gmail.com]";
$mail_header = "From: 国立職業リハビリテーションセンター図書管理システム<kawaguchihiroshi0212@gmail.com>";

if(mb_send_mail($to, $title, $content, $mail_header)){
	echo '<h2 class="mt-5">以下の内容にを登録メールアドレス宛に送信しました。</h2>';
	echo '<hr>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">氏名</div>';
	echo '	    	<div class="col-md-5">', $row['name'], '</div>';
 	echo '   	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">ログインID</div>';
	echo '	    	<div class="col-md-5">', $row['login_name'], '</div>';
	echo '    	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">パスワード</div>';
  	echo '  	<div class="col-md-5">', $row['password'], '</div>';
  	echo '  	<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="admin-login-output.php">管理トップに戻る</a></div>';
} else {
	echo '<h2 class="mt-5">以下、ご確認ください。</h2>';
	echo '<hr>';
	echo '<div class="mt-3 text-danger">・送信メールが正常に送信されませんでした。<br />システム制作者にご報告ください。</div>';
	echo '';
	echo '<div class="mt-3"><a class="btn btn-secondary" href="member-newinput.php">登録画面に戻る</a></div>';
}
}
?>
</div>
</main>

<?php require 'include/staff_footer.php' ;?>