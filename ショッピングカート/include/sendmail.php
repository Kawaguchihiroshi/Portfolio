<?php
//言語と文字コードの使用宣言
mb_language("ja");
mb_internal_encoding("UTF-8");

// 宛先
if (isset($regist)) {
	if ($regist == 1) {
		$to = $row['email'];
	} else {
		$to = $_REQUEST['email'];
	}
} else {
	$to = $_REQUEST['email'];
}

// 件名
$title = "【NERVE FACTORY】メールの送信テスト";

// 本文
if (isset($regist)) {
	if ($regist == 1) {
		$content = $row['name'] . " 様 \r\n";
	} else {
		$content = $_REQUEST['name'] . " 様 \r\n";
	}
} else {
	$content = $_REQUEST['name'] . " 様 \r\n";
}

$content .= "\r\n";
$content .= "こちらはテストメールです。 \r\n";

if (isset($regist)) {
	if ($regist == 1) {
		$pref = true;
	} else {
		$pref = $_REQUEST['level'];
	}
} else {
	$pref = $_REQUEST['level'];
}

switch ($pref){
case '0':	//　仮登録完了時（会員登録）　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、URLよりご登録の確定をお願いいたします。 \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "【本登録URL】 \r\n";
	$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
	$sql=$pdo->prepare('SELECT * FROM customer WHERE customer_no=?');
	$sql->execute([$customer_no]);
	foreach ($sql->fetchAll() as $row) {
		date_default_timezone_set('Japan');
		$contactdate=date('YmdHis');
		$content .= "https://pf01.newheadworks.com/register.php?cid=" . $contactdate . "&id=" . $row['id'] . "&customer_no=" . $row['customer_no'] . " \r\n";
	}
$content .= "※上記URLのページはこのメール送信後1時間でアクセスできなくなります。\r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
break;
case 'true':	//　会員登録完了時　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、内容でご登録いたしましたのでご連絡いたします。 \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "≪お客様情報≫ \r\n";
$content .= "メールアドレス：" . $row['email'] . " \r\n";
$content .= "パスワード：ご入力いただいたパスワード \r\n";
$content .= "氏名：" . $row['name'] . " \r\n";
$content .= "郵便番号：〒" . $row['post_no'] . " \r\n";
$content .= "住所：" . $row['adrs'] . " \r\n";
$content .= "電話番号：" . $row['tell'] . " \r\n";
$content .= "\r\n";
$content .= "≪配送先情報≫ \r\n";
$content .= "氏名【配送先】：" . $row['delivery_name'] . " \r\n";
$content .= "郵便番号【配送先】：" . $row['delivery_post_no'] . " \r\n";
$content .= "住所【配送先】：" . $row['delivery_adrs'] . " \r\n";
$content .= "電話番号【配送先】：" . $row['delivery_tell'] . " \r\n";
$content .= "\r\n";
$content .= "上記、内容にご変更などございましたら以下URLより会員情報の変更を行ってください。 \r\n";
$content .= "【会員情報変更ページ】https://pf01.newheadworks.com/customer-input.php \r\n";
$content .= "----------------------------------------------- \r\n";
break;
case '1':	//　会員情報変更完了時　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、内容で会員情報の変更を行いましたのでご連絡いたします。 \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "≪お客様情報≫ \r\n";
$content .= "メールアドレス：" . $_REQUEST['email'] . " \r\n";
$content .= "パスワード：ご入力いただいたパスワード \r\n";
$content .= "氏名：" . $_REQUEST['name'] . " \r\n";
$content .= "郵便番号：〒" . $_REQUEST['post_no'] . " \r\n";
$content .= "住所：" . $_REQUEST['adrs'] . " \r\n";
$content .= "電話番号：" . $_REQUEST['tell'] . " \r\n";
$content .= "\r\n";
$content .= "≪配送先情報≫ \r\n";
$content .= "氏名【配送先】：" . $_REQUEST['delivery_name'] . " \r\n";
$content .= "郵便番号【配送先】：" . $_REQUEST['delivery_post_no'] . " \r\n";
$content .= "住所【配送先】：" . $_REQUEST['delivery_adrs'] . " \r\n";
$content .= "電話番号【配送先】：" . $_REQUEST['delivery_tell'] . " \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
break;
case '2':	//　退会完了時　---------------------------------------------------------------------
break;
case '3':	//　パスワードを忘れた方にリセットURLを送信時　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、パスワードのリセットURLよりパスワードのリセットをお願いいたします。 \r\n";
$content .= "\r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "【パスワードリセットURL】 \r\n";
date_default_timezone_set('Japan');
$contactdate=date('YmdHis');
$content .= "https://pf01.newheadworks.com/reset_pass.php?cid=" . $contactdate . "&id=" . $row['id'] . "&customer_no=" . $row['customer_no'] . " \r\n";
$content .= "※上記URLのページはこのメール送信後1時間でアクセスできなくなります。\r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
break;
case '4':	//　お問い合わせ送信完了時　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、内容でお問い合わせをいたしましたのでご連絡いたします。 \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "氏名：" . $_REQUEST['name'] . " \r\n";
$content .= "メールアドレス：" . $_REQUEST['email'] . " \r\n";
$content .= "\r\n";
$content .= "[お問い合わせタイトル] \r\n";
$content .= $_REQUEST['title'] . " \r\n";
$content .= "\r\n";
$content .= "[お問い合わせ内容] \r\n";
$content .= $_REQUEST['content'] . " \r\n";
$content .= "\r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "お客様より貴重なお問い合わせありがとうございます。 \r\n";
$content .= "担当者が確認後、ご対応いたします。 \r\n";
break;
case '5':	//　会員情報変更完了時　---------------------------------------------------------------------
$content .= "このたびは、NERVE FACTORYをご利用いただきありがとうございます。 \r\n";
$content .= "以下、内容で会員情報の変更を行いましたのでご連絡いたします。 \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
$content .= "\r\n";
$content .= "≪お客様情報≫ \r\n";
$content .= "メールアドレス：" . $_REQUEST['email'] . " \r\n";
$content .= "パスワード：ご入力いただいたパスワード \r\n";
$content .= "氏名：" . $_REQUEST['name'] . " \r\n";
$content .= "郵便番号：〒" . $_REQUEST['post_no'] . " \r\n";
$content .= "住所：" . $_REQUEST['adrs'] . " \r\n";
$content .= "電話番号：" . $_REQUEST['tell'] . " \r\n";
$content .= "\r\n";
$content .= "≪配送先情報≫ \r\n";
$content .= "氏名【配送先】：" . $_REQUEST['delivery_name'] . " \r\n";
$content .= "郵便番号【配送先】：" . $_REQUEST['delivery_post_no'] . " \r\n";
$content .= "住所【配送先】：" . $_REQUEST['delivery_adrs'] . " \r\n";
$content .= "電話番号【配送先】：" . $_REQUEST['delivery_tell'] . " \r\n";
$content .= "\r\n";
$content .= "----------------------------------------------- \r\n";
break;
}
$content .= "\r\n\r\n\r\n";
$content .= "上記、内容に身に覚えがない場合は、お手数ではございますが以下までご連絡お願い申し上げます。 \r\n";
$content .= "【メール配信元】 \r\n";
$content .= "NERVE FACTORY　お客様サポート事務局 \r\n";
$content .= "ご連絡先：support@newheadworks.com \r\n";
$content .= "サイト名：NERVE FACTORY ナーヴ・ファクトリー \r\n";
$content .= "サイトURL：https://pf01.newheadworks.com \r\n";
$content .= "\r\n";


// 送信元
$from = "NERVE FACTORY サポート事務局<support@newheadworks.com>";

// 送信元メールアドレス
$from_mail = "support@newheadworks.com";

// 送信者名
$from_name = "NERVE FACTORY サポート事務局";

// 送信者情報の設定
$header = '';
$header .= "Content-Type: text/plain \r\n";
$header .= "Return-Path: " . $from_mail . " \r\n";
$header .= "From: " . $from ." \r\n";
$header .= "Sender: " . $from ." \r\n";
$header .= "Reply-To: " . $from_mail . " \r\n";
$header .= "Organization: " . $from_name . " \r\n";
$header .= "X-Sender: " . $from_mail . " \r\n";
$header .= "X-Priority: 3 \r\n";

if(mb_send_mail($to, $title, $content, $header)){
	echo "メールを送信しました";
} else {
	echo "メールの送信に失敗しました";
};
?>