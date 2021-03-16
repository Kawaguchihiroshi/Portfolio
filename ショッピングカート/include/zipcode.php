<?php
	// 呼び出したURLの'?'以降の'zipcode='で指定された文字列を取得する (GET)
	$zipcode = '';
	if (!empty($_GET['zipcode'])) {
		$zipcode = $_GET['zipcode'];
	}
	// 呼び出したURLの'?'以降の'callback='で指定された文字列を取得する (GET)
	// 指定がなければ'jsonp'というコールバック関数名で返す
	$callback = 'jsonp';
	if (!empty($_GET['callback'])) {
		$callback = $_GET['callback'];
	}
	// ZipCloudのAPI用のアドレス文字列を生成
	$url = "http://zipcloud.ibsnet.co.jp/api/search?zipcode={$zipcode}&callback={$callback}";
	// テキストデータを読み込む (HTTP通信)
	$json = file_get_contents($url);
	// 文字化けしないようにUTF-8に変換
	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	// 取得した文字列をそのまま返す
	print_r($json);
?>