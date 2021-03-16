<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
	<span class="sr-only">国立職業リハビリテーションセンター図書管理システム</span><span class="navbar-brand p-3"><img class="" src="images/riha-logo.svg" alt="国立職業リハビリテーションセンター図書管理システム"></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
		<span class="navbar-toggler-icon"></span>　メニュー
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbar">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="admin-login-output.php"><i class="fas fa-home"></i> 管理トップ　</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-export"></i> 登録関連メニュー </a>
				<div class="dropdown-menu" aria-labelledby="dropdown01">
<?php
if ($_SESSION['staff']['login_name'] == "administrator") {
					echo '<a class="dropdown-item" href="staff-newinput.php"><i class="fas fa-award"></i> 指導員登録</a>';
}
if ($_SESSION['staff']['login_name'] == "a_test") {
					echo '<a class="dropdown-item" href="staff-newinput.php"><i class="fas fa-award"></i> 指導員登録</a>';
}
?>
					<a class="dropdown-item" href="news-newinput.php"><i class="fas fa-arrow-alt-circle-right"></i> お知らせ登録</a>
					<a class="dropdown-item" href="member-newinput.php"><i class="fas fa-arrow-alt-circle-right"></i> 訓練生登録</a>
					<a class="dropdown-item" href="book-newinput.php"><i class="fas fa-arrow-alt-circle-right"></i> 図書登録</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-file-signature"></i> 管理関連メニュー </a>
				<div class="dropdown-menu" aria-labelledby="dropdown02">
<?php
if ($_SESSION['staff']['login_name'] == "administrator") {
					echo '<a class="dropdown-item" href="staff-list.php"><i class="fas fa-award"></i> 指導員管理</a>';
}
if ($_SESSION['staff']['login_name'] == "a_test") {
					echo '<a class="dropdown-item" href="staff-list.php"><i class="fas fa-award"></i> 指導員管理</a>';
}
?>
					<a class="dropdown-item" href="news-list.php"><i class="fas fa-arrow-alt-circle-right"></i> お知らせ管理</a>
					<a class="dropdown-item" href="member-list.php"><i class="fas fa-arrow-alt-circle-right"></i> 訓練生管理</a>
					<a class="dropdown-item" href="book-list.php"><i class="fas fa-arrow-alt-circle-right"></i> 図書管理</a>
					<a class="dropdown-item" href="lending-list-allmember.php"><i class="fas fa-arrow-alt-circle-right"></i> 貸出申請管理</a>
				</div>
			</li>
			<li class="nav-item"><a class="nav-link" href="staff-logout.php"><i class="fas fa-window-close"></i> ログアウト　</a></li>
		</ul>
	</div>
</nav>