<aside class="col-md-2">
<div class="p-2 bg-white rounded">
<h4 class="fs-13"><i class="fab fa-sistrix"></i> Search</h4>
<form method="post" action="search.php">
<div class="input-group input-group-sm mb-2">
<input type="text" class="form-control" name="search" value="">
<div class="input-group-append"><input type="submit" class="btn btn-outline-secondary" name="" value="検索"></div>
</div>
</form>
</div>
<?php
if (isset($_SESSION['customer'])) {
	if ($_SESSION['customer']['del'] == 1) {
		echo '<div class="list-group g-list mt-2" style="border-radius: 0px;">';
		echo '<div class="list-group-item list-group-item-dark g-list"> ログイン</div>';
		echo '<form class="p-2 bg-white" action="login-output.php" method="post">';
		echo '<input type="text" class="form-control" placeholder="Emailアドレス" name="login_name" required>';
		echo '<input type="password" class="form-control mt-1" placeholder="パスワード" name="password" required>';
		echo '<button class="btn btn-sm btn-primary btn-block mt-1" type="submit">ログイン</button>';
		echo '</form>';
		echo '<a href="customer-newinput.php" class="list-group-item list-group-item-action g-list">会員登録</a>';
		echo '<a href="customer-forget.php" class="list-group-item list-group-item-action g-list small">※パスワードを忘れた方はこちら</a>';
		echo '</div>';
	} else {
		echo '<div class="list-group g-list mt-2" style="border-radius: 0px;">';
		echo '<div class="list-group-item list-group-item-info g-list">ようこそ。<br />', $_SESSION['customer']['name'], 'さん</div>';
		echo '<div class="list-group-item list-group-item-dark g-list"><i class="fas fa-user"></i> 会員メニュー</div>';
		echo '<a href="customer-news-list.php?pg=1" class="list-group-item list-group-item-action g-list">お知らせ</a>';
		echo '<a href="customer-cart-list.php?pg=1" class="list-group-item list-group-item-action g-list">買い物カゴ</a>';
		echo '<a href="customer-history-list.php?pg=1" class="list-group-item list-group-item-action g-list">購入履歴</a>';
		echo '<a href="customer-favorite-list.php?pg=1" class="list-group-item list-group-item-action g-list">お気に入り</a>';
		echo '<a href="customer-input.php?level=nomal" class="list-group-item list-group-item-action g-list">会員情報</a>';
		echo '<a href="customer-logout.php" class="list-group-item list-group-item-action g-list">ログアウト</a>';
		echo '</div>';
	}
} else {
	echo '<div class="list-group g-list mt-2" style="border-radius: 0px;">';
	echo '<div class="list-group-item list-group-item-dark g-list"> ログイン</div>';
	echo '<form class="p-2 bg-white" action="login-output.php" method="post">';
	echo '<input type="text" class="form-control" placeholder="Emailアドレス" name="login_name" required>';
	echo '<input type="password" class="form-control mt-1" placeholder="パスワード" name="password" required>';
	echo '<button class="btn btn-sm btn-primary btn-block mt-1" type="submit">ログイン</button>';
	echo '</form>';
	echo '<a href="customer-newinput.php" class="list-group-item list-group-item-action g-list">会員登録</a>';
	echo '<a href="customer-forget.php" class="list-group-item list-group-item-action g-list small">※パスワードを忘れた方はこちら</a>';
	echo '</div>';
}
?>

<div class="list-group g-list mt-2" style="border-radius: 0px;">
<div class="list-group-item list-group-item-dark g-list"><i class="fas fa-book"></i> ご利用ガイド</div>
<a href="guide.php?page=begin" class="list-group-item list-group-item-action g-list">初めての方</a>
<a href="guide.php?page=flow" class="list-group-item list-group-item-action g-list">ご注文の流れ</a>
<a href="guide.php?page=payment" class="list-group-item list-group-item-action g-list">お支払い方法</a>
<a href="guide.php?page=returns" class="list-group-item list-group-item-action g-list">返品・交換</a>
<a href="guide.php?page=shipping" class="list-group-item list-group-item-action g-list">送料・配達時間</a>
<a href="guide.php?page=faq" class="list-group-item list-group-item-action g-list">よくある質問</a>
</div>

<div class="list-group g-list mt-2" style="border-radius: 0px;">
<a href="service.php?page=001" class="list-group-item list-group-item-action g-list">特定商取引法</a>
<a href="service.php?page=002" class="list-group-item list-group-item-action g-list">個人情報保護法</a>
<a href="contact-input.php" class="list-group-item list-group-item-action g-list">お問い合わせ</a>
</div>
</aside><!-- /.col-md-2 -->