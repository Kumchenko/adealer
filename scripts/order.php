<?php
session_start();
// connecting to db
$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");

// model initializing 
$model=$_POST['model'];

// type of service
$type = $_POST['component'];
// if ($_POST['component'] == "display"){
//     $type=1;
// }
// if ($_POST['component'] == "housing"){
//     $type=2;
// }
// if ($_POST['component'] == "battery"){
//     $type=3;
// }


// contact data initializing
$name=$_POST['name'];
$surname=$_POST['surname'];
$tel=$_POST['tel'];
$email=$_POST['email'];

// status of order is NEW
$status=1;

// searching for service (initializing serviceid and cost)
$select = "model='{$model}' AND type='{$type}'";
$query="SELECT id, model, type, cost FROM services WHERE $select";
$service=mysqli_fetch_array(mysqli_query($connect, $query));

// current datetime
date_default_timezone_set('Europe/Kiev');
$newDate = date("Y-m-d H:i:s");

// creating query and applying
$insert = "name='{$name}', surname='{$surname}', tel='{$tel}', email='{$email}', service='{$service['id']}', status='1', newDate='{$newDate}'";
$query="INSERT INTO orders SET {$insert}";
mysqli_query($connect, $query);

// checking if success
if(mysqli_affected_rows($connect)>0)
    {
        // prepate to redirect to success.php
        $_SESSION['id'] = mysqli_insert_id($connect);
        $_SESSION['model'] = $service['model'];
        $_SESSION['type'] = $service['type'];
        $_SESSION['date'] = $newDate;
        $_SESSION['cost'] = $service['cost'];

        // redirecting to success.php
        header("Location: ../success.php");
    }
else
    {
        $t=mysqli_affected_rows($connect);
        echo "$t Помилка";
    }

?>