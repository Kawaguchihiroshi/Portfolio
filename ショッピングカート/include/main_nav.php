<nav class="navbar navbar-expand-sm navbar-light">
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="ナビの切替">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-between" id="navbarMain">
<div class="navbar-nav">
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
foreach ($pdo->query('SELECT * FROM category WHERE status=2 AND del=0 AND id NOT IN (100) ORDER BY number ASC, id ASC') as $row) {
echo '<a class="p-2 nav-item nav-link" href="category.php?pg=1&level=', $row['id'], '">', $row['name'], '</a>';
}
?>
</div>
</div>
</nav>