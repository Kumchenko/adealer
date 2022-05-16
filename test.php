<?php
// connecting to db
$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");

// model converting to string
$zapros="SELECT * FROM employees WHERE login='admin'";
$string=mysqli_query($connect, $zapros);
$emp=mysqli_fetch_array($string);
echo $emp['login'];
?>