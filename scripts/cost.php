<?php
$model=$_GET['model'];
$type=$_GET['type'];

$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");
$response=mysqli_query($connect, "SELECT id, model, type, cost FROM services WHERE type='{$type}' AND model='{$model}'");
$order=mysqli_fetch_array($response);

echo $order['cost'];
?>