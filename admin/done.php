<?php 
    session_start(); 
    $connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
	mysqli_select_db($connect, "9loMZIDsgF");

    // variables
    $id=$_GET['id'];
    date_default_timezone_set('Europe/Kiev');
    $date = date("Y-m-d H:i:s");

    $response=mysqli_query($connect, "SELECT id, status FROM orders WHERE id='{$id}' AND status='2'");
    $order=mysqli_fetch_array($response);
    if ($order['id'] != null) {
        $query="UPDATE orders SET status='3', donedate='{$date}' WHERE id='{$order['id']}'";
        mysqli_query($connect, $query);
    }
    header('Location: allorders.php');
?>