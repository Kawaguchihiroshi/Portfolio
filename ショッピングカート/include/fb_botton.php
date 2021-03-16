	<!-- Facebook Share Botton -->
	<?php
	$my_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	echo '<meta property="og:url"           content="', $my_url, '" />';
	echo '<meta property="og:type"          content="website" />';

	$html = file_get_contents($my_url);
	$html = mb_convert_encoding($html, mb_internal_encoding(), "auto" );
	if ( preg_match( "/<title>(.*?)<\/title>/i", $html, $matches) ) { 
		echo '<meta property="og:title"         content="', $matches[1], '" />';
	} else {
		echo '<meta property="og:title"         content="NERVE FACTORY" />';
	}
	echo '<meta property="og:description"   content="株式会社ナーヴの運営するショッピングサイトです。" />';
	if (isset($_GET['id'])) {
		$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
		$sql=$pdo->prepare('select * from product where id=?');
		$sql->execute([$_GET['id']]);
		foreach ($sql->fetchAll() as $row) {
			echo '<meta property="og:image"         content="https://pf01.newheadworks.com/', $row['img_main'], '" />';
		}
	} else {
		echo '<meta property="og:image"         content="https://pf01.newheadworks.com/images/logo.jpg" />';
	}
	?>