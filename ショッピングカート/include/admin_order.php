<?php
$pref = $_REQUEST['level'];

switch ($pref){
case '0':	// 注文者一覧に関する処理
	echo '注文者一覧';
	break;

case '1':	// 支払完了者一覧に関する処理
	echo '支払完了者一覧';
	break;

case '2':	// 発送完了者一覧に関する処理
	echo '発送完了者一覧';
	break;

case '5':	// キャンセル一覧に関する処理
	echo 'キャンセル一覧';
	break;
}
?>