<?php
$model=$_GET['model'];
$type=$_GET['type'];

mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
mysql_select_db("appledealer") or die ("Немає такої таблиці!");
$response=mysql_query("SELECT id, model, type, cost FROM services WHERE type='{$type}' AND model='{$model}'");
$order=mysql_fetch_array($response);

echo $order['cost'];
?>