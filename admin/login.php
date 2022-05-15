<?php 
session_start();

mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
mysql_select_db("appledealer") or die ("Немає такої таблиці!");

$res=mysql_query("SELECT * FROM employees WHERE login='{$_POST['login']}' AND pass='{$_POST['pass']}'");
if(mysql_num_rows($res)==0)
    echo "Невірний логін або пароль";
else {
    $employee=mysql_fetch_array($res);
    $_SESSION['id']=$employee['id'];
    $_SESSION['login']=$_POST['login'];
    $_SESSION['pass']=$_POST['pass'];
    $_SESSION['privs']=$employee['privs'];
    $_SESSION['zero']=13;
    Header("Location: allorders.php");
}
mysql_close();
?>