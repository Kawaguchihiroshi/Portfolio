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
<h2><i class="fas fa-file-alt"></i> 貸出申請中一覧</h2>
<hr />
<div class="row  py-2">
<div class="col-md-2 text-center" style="font-weight:bold;">返却予定日</div>
<div class="col-md-7" style="font-weight:bold;">本のタイトル</div>
<div class="col-md-3 text-center" style="font-weight:bold;">返却予定日変更</div>
</div>
<hr />
<?php
$i = 0;
$pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
$sql=$pdo->prepare('SELECT * FROM rentdata WHERE member_id=? and return_check=0');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) {
  $date1 = new DateTime($row['plan_return_date']);
  $date2 = new DateTime(date("Y-m-d"));
  if ($date1 < $date2) {
    echo '<div class="row py-2 bg-danger">';
    $i++;
  } else {
    if ($i % 2 == 1) {
      echo '<div class="row py-2">';
      $i++;
    } else {
      echo '<div class="row py-2 bg-light">';
      $i++;
    }
  }
  echo '<div class="col-md-2 text-center">', $row['plan_return_date'], '</div>';
  $pdo=new PDO('mysql:host=localhost;dbname=bookmanage;charset=utf8', 'bookmanage', 'kokurihaoasystem');
  $sql=$pdo->prepare('SELECT * FROM book WHERE id=?');
  $sql->execute([$row['book_id']]);
  foreach ($sql->fetchAll() as $book) {
    echo '<div class="col-md-2"><img class="w-100" src="img/', $book['topimg'], '"></div>';
    echo '<div class="col-md-5">', $book['booktitle'], '<br /><a class="btn btn-sm btn-outline-success mt-1" href="', $book['publishers_url'], '" target="_blank"><i class="fas fa-external-link-alt"></i> 出版社の書籍ページ</a></div>';
  }
  echo '<div class="col-md-3 text-center"><a class="btn btn-sm btn-info" href="lending-input.php?id=', $row['id'], '">変更</a></div>';
  echo '</div>';
}
?>
</div>
</main>

<?php require 'include/footer.php'; ?>