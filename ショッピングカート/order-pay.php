<?php
session_start();
if (!isset($_SESSION['customer'])) {
//　会員ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: login-input.php" ) ;
exit ;
}
?>
<?php require 'include/header.php'; ?>
    <title>NERVE FACTORY</title>

  </head>
  <body>
  <div class="container">

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark" href="index.php">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-10">
<?php
if ($_REQUEST['order'] != 0) {
// エラー　------------------------------------------------------------------------------------------
echo '<div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">';
echo '<h1 class="m-0">ご確認ください</h1>';
echo '</div>';

echo '<div class="list-area mb-5 p-4 bg-white rounded">';

echo '<h2 class="pl-3">注文を以下リンクから再度行ってください。</h2>';
echo '<hr>';
echo '<div class="pl-3"><a href="customer-cart-list.php" class="btn btn-sm btn-outline-success">買い物カゴ</a></div>';


}else {
echo '<div class="p-4 p-md-5 mb-3 text-white bg-dark rounded">';
echo '<h1 class="m-0">お客様情報確認</h1>';
echo '</div>';

echo '<div class="list-area mb-5 p-4 bg-white rounded">';

// 配送先情報　------------------------------------------------------------------------------------------
echo '<h2 class="pl-3">配送先情報</h2>';
echo '<hr>';
echo '<div class="pl-3">';
echo '<div><strong>お名前</strong>：', $_SESSION['customer']['delivery_name'], ' 様</div>';
echo '<div class="pt-2"><strong>お届け先</strong></div>';
echo '<div>〒', $_SESSION['customer']['delivery_post_no'], '</div>';
echo '<div>', $_SESSION['customer']['delivery_adrs'], '</div>';
echo '<div class="pt-2"><strong>ご連絡先</strong>：', $_SESSION['customer']['delivery_tell'], '</div>';

echo '<form class="mt-3" action="customer-input.php" method="post">';
echo '<input type="hidden" name="level" value="pay">';
echo '<button class="btn btn-sm btn-outline-primary" type="submit">配送先の変更</button>';
echo '</form>';
echo '</div>';

// お支払情報　------------------------------------------------------------------------------------------
echo '<h2 class="mt-5 pl-3">お支払方法</h2>';
echo '<hr>';
echo '<form action="order-check.php" method="post">';
echo '<div class="pl-3">';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="pay" id="RadioPay0" value="0" checked>';
echo '<label class="form-check-label" for="RadioPay0">銀行振込</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="pay" id="RadioPay1" value="1">';
echo '<label class="form-check-label" for="RadioPay1">クレジット決済</label>';
echo '</div>';
echo '<div class="form-check form-check-inline">';
echo '<input class="form-check-input" type="radio" name="pay" id="RadioPay2" value="2">';
echo '<label class="form-check-label" for="RadioPay2">コンビニ支払い</label>';
echo '</div>';
echo '<input type="hidden" name="order" value="1">';
echo '<button class="btn btn-lg btn-primary" type="submit">ご注文内容を確認</button>';
echo '</div>';
echo '</form>';
}
?>
    </div><!-- /.list-area -->
    </div><!-- /.main -->

<?php require 'include/sideber.php'; ?>

</div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>