<?php 
session_start();

$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");

$res=mysqli_query($connect, "SELECT * FROM employees WHERE login='{$_POST['login']}' AND pass='{$_POST['pass']}'");
if(mysqli_num_rows($res)==0)
    echo "Невірний логін або пароль";
else {
    $employee=mysqli_fetch_array($res);
    $_SESSION['id']=$employee['id'];
    $_SESSION['login']=$_POST['login'];
    $_SESSION['pass']=$_POST['pass'];
    $_SESSION['privs']=$employee['privs'];
    $_SESSION['zero']=13;
    Header("Location: allorders.php");
}
mysqli_close();
?>