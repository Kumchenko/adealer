<?php
session_start();

if ($_SESSION['zero'] == 13){
    session_destroy();
} 

Header("Location: login.html"); 
?>