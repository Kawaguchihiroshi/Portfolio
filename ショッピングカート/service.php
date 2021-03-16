<?php session_start(); ?>
<?php require 'include/header.php'; ?>
<title>
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case '001':
echo '特定商取引法に基ずく表記';
break;

case '002':
echo '個人情報の取り扱いについて';
break;
}
?>
｜NERVE FACTORY</title>
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

<main class="container">
<div class="row">
<!-- // 左カラム開始 -->
<div class="col-md-10">
<div class="p-4 p-md-5 text-white rounded bg-dark mb-3">
<h1 class="m-0">
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case '001':
echo '特定商取引法に基ずく表記';
break;

case '002':
echo '個人情報の取り扱いについて';
break;
}
?>
</h1>
</div>
      
<div class="mt-3 mb-4 p-3 bg-white rounded">
<?php
$pref = $_REQUEST['page'];
switch ($pref){
case '001':
// 「特定商取引法に基ずく表記」処理
echo '<h2 class="pt-3 pl-3">特定商取引法に基ずく表記</h2>';
echo '<hr />';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">販売業者名</div>';
echo '<div class="col-md-9 p-3 bg-light">NEWHEADWORKS</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">代表責任者名</div>';
echo '<div class="col-md-9 p-3 bg-light">川口博司</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">所在地</div>';
echo '<div class="col-md-9 p-3 bg-light">〒165-0035　東京都中野区</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">電話番号</div>';
echo '<div class="col-md-9 p-3 bg-light"></div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">電話受付時間</div>';
echo '<div class="col-md-9 p-3 bg-light">平日：9:00～17:00 / 休日：9:00～17:00</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">メールアドレス</div>';
echo '<div class="col-md-9 p-3 bg-light">support@newheadworks.com</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">ホームページURL</div>';
echo '<div class="col-md-9 p-3 bg-light">htps://pf01.newheadworks.com/</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">販売価格</div>';
echo '<div class="col-md-9 p-3 bg-light">各商品ページをご参照ください。</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">商品代金以外の<br />必要料金</div>';
echo '<div class="col-md-9 p-3 bg-light">消費税<br />送料（全国一律800円 / 商品5,000円以上の購入で送料無料）<br />振込の場合、振込手数料、コンビニ決済の場合、コンビニ決済手数料</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">お届け時期</div>';
echo '<div class="col-md-9 p-3 bg-light">入金確認後、直ちに商品を発送いたします。</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">お支払方法</div>';
echo '<div class="col-md-9 p-3 bg-light">銀行振込、クレジットカード、コンビニ決済</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">お申込みの有効期限</div>';
echo '<div class="col-md-9 p-3 bg-light">7日以内にお願いいたします。<br />7日間入金がない場合は、キャンセルとさせていただきます。</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">返品・交換・<br />キャンセル等</div>';
echo '<div class="col-md-9 p-3 bg-light">商品発送後の返品・返却等はお受けいたしかねます。<br />商品が不良の場合のみ交換いたします。キャンセルは注文後24時間以内に限り受付いたします。<br />コンビニ決済を利用された場合、コンビニ店頭での返金はいたしません。</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">返品期限</div>';
echo '<div class="col-md-9 p-3 bg-light">商品出荷より7日以内にご連絡下さい。</div>';
echo '</div>';
echo '<div class="row px-5 mt-1">';
echo '<div class="col-md-3 p-3" style="background-color:#ccc;">返品送料</div>';
echo '<div class="col-md-9 p-3 bg-light">不良品の場合は弊社が負担いたします。<br />それ以外はお客様のご負担となります。</div>';
echo '</div>';
break;

case '002':
// 「個人情報の取り扱いについて」処理
echo '<h2 class="pt-3 pl-3">内容タイトル</h2>';
echo '<hr />';
echo '<p class="pl-3">NEWHEADWORKSでは、当サービスで収集したお客様の個人情報を、商品の発送、代金決済、関連するアフターサービス、新商品・サービスに関する情報のお知らせのためなど、以下に定める目的のために利用いたします。お客様にご提供頂いた個人情報をお客様の同意なく上記に明示する目的以外に利用することはありません。もし、上記目的の範囲を超えてご提供頂いた個人情報を利用する必要が生じた場合には、事前にお客様にその旨をご通知致します。新たな目的にご同意頂けない場合には、お客様ご自身の判断により、個人情報の利用を拒否することができます。また、個人情報の紛失、破壊、改ざん及び漏えいなどがないよう、収集した個人情報は、厳正な管理下で安全に保管します。なお、個人情報保護法第50条第１項に規定されている、報道または著述の用に供する目的における個人情報の取扱いについては、このポリシーの対象となるものではありません。';
echo '<p class="pl-3">ご不明な点などございましたら、お気軽にメールにてお問い合わせ下さい。</p>';
echo '<p class="pl-3">お問い合わせ先：support@newheadworks.com</p>';
echo '<div class="text-center">--------------------------------------------------------------------------</div>';
echo '<p class="pl-3"><strong>（個人情報の定義）</strong></p>';
echo '<p class="pl-3">個人情報とは、個人に関する情報であり、氏名、生年月日、性別、電話番号、電子メールアドレス、職業、勤務先等、特定の個人を識別し得る情報をいいます。</p>';
echo '<p class="pl-3"><strong>（個人情報の収集・利用の目的）</strong></p>';
echo '<p class="pl-3">当社は、以下の業務を行うため、その範囲内においてのみ、個人情報を収集・利用いたします。</p>';
echo '<p class="pl-3">当社による個人情報の収集・利用は、お客様の自発的な提供によるものであり、お客様が個人情報を提供された場合は、当社が本方針に則って個人情報を利用することをお客様が許諾したものとします。</p>';
echo '<ul class="ml-4">';
echo '<li>お申し込み頂いたサービスを提供するうえで必要な業務</li>';
echo '<li>ご注文された当社の商品をお届けするうえで必要な業務</li>';
echo '<li>当社のサービス提供又は商品のお届けのために必要となる代金決済業務</li>';
echo '<li>当社のサービス・商品の案内など、お客様に有益かつ必要と思われる情報の提供</li>';
echo '<li>業務遂行上で必要となる当社からの問い合わせ、確認、および当社商品またはサービスの向上のための意見収集・各種のお問い合わせ対応を含む関連するアフターサービスの提供</li>';
echo '<li>当社サービスの規約等に違反する行為へ対応</li>';
echo '<li>当社サービスに関する規約等の変更の通知等</li>';
echo '</ul>';
echo '<p class="pl-3"><strong>（個人情報の第三者提供）</strong></p>';
echo '<p class="pl-3">当社は、利用目的の達成のために必要な範囲内における業務委託その他法令に基づく場合等正当な理由によらない限り、事前に本人の同意を得ることなく、個人情報を第三者に開示・提供することはありません。</p>';
echo '<p class="pl-3"><strong>（委託先の監督）</strong></p>';
echo '<p class="pl-3">当社は、お客様へ商品やサービスを提供する等の業務遂行上、個人情報の一部を外部の委託先へ提供する場合があります。その場合、業務委託先が適切に個人情報を取り扱うように監督いたします。</p>';
echo '<p class="pl-3"><strong>（個人情報の管理）</strong></p>';
echo '<p class="pl-3">当社は、個人情報の漏洩、滅失、毀損等を防止するために、個人情報保護管理責任者を設置し、十分な安全保護に努め、また、個人情報を正確に、また最新なものに保つよう、お預かりした個人情報の適切な管理を行います。</p>';
echo '<p class="pl-3"><strong>（情報内容の照会、修正または削除）</strong></p>';
echo '<p class="pl-3">お客様が当社にご提供いただいた個人情報の照会、修正または削除等を希望される場合は、上記お問合せ先にご連絡ください。ご本人であることを確認させていただいたうえで、個人情報保護法その他の法令に従い、合理的な範囲ですみやかに対応させていただきます。</p>';
echo '<p class="pl-3"><strong>（プライバシー・ポリシーの変更）</strong></p>';
echo '<p class="pl-3">当社は、法令改正に対応するためその他の必要に応じて、本ポリシーを変更することがあります。但し、法令上お客様の同意が必要となる変更を行う場合、変更後の本ポリシーは、当社所定の方法で変更に同意したお客様に対してのみ適用されるものとします。なお、当社は、本ポリシーを変更する場合には、変更後の本ポリシーの施行時期及び内容を当社のウェブサイト上での表示その他の適切な方法により事前に周知し、またはお客様に通知します。</p>';
echo '<p class="pl-3"><strong>（セキュリティーについて）</strong></p>';
echo '<p class="pl-3">当社は、法令改正に対応するためその他の必要に応じて、本ポリシーを変更することがあります。但し、法令上お客様の同意が必要となる変更を行う場合、変更後の本ポリシーは、当社所定の方法で変更に同意したお客様に対してのみ適用されるものとします。なお、当社は、本ポリシーを変更する場合には、変更後の本ポリシーの施行時期及び内容を当社のウェブサイト上での表示その他の適切な方法により事前に周知し、またはお客様に通知します。</p>';
echo '<p class="pl-3">お客様による当社ウェブサイト上でのデータの入力・送信は、SSL暗号通信により、お客様のウェブブラウザーとサーバ間の通信がすべて暗号化されるので、ご記入された内容は安全に送信されます。</p>';
echo '<p class="pl-3 text-right">最終改定日：2021年 1月26日</p>';
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