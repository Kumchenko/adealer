<?php
$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");

$query="DELETE FROM orders WHERE id=".$_GET['id'];
mysqli_query($connect, $query);
header('Location: allorders.php');
?>