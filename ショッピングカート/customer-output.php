<?php session_start(); ?>
<?php require 'include/header.php'; ?>
<title>
<?php
$pref = $_REQUEST['level'];
switch ($pref){

case '0':	// 新規会員登録処理
    echo '会員登録';
    break;

case '1':	// 会員情報変更処理
	if (!isset($_SESSION['customer'])) {
        //　会員ログインを行っていない場合
        http_response_code( 302 ) ;
        header( "Location: login-input.php" ) ;
        exit ;
    }
    echo '会員情報変更';
    break;

case '2':	// 退会処理
	if (!isset($_SESSION['customer'])) {
        //　会員ログインを行っていない場合
        http_response_code( 302 ) ;
        header( "Location: login-input.php" ) ;
        exit ;
    }
    echo '退会';
    break;

case '3':	// パスワードを忘れた方にリセットURLを送信処理
    echo 'パスワードリセットURLを送信';
    break;

case '33':	// パスワードリセット処理
    echo 'パスワードリセット';
    break;

case '4':	// お問い合わせ送信処理
    echo 'お問い合わせ';
    break;

case '5':	// お気に入りに追加処理
	if (!isset($_SESSION['customer'])) {
        //　会員ログインを行っていない場合
        http_response_code( 302 ) ;
        header( "Location: login-input.php" ) ;
        exit ;
    }
    echo 'お気に入りに追加';
    break;

case '55':	// お気に入りを削除処理
	if (!isset($_SESSION['customer'])) {
        //　会員ログインを行っていない場合
        http_response_code( 302 ) ;
        header( "Location: login-input.php" ) ;
        exit ;
    }
    echo 'お気に入りを削除';
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
      <div class="col-4 text-center"><a class="blog-header-logo text-dark">NERVE FACTORY</a></div>
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
$pref = $_REQUEST['level'];
switch ($pref){

case '0':	// 新規会員登録処理
    echo '会員登録';
    break;

case '1':	// 会員情報変更処理
    echo '会員情報変更';
    break;

case '2':	// 退会処理
    echo '退会';
    break;

case '3':	// パスワードを忘れた方にリセットURLを送信処理
    echo 'パスワードリセットURLを送信';
    break;

case '33':	// パスワードリセット処理
    echo 'パスワードリセット';
    break;

case '4':	// お問い合わせ送信処理
    echo 'お問い合わせ';
    break;

case '5':	// お気に入りに追加処理
    echo 'お気に入りに追加';
    break;

case '55':	// お気に入りを削除処理
    echo 'お気に入りを削除';
    break;
}
?>
</h1>
</div>
      
<div class="mt-3 mb-4 p-3 bg-white rounded">

<?php
$pref = $_REQUEST['level'];
switch ($pref){

case '0':	// 新規会員登録処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('select * from customer where email=? AND status=1');
$sql->execute([$_REQUEST['email']]); 
if (empty($sql->fetchAll())) {

// 会員IDをふる　------------------------------------------------------------------------------------------
$min = 1000;
$max = 9999;
$no = 1;
$customer_no = '';

while($no != 0){ 
$no = 0;
$oder_no01 = mt_rand($min, $max);
$oder_no02 = mt_rand($min, $max);
$oder_no03 = mt_rand($min, $max);
$customer_no = 'cid-'.$oder_no01.'-'.$oder_no02.'-'.$oder_no03;

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE customer_no=?');
$sql->execute([$customer_no]);
foreach ($sql->fetchAll() as $row) { $no++; }
} // 重複がなくなるまでループ

$sql=$pdo->prepare('insert into customer values(null,?,?,?,?,?,?,?,?,?,?,?,0,0)');
	if ($_REQUEST['adrs_info'] == 0) {
		$sql->execute([
			$customer_no,
			$_REQUEST['name'], 
			$_REQUEST['email'], 
			$_REQUEST['password'], 
			$_REQUEST['postad'], 
			$_REQUEST['address'], 
			$_REQUEST['tell'], 
			$_REQUEST['name'], 
			$_REQUEST['postad'], 
			$_REQUEST['address'], 
			$_REQUEST['tell'] 
		]);

		echo '<div class="p-3 bg-white">';
		echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">以下の情報を仮登録しました。</h2>';
		echo '<div class="mt-2">登録メールアドレス宛に確認メールをお送りいたしましたのでメールに記載されている本登録URLより本登録をお願いいたします。</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">メールアドレス</div>';
		echo '		<div class="col-md-5">', $_REQUEST['email'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">パスワード</div>';
		echo '		<div class="col-md-5">', $_REQUEST['password'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">氏名</div>';
		echo '		<div class="col-md-5">', $_REQUEST['name'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">郵便番号</div>';
		echo '		<div class="col-md-3">', $_REQUEST['postad'], '</div>';
		echo '		<div class="col-md-6"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">住所</div>';
		echo '		<div class="col-md-9">', $_REQUEST['address'], '</div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">電話番号</div>';
		echo '		<div class="col-md-4">', $_REQUEST['tell'], '</div>';
		echo '		<div class="col-md-5"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">氏名【配送先】</div>';
		echo '		<div class="col-md-5">', $_REQUEST['name'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">郵便番号【配送先】</div>';
		echo '		<div class="col-md-3">', $_REQUEST['postad'], '</div>';
		echo '		<div class="col-md-6"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">住所【配送先】</div>';
		echo '		<div class="col-md-9">', $_REQUEST['address'], '</div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">電話番号【配送先】</div>';
		echo '		<div class="col-md-4">', $_REQUEST['tell'], '</div>';
		echo '		<div class="col-md-5"></div>';
		echo '	</div>';
		echo '<div class="mt-4"><a href="customer-forget.php" class="btn btn-info ml-3">パスワードを忘れた方 <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
		echo '</div>';
	} else {
		$sql->execute([
			$customer_no,
			$_REQUEST['name'], 
			$_REQUEST['email'], 
			$_REQUEST['password'], 
			$_REQUEST['postad'], 
			$_REQUEST['address'], 
			$_REQUEST['tell'], 
			$_REQUEST['delivery_name'], 
			$_REQUEST['delivery_post_no'], 
			$_REQUEST['delivery_adrs'], 
			$_REQUEST['delivery_tell'] 
		]);

		echo '<div class="p-3 bg-white">';
		echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">以下の情報を仮登録しました。</h2>';
		echo '<div class="mt-2">登録メールアドレス宛に確認メールをお送りいたしましたのでメールに記載されている本登録URLより本登録をお願いいたします。</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">メールアドレス</div>';
		echo '		<div class="col-md-5">', $_REQUEST['email'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">パスワード</div>';
		echo '		<div class="col-md-5">', $_REQUEST['password'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">氏名</div>';
		echo '		<div class="col-md-5">', $_REQUEST['name'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">郵便番号</div>';
		echo '		<div class="col-md-3">', $_REQUEST['postad'], '</div>';
		echo '		<div class="col-md-6"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">住所</div>';
		echo '		<div class="col-md-9">', $_REQUEST['address'], '</div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">電話番号</div>';
		echo '		<div class="col-md-4">', $_REQUEST['tell'], '</div>';
		echo '		<div class="col-md-5"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">氏名【配送先】</div>';
		echo '		<div class="col-md-5">', $_REQUEST['delivery_name'], '</div>';
		echo '		<div class="col-md-4"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">郵便番号【配送先】</div>';
		echo '		<div class="col-md-3">', $_REQUEST['delivery_post_no'], '</div>';
		echo '		<div class="col-md-6"></div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">住所【配送先】</div>';
		echo '		<div class="col-md-9">', $_REQUEST['delivery_adrs'], '</div>';
		echo '	</div>';
		echo '	<div class="row pt-4">';
		echo '		<div class="col-md-3 text-right">電話番号【配送先】</div>';
		echo '		<div class="col-md-4">', $_REQUEST['delivery_tell'], '</div>';
		echo '		<div class="col-md-5"></div>';
		echo '	</div>';
		echo '<div class="mt-4"><a href="customer-forget.php" class="btn btn-info ml-3">パスワードを忘れた方 <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
		echo '</div>';
	}
	require 'include/sendmail.php';

} else {
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">メールアドレスが既に使用されています。</h2>';
	echo '<div class="mt-2">メールアドレスを変更し、再度ご登録お願いいたします。<br />また、パスワードを忘れた方に関しては以下、リンクよりパスワードのご確認をよろしくお願いいたします。</div>';
	echo '<div class="mt-4"><a href="customer-forget.php" class="btn btn-info ml-3">パスワードを忘れた方 <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
}
    break;


case '1':	// 会員情報変更処理
if ($_REQUEST['password'] == $_REQUEST['password01']) {
    $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
    $sql=$pdo->prepare('update customer set name=?, tell=?, post_no=?, adrs=?, email=?, password=?, delivery_name=?, delivery_tell=?, delivery_post_no=?, delivery_adrs=? where id=?');
    $sql->execute([
      $_REQUEST['name'], 
      $_REQUEST['tell'], 
      $_REQUEST['post_no'], 
      $_REQUEST['adrs'], 
      $_REQUEST['email'], 
      $_REQUEST['password'], 
      $_REQUEST['delivery_name'], 
      $_REQUEST['delivery_tell'], 
      $_REQUEST['delivery_post_no'], 
      $_REQUEST['delivery_adrs'], 
      $_REQUEST['id']
    ]);
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">以下、内容に会員情報を変更しました。</h2>';
    echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">基本情報</h3>';
    echo '<div class="row mt-4">';
    echo '<div class="row col-md-3">';
    echo '<div class="col-md-5 bg-secondary text-white py-2">会員氏名</div>';
    echo '<div class="col-md-7 py-2">', $_REQUEST['name'], '</div>';
    echo '</div>';
    echo '<div class="row col-md-4">';
    echo '<div class="col-md-1"></div>';
    echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
    echo '<div class="col-md-7 py-2">', $_REQUEST['tell'], '</div>';
    echo '</div>';
    echo '<div class="col-md-5"></div>';
    echo '</div>';
    echo '<div class="row mt-4">';
    echo '<div class="row col-md-3">';
    echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
    echo '<div class="col-md-6 py-2">', $_REQUEST['post_no'], '</div>';
    echo '<div class="col-md-1"></div>';
    echo '</div>';
    echo '<div class="row col-md-9">';
    echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
    echo '<div class="col-md-11 py-2">', $_REQUEST['adrs'], '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="row mt-4">';
    echo '<div class="col-md-2 bg-secondary text-white py-2">メールアドレス</div>';
    echo '<div class="col-md-5 py-2">', $_REQUEST['email'], '</div>';
    echo '<div class="col-md-5"></div>';
    echo '</div>';
    echo '<div class="row mt-4">';
    echo '<div class="col-md-3 bg-secondary text-white py-2">パスワード</div>';
    echo '<div class="col-md-4 py-2">', $_REQUEST['password'], '</div>';
    echo '<div class="col-md-5"></div>';
    echo '</div>';
    echo '<h3 class="row mt-5" style="border-bottom: solid 1px #444;">配送先情報</h3>';
    echo '<div class="row mt-4">';
    echo '<div class="row col-md-5">';
    echo '<div class="col-md-4 bg-secondary text-white py-2">配送先名前</div>';
    echo '<div class="col-md-8 py-2">', $_REQUEST['delivery_name'], '</div>';
    echo '</div>';
    echo '<div class="row col-md-4">';
    echo '<div class="col-md-1"></div>';
    echo '<div class="col-md-4 bg-secondary text-white py-2">電話番号</div>';
    echo '<div class="col-md-7 py-2">', $_REQUEST['delivery_tell'], '</div>';
    echo '</div>';
    echo '<div class="col-md-3"></div>';
    echo '</div>';
    echo '<div class="row mt-4">';
    echo '<div class="row col-md-3">';
    echo '<div class="col-md-5 bg-secondary text-white py-2">郵便番号</div>';
    echo '<div class="col-md-6 py-2">', $_REQUEST['delivery_post_no'], '</div>';
    echo '<div class="col-md-1"></div>';
    echo '</div>';
    echo '<div class="row col-md-9">';
    echo '<div class="col-md-1 bg-secondary text-white py-2">住所</div>';
    echo '<div class="col-md-11 py-2">', $_REQUEST['delivery_adrs'], '</div>';
    echo '</div>';
    echo '</div>';
	echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
	require 'include/sendmail.php';
} else {
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">ご確認ください。</h2>';
	echo '<div class="mt-2">※パスワード確認でご入力されたパスワードが登録内容と異なります。<br />再度ご確認の上、パスワードをご入力ください。</div>';
	echo '<div class="mt-4"><a href="customer-input.php" class="btn btn-info">会員情報変更ページに戻る <i class="far fa-arrow-alt-circle-right"></i></a><a href="customer-forget.php" class="btn btn-info ml-3">パスワードを忘れた方 <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
}
    break;


case '2':	// 退会処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('update customer set del=? where id=?');
$sql->execute([
	$_REQUEST['del'], 
	$_REQUEST['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">退会しました。</h2>';
echo '<div class="mt-2">ご利用いただきましてありがとうございました。<br />またのご利用を心よりお待ちしております。</div>';
echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
echo '</div>';
break;


case '3':	// パスワードを忘れた方にリセットURLを送信処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE email=? AND post_no=? AND status=1 AND del=0');
$sql->execute([
$_REQUEST['email'],
$_REQUEST['post_no']
]);
if ($sql->fetchAll()) {
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">パスワードリセットURLを送信しました。</h2>';
	echo '<div class="mt-2">送信されたメールをご確認の上、パスワードのリセットをお願いいたします。<br />※メールに記載されたURLは１時間後利用できなくなります。</div>';
	echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM customer WHERE email=? AND status=1 AND del=0');
	$sql->execute([$_REQUEST['email']]);
	foreach ($sql->fetchAll() as $row) {
		require 'include/sendmail.php';
	}
} else {
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">パスワードリセットURLを送信しました。</h2>';
	echo '<div class="mt-2">送信されたメールをご確認の上、パスワードのリセットをお願いいたします。<br />※メールアドレスまたは郵便番号に間違いがあるときは届きません。</div>';
	echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
}
break;

case '33':	// パスワード変更処理
if ($_REQUEST['password'] == $_REQUEST['password01']) {
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('UPDATE customer SET password=? WHERE customer_no=? AND id=?');
	$sql->execute([
		$_REQUEST['password'],
		$_REQUEST['customer_no'],
		$_REQUEST['id']
	]);
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">パスワードがリセットされました。</h2>';
	echo '<div class="mt-2">パスワードのリセットが完了しました。<br />ログインにてご確認お願いいたします。</div>';
	echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
} else {
	echo '<div class="p-3 bg-white">';
	echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">ご確認ください。</h2>';
	echo '<div class="mt-2">※パスワード確認でご入力されたパスワードが登録内容と異なります。<br />再度ご確認の上、パスワードをご入力ください。</div>';
	echo '<div class="mt-4"><a href="#" onclick="window.history.back(); return false;">パスワード変更ページに戻る <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
	echo '</div>';
}
break;


case '4':	// お問い合わせ送信処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');

date_default_timezone_set('Japan');
$contactdate=date('Y-m-d H:i:s');

$sql=$pdo->prepare('SELECT * FROM customer WHERE email=? AND status=1');
$sql->execute([$_REQUEST['email']]);
foreach ($sql->fetchAll() as $row) { $cust_id = $row['id']; }

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
if (isset($_SESSION['customer'])) {
	$sql=$pdo->prepare('insert into contact values(null,1,?,?,?,?,?,?,0,0)');
	$sql->execute([
		$_REQUEST['name'], 
		$_REQUEST['email'], 
		$_REQUEST['title'], 
		$_REQUEST['content'], 
		$_SESSION['customer']['id'],
		$contactdate
	]);
} else if (isset($cust_id)) {
	$sql=$pdo->prepare('insert into contact values(null,1,?,?,?,?,?,?,0,0)');
	$sql->execute([
		$_REQUEST['name'], 
		$_REQUEST['email'], 
		$_REQUEST['title'], 
		$_REQUEST['content'], 
		$cust_id,
		$contactdate
	]);
} else {
	$sql=$pdo->prepare('insert into contact values(null,1,?,?,?,?,1,?,0,0)');
	$sql->execute([
		$_REQUEST['name'], 
		$_REQUEST['email'], 
		$_REQUEST['title'], 
		$_REQUEST['content'], 
		$contactdate
	]);
}
echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">お問い合わせが完了いたしました。</h2>';
echo '<div class="mt-2">以下、内容でお問い合わせを行いました。<br />スタッフ確認後、3営業日以内にご返信いたします。</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-3">氏名</div>';
echo '<div class="col-md-5">', $_REQUEST['name'], '</div>';
echo '<div class="col-md-4"></div>';
echo '</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-3">メールアドレス</div>';
echo '<div class="col-md-5">', $_REQUEST['email'], '</div>';
echo '<div class="col-md-4"></div>';
echo '</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-3">お問い合わせタイトル</div>';
echo '<div class="col-md-5">', $_REQUEST['title'], '</div>';
echo '<div class="col-md-4"></div>';
echo '</div>';
echo '<div class="row pt-4">';
echo '<div class="col-md-3">お問い合わせ内容</div>';
echo '<div class="col-md-5">', $_REQUEST['content'], '</div>';
echo '<div class="col-md-4"></div>';
echo '</div>';
echo '<div class="mt-4"><a href="index.php" class="btn btn-info">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
echo '</div>';
require 'include/sendmail.php';
break;

case '5':	// お気に入りに追加処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('INSERT INTO favorite VALUES(?,?)');
$sql->execute([
	$_REQUEST['prod_id'],
	$_SESSION['customer']['id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">お気に入りに追加しました。</h2>';
echo '<div class="mt-4"><a href="customer-favorite-list.php?pg=1" class="btn btn-info">お気に入り一覧に戻る <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
echo '</div>';
break;

case '55':	// お気に入りを削除処理
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('DELETE FROM favorite WHERE cost_id=? AND prod_id=?');
$sql->execute([
	$_SESSION['customer']['id'], 
	$_REQUEST['prod_id']
]);
echo '<div class="p-3 bg-white">';
echo '<h2 class="mb-4" style="border-bottom: solid 1px #444;">お気に入りを削除しました。</h2>';
echo '<div class="mt-4"><a href="customer-favorite-list.php?pg=1" class="btn btn-info">お気に入り一覧に戻る <i class="far fa-arrow-alt-circle-right"></i></a><a href="index.php" class="btn btn-info ml-3">トップページに戻る <i class="far fa-arrow-alt-circle-right"></i></a></div>';
echo '</div>';
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