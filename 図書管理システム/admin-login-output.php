<?php
session_start();
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
}
ini_set('display_errors',1);
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM staff WHERE login_name=? and password=?');
if (!isset($_REQUEST['login_name']) || !isset($_REQUEST['password'])) {
  if (isset($_SESSION['staff'])) {
    $sql->execute([$_SESSION['staff']['login_name'], $_SESSION['staff']['password']]);
  }
} else {
$sql->execute([$_REQUEST['login_name'], $_REQUEST['password']]);
  if (!empty($sql)) {
    foreach ($sql->fetchAll() as $row) {
      $_SESSION['staff']=[
        'id'=>$row['id'], 
        'login_name'=>$row['login_name'], 
        'password'=>$row['password'], 
        'name'=>$row['name'], 
        'email'=>$row['email'], 
        'unsub'=>$row['unsub']
      ];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/staff_header.php';?>
</head>
<body>
<?php
if (isset($_SESSION['staff'])) {
  echo '<div id="wrap"></div>';
  require 'include/staff_menu.php';
  echo '<main role="main" class="container py-5">';
  echo '<div class="p-5 bg-white rounded">';
  echo '<h2>', $_SESSION['staff']['name'], ' 様</h2>';
  echo '<hr>';
  echo '<div class="pt-4">上のメニューより<br />各処理を行ってください。</div>';
  echo '</div>';
  echo '</main>';
} else {
  echo '<div id="wrap"></div>';
  require 'include/no_menu.php';
  echo '<main role="main" class="container py-5">';
  echo '<div class="p-5 bg-white rounded">';
  echo '<h2 class="text-danger">ログインIDまたは、パスワードが間違っています。</h2>';
  echo '<hr>';
  echo '<div class="pt-4">ログイン情報をご確認の上、再度ログインをお願いいたします。</div>';
  echo '<div class="mt-5"><a class="btn btn-secondary" href="admin.php">ログインページに戻る</a></div>';
  echo '</div>';
  echo '</main>';
}
require 'include/staff_footer.php';
?>