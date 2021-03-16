<aside id="main" class="col-md-2">
<div class="list-group list-group-flush">
<div class="list-group-item list-group-item-dark" style="font-weight:bold;"><i class="fas fa-users"></i> 会員の管理</div>
<a class="list-group-item" href="admin-customer-list.php?pg=1&level=0"><i class="fas fa-angle-double-right"></i> 会員一覧</a>
<a class="list-group-item" href="admin-customer-list.php?pg=1&level=1"><i class="fas fa-angle-double-right"></i> 退会者一覧</a>
<a class="list-group-item" href="admin-customer-list.php?pg=1&level=2"><i class="fas fa-angle-double-right"></i> 仮会員一覧
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM customer WHERE status=0 AND del=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// 仮会員数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
?>
</a>
</div>
<div class="list-group list-group-flush">
<div class="list-group-item list-group-item-dark" style="font-weight:bold;"><i class="fas fa-user"></i> 購入者の管理</div>
<a class="list-group-item" href="admin-order-list.php?pg=1&level=0"><i class="fas fa-angle-double-right"></i> 注文者一覧
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=0 AND cancel=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
?>
</a>
<a class="list-group-item" href="admin-order-list.php?pg=1&level=1"><i class="fas fa-angle-double-right"></i> 支払完了者一覧
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM purchases WHERE status=2 AND cancel=0 AND id NOT IN ('1')";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
?>
</a>
<a class="list-group-item" href="admin-order-list.php?pg=1&level=2"><i class="fas fa-angle-double-right"></i> 発送完了者一覧</a>
<a class="list-group-item" href="admin-order-list.php?pg=1&level=5"><i class="fas fa-angle-double-right"></i> キャンセル一覧
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM cart WHERE cancel_date IS NOT NULL";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
?>
</a>
</div>
<div class="list-group list-group-flush">
<div class="list-group-item list-group-item-dark" style="font-weight:bold;"><i class="fas fa-dolly-flatbed"></i> 商品の管理</div>
<a class="list-group-item" href="admin-product-newinput.php"><i class="fas fa-angle-double-right"></i> 商品登録</a>
<a class="list-group-item" href="admin-product-list.php?pg=1&level=0"><i class="fas fa-angle-double-right"></i> 商品一覧</a>
<a class="list-group-item" href="admin-category-input.php"><i class="fas fa-angle-double-right"></i> カテゴリーの管理</a>
</div>
<div class="list-group list-group-flush">
<div class="list-group-item list-group-item-dark" style="font-weight:bold;"><i class="fas fa-file-signature"></i> お知らせの管理</div>
<a class="list-group-item" href="admin-information-newinput.php"><i class="fas fa-angle-double-right"></i> お知らせ登録</a>
<a class="list-group-item" href="admin-information-list.php?pg=1"><i class="fas fa-angle-double-right"></i> お知らせ一覧</a>
</div>
<div class="list-group list-group-flush mt-2">
<a class="list-group-item" href="admin-contact-list.php?pg=1"><i class="fas fa-envelope"></i> お問い合わせ管理
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
$sql = "SELECT * FROM contact WHERE status=0";
$NUMBER = 0;	// 該当件数
foreach ($pdo->query($sql) as $row) {
$NUMBER++;
}
// もし、未処理の問い合わせがあれば件数を表示
if ($NUMBER > 0) {
echo '　<span class="badge badge-danger">', $NUMBER, '</span>';
}
?>
</a>
</div>
</aside>
