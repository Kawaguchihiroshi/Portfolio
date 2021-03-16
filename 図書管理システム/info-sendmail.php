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

<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$to = $_POST['to'];
	$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
	$sql=$pdo->prepare('SELECT * FROM member WHERE id=?');
	$sql->execute([$_REQUEST['member_id']]);
	foreach ($sql->fetchAll() as $row) {
		$name = $row['name'];
		$tell = $row['tell'];
		$email = $row['email'];
	}
$title = "【図書管理システム】訓練生情報変更依頼";
$content = "依頼者メールアドレス：".$email;
$content .= "\r\n";
$content .= "\r\n";
$content .= "≪変更前≫";
$content .= "\r\n";
$content .= "氏名：".$name;
$content .= "\r\n";
$content .= "電話番号：".$tell;
$content .= "\r\n";
$content .= "\r\n";
$content .= "≪変更後≫";
$content .= "\r\n";
$content .= "氏名：".$_POST['name'];
$content .= "\r\n";
$content .= "電話番号：".$_POST['tell'];
$content .= "\r\n";
$content .= "\r\n";
$content .= "※このメールは国立職業リハビリテーションセンターの図書管理システムより送信されています。";
$content .= "\r\n";
$mail_header = "From: 国立職業リハビリテーションセンター図書管理システム<kawaguchihiroshi0212@gmail.com>";
if(mb_send_mail($to, $title, $content, $mail_header)){
echo '<h2>以下内容でメールを送信しました。</h2>';
echo '<hr>';
echo '';
echo '<div class="row pt-4">';
echo '<div class="col-md-2">≪変更前≫</div>';
echo '<div class="col-md-5">氏名</div>';
echo '<div class="col-md-5">', $name, '</div>';
echo '</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-2"></div>';
echo '<div class="col-md-5">電話番号</div>';
echo '<div class="col-md-5">', $tell, '</div>';
echo '</div>';
echo '';
echo '<div class="row pt-4">';
echo '<div class="col-md-2">≪変更後≫</div>';
echo '<div class="col-md-5">氏名</div>';
echo '<div class="col-md-5">', $_REQUEST['name'], '</div>';
echo '</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-2"></div>';
echo '<div class="col-md-5">電話番号</div>';
echo '<div class="col-md-5">', $_REQUEST['tell'], '</div>';
echo '</div>';
echo '';
echo '<div class="mt-3"><a class="btn btn-secondary" href="index.php">ホームに戻る</a></div>';
} else {
echo '<h2>メールの送信に失敗しました。</h2>';
echo '<hr>';
echo '<div class="mt-3">', $to, '◆', $title, '◆', $content, '</div>';
echo '<div class="mt-5"><a class="btn btn-secondary" href="info-form.php">情報変更依頼に戻る</a></div>';
echo '<div class="mt-3"><a class="btn btn-secondary" href="index.php">ホームに戻る</a></div>';
};
?>
</div>
</main>

<?php require 'include/footer.php'; ?>