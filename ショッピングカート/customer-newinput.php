<?php session_start(); ?>
<?php
function posted($str){
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}
$post = filter_input(INPUT_POST, "post_no", FILTER_VALIDATE_INT);
$d_post = filter_input(INPUT_POST, "delivery_post_no", FILTER_VALIDATE_INT);
?>
<?php require 'include/header.php'; ?>
	<title>会員登録｜NERVE FACTORY</title>
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
<h1 class="m-0">会員登録</h1>
</div>
      
<div class="my-3 p-5 bg-white rounded">
<form action="customer-output.php" method="post">
<input type="hidden" name="level" value="0">
	<div class="row">
		<div class="col-md-3 text-right">
			<label for="inputEmail">メールアドレス</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputEmail" class="form-control" placeholder="メールアドレス" name="email" required autofocus>
		</div>
    	<div class="col-md-4"></div>
	</div>
	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputPassword">パスワード</label>
		</div>
    	<div class="col-md-5">
			<input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" required>
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputName">氏名</label>
		</div>
    	<div class="col-md-5">
			<input type="text" id="inputName" class="form-control" placeholder="山田 太郎" name="name" required>
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="address_num">郵便番号</label>
		</div>
    		<div class="col-md-3">
			<input type="text" id="address_num" class="form-control" placeholder="半角数字" name="postad" required>
		</div>
    		<div class="col-md-6"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="address_name">住所</label>
		</div>
    		<div class="col-md-9">
			<input type="text" id="address_name" class="form-control" placeholder="住所" name="address" required>
		</div>
	</div>

<script type="text/javascript"><!--
	var pastAddress;
	window.addEventListener("load", function(){
		document.getElementById("address_num").addEventListener("change", function(){
			var _address = this.value.replace(/[０-９]/g, function($s){
				return String.fromCharCode($s.charCodeAt(0) - 65248);
			}).replace(/\D/g, "");
			if(_address.match(/^\d{7}$/)){
				if(pastAddress != _address){
					var _zipcloudAPI = document.body.appendChild(document.createElement("script"));
					_zipcloudAPI.src = "./include/zipcode.php?zipcode=" + _address + "&callback=getAddNameByZipcloudAPI";
					_zipcloudAPI.onload = function(){
						document.body.removeChild(_zipcloudAPI);
					};
					pastAddress = _address;
				}
				document.getElementById("address_num").value = _address.slice(0, 3) + "-" + _address.slice(-4);
			}
		}, false);
	}, false);
	var getAddNameByZipcloudAPI = function( $getAdd ){
		var _addFormatted  = "";
		if($getAdd.status == 200){
			_addFormatted += $getAdd.results[0].address1; // 都道府県名
			_addFormatted += $getAdd.results[0].address2; // 市町村名
			_addFormatted += $getAdd.results[0].address3; // 町域名
		}
		document.getElementById("address_name").value = _addFormatted;
	};
//--></script>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="inputTell">電話番号</label>
		</div>
    	<div class="col-md-4">
			<input type="text" id="inputTell" class="form-control" placeholder="半角数字" name="tell" required>
		</div>
    	<div class="col-md-5"></div>
	</div>

	<div class="row pt-5">
		<div class="col-md-3 text-right">
			<label for="inputTell">配送先情報</label>
		</div>
		<div class="col-md-9">
		<div class="form-check">
			<input class="form-check-input" type="radio" name="adrs_info" id="exampleRadios1" value="0" checked>
			<label class="form-check-label" for="exampleRadios1">
			会員情報と同じ（以下、配送先の入力は不要です。）
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="adrs_info" id="exampleRadios2" value="1">
			<label class="form-check-label" for="exampleRadios2">
			以下に配送先情報を入力する
			</label>
		</div>
		</div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="DinputName">氏名【配送先】</label>
		</div>
    	<div class="col-md-5">
			<input type="text" form="input-data" id="DinputName" class="form-control" placeholder="山田 太郎" name="delivery_name">
		</div>
    	<div class="col-md-4"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="address_num01">郵便番号【配送先】</label>
		</div>
    		<div class="col-md-3">
			<input type="text" id="address_num01" class="form-control" placeholder="半角数字" name="delivery_postad">
		</div>
    		<div class="col-md-6"></div>
	</div>

	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="address_name01">住所【配送先】</label>
		</div>
    		<div class="col-md-9">
			<input type="text" id="address_name01" class="form-control" placeholder="住所" name="delivery_address">
		</div>
	</div>

<script type="text/javascript"><!--
	var pastAddress;
	window.addEventListener("load", function(){
		document.getElementById("address_num01").addEventListener("change", function(){
			var _address = this.value.replace(/[０-９]/g, function($s){
				return String.fromCharCode($s.charCodeAt(0) - 65248);
			}).replace(/\D/g, "");
			if(_address.match(/^\d{7}$/)){
				if(pastAddress != _address){
					var _zipcloudAPI = document.body.appendChild(document.createElement("script"));
					_zipcloudAPI.src = "./include/zipcode.php?zipcode=" + _address + "&callback=getAddNameByZipcloudAPI01";
					_zipcloudAPI.onload = function(){
						document.body.removeChild(_zipcloudAPI);
					};
					pastAddress = _address;
				}
				document.getElementById("address_num01").value = _address.slice(0, 3) + "-" + _address.slice(-4);
			}
		}, false);
	}, false);
	var getAddNameByZipcloudAPI01 = function( $getAdd ){
		var _addFormatted  = "";
		if($getAdd.status == 200){
			_addFormatted += $getAdd.results[0].address1; // 都道府県名
			_addFormatted += $getAdd.results[0].address2; // 市町村名
			_addFormatted += $getAdd.results[0].address3; // 町域名
		}
		document.getElementById("address_name01").value = _addFormatted;
	};
//--></script>


	<div class="row pt-4">
		<div class="col-md-3 text-right">
			<label for="DinputTell">電話番号【配送先】</label>
		</div>
    		<div class="col-md-4">
			<input type="text" form="input-data" id="DinputTell" class="form-control" placeholder="半角数字" name="delivery_tell">
		</div>
    		<div class="col-md-5"></div>
	</div>


	<div class="row pt-5">
		<div class="col-md-2"></div>
		<div class="col-md-3"><button id="input-data" class="btn btn-info btn-block" type="submit">登録</button></div>
		<div class="col-md-2"></div>
		<div class="col-md-3"><button class="btn btn-light btn-block" type="reset">クリア</button></div>
		<div class="col-md-2"></div>
	</div>
</form>

      </div><!-- /.input-area -->

    </div><!-- /.col-md-10 -->
    <?php require 'include/sideber.php'; ?>

  </div><!-- /.row -->

</main><!-- /.container -->

<?php require 'include/footer.php'; ?>
