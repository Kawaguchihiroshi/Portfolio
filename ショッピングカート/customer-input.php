<?php
session_start();
if (!isset($_SESSION['customer'])) {
//　会員ログインを行っていない場合
http_response_code( 302 ) ;
header( "Location: login-input.php" ) ;
exit ;
}
?>
<?php $pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart'); ?>
<?php require 'include/header.php'; ?>
	<title>会員情報変更｜NERVE FACTORY</title>
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
<h1 class="m-0">会員情報変更</h1>
</div>
      
<div class="mt-3 mb-4 px-3 py-5 bg-white rounded">

<?php
if (empty($_REQUEST['level'])){
	$pref = nomal;
} else {
	$pref = $_REQUEST['level'];
}

switch ($pref){
case 'pay':
	echo '<form action="customer-output.php" method="post">';
	echo '<input type="hidden" name="level" value="', $_REQUEST['level'], '">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) {
	echo '	<div class="row">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputDName">配送先：氏名</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="text" id="inputDName" class="form-control" placeholder="山田 太郎" name="name" value="', $row['delivery_name'], '" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputDPostNo">配送先：郵便番号</label>';
	echo '		</div>';
	echo '   	<div class="col-md-3">';
	echo '			<input type="text" id="inputDPostNo" class="form-control" placeholder="ハイフンあり" name="post_no" value="', $row['delivery_post_no'], '" required>';
	echo '		</div>';
	echo '   	<div class="col-md-6"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputDAddress">配送先：住所</label>';
	echo '		</div>';
	echo '    	<div class="col-md-9">';
	echo '			<input type="text" id="inputDAddress" class="form-control" placeholder="住所" name="adrs" value="', $row['delivery_adrs'], '" required>';
	echo '		</div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputDTell">配送先：電話番号</label>';
	echo '		</div>';
	echo '    	<div class="col-md-4">';
	echo '			<input type="text" id="inputDTell" class="form-control" placeholder="ハイフンあり" name="tell" value="', $row['delivery_tell'], '" required>';
	echo '		</div>';
 	echo '   	<div class="col-md-5"></div>';
	echo '	</div>';
}
	echo '';
	echo '	<div class="row mt-5 py-3 bg-light">';
	echo '		<div class="col-md-3">';
	echo '			<label for="inputPassword01">パスワード確認</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="password" id="inputPassword01" class="form-control" placeholder="パスワード確認" name="password01" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-2"></div>';
	echo '		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>';
	echo '		<div class="col-md-2"></div>';
	echo '		<div class="col-md-3"></div>';
	echo '		<div class="col-md-2"></div>';
	echo '	</div>';
	echo '</form>';
break;

case 'nomal':
	echo '<form action="customer-output.php" method="post">';
	echo '<input type="hidden" name="id" value="', $_SESSION['customer']['id'], '">';
	echo '<input type="hidden" name="level" value="1">';
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql=$pdo->prepare('SELECT * FROM customer WHERE id=?');
$sql->execute([$_SESSION['customer']['id']]);
foreach ($sql->fetchAll() as $row) {
	echo '	<div class="row">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputEmail">メールアドレス</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" value="', $row['email'], '" required autofocus>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputPassword">パスワード</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" value="', $row['password'], '" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputName">氏名</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="text" id="inputName" class="form-control" placeholder="山田 太郎" name="name" value="', $row['name'], '" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputPostNo">郵便番号</label>';
	echo '		</div>';
	echo '   	<div class="col-md-3">';
	echo '			<input type="text" id="inputPostNo" class="form-control" placeholder="ハイフンあり" name="post_no" value="', $row['post_no'], '" required>';
	echo '		</div>';
	echo '   	<div class="col-md-6"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputAddress">住所</label>';
	echo '		</div>';
	echo '    	<div class="col-md-9">';
	echo '			<input type="text" id="inputAddress" class="form-control" placeholder="住所" name="adrs" value="', $row['adrs'], '" required>';
	echo '		</div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputTell">電話番号</label>';
	echo '		</div>';
	echo '    	<div class="col-md-4">';
	echo '			<input type="text" id="inputTell" class="form-control" placeholder="ハイフンあり" name="tell" value="', $row['tell'], '" required>';
	echo '		</div>';
 	echo '   	<div class="col-md-5"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputDName">配送先：氏名</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="text" id="inputDName" class="form-control" placeholder="山田 太郎" name="delivery_name" value="', $row['delivery_name'], '" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputDPostNo">配送先：郵便番号</label>';
	echo '		</div>';
	echo '   	<div class="col-md-3">';
	echo '			<input type="text" id="inputDPostNo" class="form-control" placeholder="ハイフンあり" name="delivery_post_no" value="', $row['delivery_post_no'], '" required>';
	echo '		</div>';
	echo '   	<div class="col-md-6"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputDAddress">配送先：住所</label>';
	echo '		</div>';
	echo '    	<div class="col-md-9">';
	echo '			<input type="text" id="inputDAddress" class="form-control" placeholder="住所" name="delivery_adrs" value="', $row['delivery_adrs'], '" required>';
	echo '		</div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputDTell">配送先：電話番号</label>';
	echo '		</div>';
	echo '    	<div class="col-md-4">';
	echo '			<input type="text" id="inputDTell" class="form-control" placeholder="ハイフンあり" name="delivery_tell" value="', $row['delivery_tell'], '" required>';
	echo '		</div>';
 	echo '   	<div class="col-md-5"></div>';
	echo '	</div>';
	echo '';
	echo '	<div class="row mt-5 py-3 bg-light">';
	echo '		<div class="col-md-3 text-right">';
	echo '			<label for="inputPassword01">パスワード確認</label>';
	echo '		</div>';
	echo '    		<div class="col-md-5">';
	echo '			<input type="password" id="inputPassword01" class="form-control" placeholder="パスワード確認" name="password01" required>';
	echo '		</div>';
	echo '    		<div class="col-md-4"></div>';
	echo '	</div>';
}
	echo '';
	echo '	<div class="row pt-4">';
	echo '		<div class="col-md-2"></div>';
	echo '		<div class="col-md-3"><button class="btn btn-lg btn-info btn-block" type="submit">変更</button></div>';
	echo '		<div class="col-md-2"></div>';
	echo '		<div class="col-md-3"><form action="taikai-output.php" method="post"><input type="hidden" name="del" value="1"><input type="hidden" name="id" value="', $_SESSION['customer']['id'], '"><button class="btn btn-lg btn-danger btn-block" type="submit">退会</button></form></div>';
	echo '		<div class="col-md-2"></div>';
	echo '	</div>';
	echo '</form>';
break;
}
?>
</div><!-- /.input-area -->
</div><!-- /.col-md-10 -->
<?php require 'include/sideber.php'; ?>
</div><!-- /.row -->
</main><!-- /.container -->
<?php require 'include/footer.php'; ?>