<?php session_start(); ?>
<?php require 'include/header.php'; ?>
<title>
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case 'begin':
echo '初めての方';
break;

case 'flow':
echo 'ご注文の流れ';
break;

case 'payment':
echo 'お支払い方法';
break;

case 'returns':
echo '返品・交換';
break;

case 'shipping':
echo '送料・配達時間';
break;

case 'faq':
echo 'よくある質問';
break;

}
?>
｜NERVE FACTORY</title>
</head>
<body>
  <div class="container">

  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4"></div>
      <div class="col-4 text-center"><a class="blog-header-logo text-dark" href="index.php">NERVE FACTORY</a></div>
      <div class="col-4"><?php require 'include/sns_main.php'; ?></div>
    </div>
  </header>

<?php require 'include/main_nav.php'; ?>

<main class="container">
<div class="row">
<!-- // 左カラム開始 -->
<div class="col-md-10">
<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">

<h1 class="m-0">
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case 'begin':
echo '初めての方';
break;

case 'flow':
echo 'ご注文の流れ';
break;

case 'payment':
echo 'お支払い方法';
break;

case 'returns':
echo '返品・交換';
break;

case 'shipping':
echo '送料・配達時間';
break;

case 'faq':
echo 'よくある質問';
break;

}
?>
</h1>
</div>
      
<div class="mt-3 mb-4 p-3 bg-white rounded">
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case 'begin':
// 「初めての方」処理
echo '<h2 class="pt-3 pl-3">内容タイトル</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
break;

case 'flow':
// 「ご注文の流れ」処理
echo '<h2 class="pt-3 pl-3">①ご注文の流れ</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
echo '<h2 class="pt-3 pl-3">②ご注文の流れ</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
echo '<h2 class="pt-3 pl-3">③ご注文の流れ</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
echo '<h2 class="pt-3 pl-3">④ご注文の流れ</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
break;

case 'payment':
// 「お支払い方法」処理
echo '<h2 class="pt-3 pl-3">お支払い方法の種類</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
break;

case 'returns':
// 「返品・交換」処理
echo '<h2 class="pt-3 pl-3">返品</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
echo '<h2 class="pt-3 pl-3">交換</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
break;

case 'shipping':
// 「送料・配達時間」処理
echo '<h2 class="pt-3 pl-3">送料</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
echo '<h2 class="pt-3 pl-3 mt-3">配達時間</h2>';
echo '<hr />';
echo '<p class="pl-3">本文</p>';
break;

case 'faq':
// 「よくある質問」処理
echo '<h2 class="pt-3 pl-3">会員登録について</h2>';
echo '<hr />';
echo '<!-- ■accordionExample00 heading00 collapse00 -->';
echo '<div class="accordion mt-2" id="accordionExample00">';
echo '<div class="card">';
echo '<div class="card-header" id="heading00">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse00" aria-expanded="false" aria-controls="collapse00">';
echo '<i class="fas fa-users"></i> 決済できないですが・・・';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapse00" class="collapse" aria-labelledby="heading00" data-parent="#accordionExample00">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 現在、テスト使用期間のため決済はできなくしてあります。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

echo '<!-- ■accordionExample01 heading01 collapse01 -->';
echo '<div class="accordion mt-2" id="accordionExample01">';
echo '<div class="card">';
echo '<div class="card-header" id="heading01">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse01" aria-expanded="false" aria-controls="collapse01">';
echo '<i class="fas fa-users"></i> 海外からの申し込み、発送はしてもらえますか？';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapse01" class="collapse" aria-labelledby="heading01" data-parent="#accordionExample01">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 発送は日本国内のみになります。海外からのお申込み、発送は受け付けておりません。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

echo '<h2 class="pt-3 pl-3 mt-3">商品購入について</h2>';
echo '<hr />';
echo '<!-- ■accordionExample10 heading10 collapse10 -->';
echo '<div class="accordion mt-2" id="accordionExample10">';
echo '<div class="card">';
echo '<div class="card-header" id="heading10">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">';
echo '<i class="fas fa-users"></i> 決済できないですが・・・';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordionExample10">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 現在、テスト使用期間のため決済はできなくしてあります。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

echo '<!-- ■accordionExample11 heading11 collapse11 -->';
echo '<div class="accordion mt-2" id="accordionExample11">';
echo '<div class="card">';
echo '<div class="card-header" id="heading11">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">';
echo '<i class="fas fa-users"></i> 海外からの申し込み、発送はしてもらえますか？';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordionExample11">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 発送は日本国内のみになります。海外からのお申込み、発送は受け付けておりません。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

echo '<h2 class="pt-3 pl-3 mt-3">その他よくある質問</h2>';
echo '<hr />';
echo '<!-- ■headingOne -->';
echo '<div class="accordion mt-2" id="accordionExample00">';
echo '<div class="card">';
echo '<div class="card-header" id="headingOne">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">';
echo '<i class="fas fa-users"></i> 決済できないですが・・・';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample00">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 現在、テスト使用期間のため決済はできなくしてあります。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

echo '<!-- ■headingOne -->';
echo '<div class="accordion mt-2" id="accordionExample01">';
echo '<div class="card">';
echo '<div class="card-header" id="heading1">';
echo '<h5 class="mb-0">';
echo '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">';
echo '<i class="fas fa-users"></i> 海外からの申し込み、発送はしてもらえますか？';
echo '</button>';
echo '</h5>';
echo '</div>';
echo '<div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample01">';
echo '<div class="card-body">';
echo '<i class="fas fa-check-circle"></i> 発送は日本国内のみになります。海外からのお申込み、発送は受け付けておりません。';
echo '</div>';
echo '</div>';
echo '</div><!-- /card -->';
echo '</div><!-- /accordion -->';

break;
}
?>
</div><!-- /.news-area -->

</div><!-- /.col-md-10 -->
<!-- // 左カラム終了 -->
<!-- // 右カラム開始 -->
<?php require 'include/sideber.php'; ?>
<!-- // 右カラム終了 -->
</div><!-- /.row -->
</main><!-- /.container -->

<?php require 'include/footer.php'; ?>