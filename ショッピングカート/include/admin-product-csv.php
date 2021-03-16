<?php
if (!file_exists('csv')) {
	mkdir('csv');
}

if (is_uploaded_file($_FILES['csv_data']['tmp_name'])) {

	$file_main='csv/'.basename($_FILES['csv_data']['name']);

	if (move_uploaded_file($_FILES['csv_data']['tmp_name'], $file_main)) {

		//ファイルを変数に入れる
		$csv_file = file_get_contents($file_main);

		//変数を改行毎の配列に変換
		$aryHoge = explode("\n", $csv_file);

		$aryCsv = [];
		foreach($aryHoge as $key => $value){
			if($key == 0) continue; //　1行目が見出しで取得したくない
			if(!$value) continue; //　空白行が含まれていたら除外
			$aryCsv[] = explode(",", $value);
		}

		foreach($aryCsv as $value){
			$in_name = $value[0];
			$in_cord = $value[1];
			$in_price = $value[2];
			$in_stock = $value[3];
			$in_prod_content = $value[4];
			$in_prod_attention = $value[5];
			$in_recommended = $value[6];
			$in_onoff = $value[7];

			$file_main='img/no_image.png';
			$file01='img/no_image.png';
			$file02='img/no_image.png';
			$file03='img/no_image.png';
			$cat01='100';
			$cat02='100';
			$cat03='100';

			$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
			$sql=$pdo->prepare('insert into product values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,0)');
			$sql->execute([
				$in_name, 
				$in_cord, 
				$in_price, 
				$in_stock, 
				$file_main, 
				$file01, 
				$file02, 
				$file03, 
				$in_prod_content, 
				$in_prod_attention, 
				$in_recommended, 
				$cat01, 
				$cat02, 
				$cat03, 
				$in_onoff
			]);
		}
	}
}
?>