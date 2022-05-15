<?php
session_start();
// connecting to db
mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
mysql_select_db("appledealer") or die ("Немає такої бази даних!");

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
$service=mysql_fetch_array(mysql_query($query));

// current datetime
date_default_timezone_set('Europe/Kiev');
$newDate = date("Y-m-d H:i:s");

// creating query and applying
$insert = "name='{$name}', surname='{$surname}', tel='{$tel}', email='{$email}', service='{$service['id']}', status='1', newDate='{$newDate}'";
$query="INSERT INTO orders SET {$insert}";
mysql_query($query);

// checking if success
if(mysql_affected_rows()>0)
    {
        // prepate to redirect to success.php
        $_SESSION['id'] = mysql_insert_id();
        $_SESSION['model'] = $service['model'];
        $_SESSION['type'] = $service['type'];
        $_SESSION['date'] = $newDate;
        $_SESSION['cost'] = $service['cost'];

        // redirecting to success.php
        header("Location: ../success.php");
    }
else
    {
        $t=mysql_affected_rows();
        echo "$t Помилка";
    }

?>