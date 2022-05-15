<?php 
    session_start(); 
    mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
    mysql_select_db("appledealer") or die ("Немає такої бази даних!");

    // variables
    $id=$_GET['id'];
    date_default_timezone_set('Europe/Kiev');
    $date = date("Y-m-d H:i:s");

    $response=mysql_query("SELECT id, status FROM orders WHERE id='{$id}' AND status='1'");
    $order=mysql_fetch_array($response);
    if ($order['id'] != null) {
        $query="UPDATE orders SET status='2', procdate='{$date}', employee='{$_SESSION['id']}' WHERE id='{$order['id']}'";
        mysql_query($query);
    }
    header('Location: allorders.php');
?>