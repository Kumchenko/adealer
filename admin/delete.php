<?php
mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
mysql_select_db("appledealer") or die ("Немає такої бази даних!");

$query="DELETE FROM orders WHERE id=".$_GET['id'];
mysql_query($query);
header('Location: allorders.php');
?>