<?php
session_start();
if (isset($_SESSION['customer'])) {
  unset($_SESSION['customer']);
}
if (isset($_SESSION['staff'])) {
  header('Location: admin-login-output.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require 'include/staff_header.php';?>
</head>
<body>
<div id="wrap"></div>
<?php require 'include/no_menu.php';?>
<main role="main" class="container py-5">
<div class="p-5 bg-white text-center rounded">
  <h2>図書管理システム</h2>
  <hr>
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <form class="form-signin my-5" action="admin-login-output.php" method="post">
        <label for="inputID" class="sr-only">指導員ID</label>
        <input type="text" id="inputID" class="form-control" placeholder="指導員ID" name="login_name" required autofocus>
        <label for="inputPassword" class="sr-only">パスワード</label>
        <input type="password" id="inputPassword" class="form-control mt-2" placeholder="パスワード" name="password" required>
        <button class="mt-3 btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
</main>
<?php require 'include/staff_footer.php' ;?>