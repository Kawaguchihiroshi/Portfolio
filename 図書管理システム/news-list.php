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
    <h1 class="display-4">お知らせ管理</h1>
  </div>
  <div class="p-5 mt-3 bg-white">
    <h2>現在登録されている記事は以下の通りです。</h2>
    <hr>
    <div class="row my-4">
      <div class="col-md-2 text-center" style="font-weight:bold;">状態</div>
      <div class="col-md-2" style="font-weight:bold;">投稿日</div>
      <div class="col-md-4" style="font-weight:bold;">タイトル</div>
      <div class="col-md-2 text-center" style="font-weight:bold;">投稿者</div>
      <div class="col-md-2 text-center" style="font-weight:bold;">変更・削除</div>
    </div>
    <?php
    $i = 0;
    $sql = "SELECT * FROM info WHERE unsub LIKE 0";
    foreach ($pdo->query($sql) as $row) {
      if ($i % 2 == 1) {
        echo '<div class="row py-2">';
      } else {
        echo '<div class="row py-2 bg-light">';
      }
      echo '<div class="col-md-2 text-center">';
      if ($row['onoff'] == 0) {
        echo '<span class="badge badge-primary">表示中</span>';
      } else {
        echo '<span class="badge badge-secondary">非表示</span>';
      }
      echo '</div>';
      echo '<div class="col-md-2">', $row['do_date'], '</div>';
      echo '<div class="col-md-4 text-truncate">', $row['title'], '</div>';
      echo '<div class="col-md-2 text-center">';
      $sql=$pdo->prepare('SELECT * FROM staff WHERE id=?');
      $sql->execute([$row['staff_id']]);
      foreach ($sql->fetchAll() as $sid) {
        echo $sid['name'];
      }
      echo '</div>';
      echo '<div class="col-md-1 text-center"><a class="btn btn-sm btn-info" href="news-input.php?id=', $row['id'], '">変更</a></div>';
      echo '<div class="col-md-1 text-center">';
      echo '<form action="news-delete.php" method="post">';
      echo '<input type="hidden" name="unsub" value="1">';
      echo '<input type="hidden" name="id" value="', $row['id'], '">';
      echo '<input type="hidden" name="do_date" value="', $row['do_date'], '">';
      echo '<input type="hidden" name="title" value="', $row['title'], '">';
      echo '<button class="btn btn-sm btn-secondary" type="sbmit">削除</button>';
      echo '</form>';
      echo '</div>';
      echo '</div>';
      $i++;
    }
    ?>
  </div>
</main>
<?php require 'include/staff_footer.php' ;?>