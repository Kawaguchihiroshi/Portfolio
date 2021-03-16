<div class="product-area pt-3">
<h2 class="p-3" style="border-bottom: solid 2px #777;"><i class="fas fa-th-large"></i> ヒットアイテム</h2>
<div class="row pl-3 pr-3">
<?php
// ■ヒットアイテム --------------------------------------------
//
//　ソート条件
//　・商品テーブルから( product )
//　・表示されているアイテム（ del=0 ）
//　・カテゴリー内( cate_id01=? OR cate_id02=? OR cate_id03=? )
//　・商品IDをランダム表示( ORDER BY RAND() )
//　・初めから4件表示( LIMIT 4 )
//
//------------------------------------------------------------

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
if (empty($_REQUEST['level'])) {
	$pref = 0;
} else {
	$pref = $_REQUEST['level'];
}
$count = 0;
switch ($pref){

case '1':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=1 OR cate_id02=1 OR cate_id03=1 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '2':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=2 OR cate_id02=2 OR cate_id03=2 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '3':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=3 OR cate_id02=3 OR cate_id03=3 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '4':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=4 OR cate_id02=4 OR cate_id03=4 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '5':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=5 OR cate_id02=5 OR cate_id03=5 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '6':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=6 OR cate_id02=6 OR cate_id03=6 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '7':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=7 OR cate_id02=7 OR cate_id03=7 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '8':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=8 OR cate_id02=8 OR cate_id03=8 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '9':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=9 OR cate_id02=9 OR cate_id03=9 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

case '10':
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 AND ( cate_id01=10 OR cate_id02=10 OR cate_id03=10 ) ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo 'このカテゴリーには現在、商品がありません。';
		echo '</div>';
	}
	break;

default:
	foreach ($pdo->query('SELECT * FROM product WHERE del=0 ORDER BY RAND() LIMIT 4') as $row) {
		echo '<div class="col-md-3 p-2">';
		echo '<div><img class="w-100" src="', $row['img_main'], '"></div>';
		echo '<div class="mt-1">';
		if ($row['stock'] > 0) {
			echo '<span class="badge badge-pill badge-primary">在庫あり</span>';
		} else {
			echo '<span class="badge badge-pill badge-secondary">在庫なし</span>';
		}
		echo '</div>';
		echo '<div class="mt-1">';
		echo '<h5>', $row['name'], '</h5>';
		echo '</div>';
		echo '<div class="mt-1">', $row['price'], '円</div>';
		echo '<div class="mt-2"><a href="detail.php?id=', $row['id'], '" class="btn btn-sm btn-outline-success w-100">詳細はこちら</a></div>';
		echo '</div><!-- /.col-md-3 -->';
		$count++;
	}
	if ($count == 0) {
		echo '<div class="p-5">';
		echo '現在、商品がありません。';
		echo '</div>';
	}

}
?>
</div><!-- /.row -->
</div><!-- /.product-area -->
