<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
<span class="sr-only">国立職業リハビリテーションセンター図書管理システム</span><span class="navbar-brand p-3"><img class="" src="images/riha-logo.svg" alt="国立職業リハビリテーションセンター図書管理システム"></span>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
<span class="navbar-toggler-icon"></span>　メニュー
</button>
<div class="collapse navbar-collapse justify-content-md-center" id="navbar">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> ホーム　</a></li>
<li class="nav-item"><a class="nav-link" href="search.php"><i class="fas fa-book"></i> 図書検索　</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-book"></i> 管理図書一覧　</a>
<div class="dropdown-menu" aria-labelledby="dropdown01">
<a class="dropdown-item" href="lang.php"><i class="fas fa-book-open"></i> プログラミング言語</a>
<a class="dropdown-item" href="db.php"><i class="fas fa-book-open"></i> データーベース</a>
<a class="dropdown-item" href="ms.php"><i class="fas fa-book-open"></i> マイクロソフトオフィス</a>
<a class="dropdown-item" href="qual.php"><i class="fas fa-book-open"></i> 資格関連</a>
<a class="dropdown-item" href="mag.php"><i class="fas fa-book-open"></i> 雑誌関連</a>
</div>
</li>
<?php
if (isset($_SESSION['customer'])) {
if ($_SESSION['customer']['unsub'] == 1) {
echo '</ul>';
echo '<form class="form-inline ml-5 mt-2" action="login-output.php" method="post">';
echo '<div class="input-group">';
echo '<label for="inputEmail" class="sr-only">ログインID</label>';
echo '<input class="form-control form-control-sm" id="inputEmail" type="text" placeholder="ログインID" aria-describedby="button-addon1" name="login_name">';
echo '<label for="inputPassword" class="sr-only">パスワード</label>';
echo '<input class="form-control form-control-sm" id="inputPassword" type="password" placeholder="パスワード" aria-describedby="button-addon1" name="password">';
echo '<div class="input-group-append">';
echo '<button class="btn btn-outline-success btn-sm" type="submit" id="button-addon1">ログイン</button>';
echo '</div>';
echo '</div>';
echo '</form>';
} else {
echo '<li class="nav-item dropdown">';
echo '<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-tie"></i> 訓練生メニュー　</a>';
echo '<div class="dropdown-menu" aria-labelledby="dropdown01">';
echo '<a class="dropdown-item" href="lending-list.php"><i class="fas fa-file-alt"></i> 貸出申請中一覧</a>';
echo '<a class="dropdown-item" href="favorite-list.php"><i class="fas fa-heart"></i> お気に入り一覧</a>';
echo '<a class="dropdown-item" href="request-form.php"><i class="fas fa-comment"></i> 本のリクエスト</a>';
echo '<a class="dropdown-item" href="info-form.php"><i class="far fa-envelope"></i> 情報変更依頼</a>';
echo '<a class="dropdown-item" href="logout.php"><i class="fas fa-window-close"></i> ログアウト</a>';
echo '</div>';
echo '</li>';
echo '</ul>';
}
} else {
echo '</ul>';
echo '<form class="form-inline ml-5 mt-2" action="login-output.php" method="post">';
echo '<div class="input-group">';
echo '<label for="inputEmail" class="sr-only">ログインID</label>';
echo '<input class="form-control form-control-sm" id="inputEmail" type="text" placeholder="ログインID" aria-describedby="button-addon1" name="login_name">';
echo '<label for="inputPassword" class="sr-only">パスワード</label>';
echo '<input class="form-control form-control-sm" id="inputPassword" type="password" placeholder="パスワード" aria-describedby="button-addon1" name="password">';
echo '<div class="input-group-append">';
echo '<button class="btn btn-outline-success btn-sm" type="submit" id="button-addon1">ログイン</button>';
echo '</div>';
echo '</div>';
echo '</form>';
}
?>
</div>
</nav>