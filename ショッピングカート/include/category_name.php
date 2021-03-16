<?php
$no = array();

$pdo=new PDO('mysql:host=localhost;dbname=shopingcart;charset=utf8', 'shopingcart', 'shopingcart');
foreach ($pdo->query('select * from category where status=2 and del=0') as $row) {
$a=$row['id'];
$b=$row['name'];
$no[$a] = $b;
}
echo $no[$_REQUEST['level']];
?>