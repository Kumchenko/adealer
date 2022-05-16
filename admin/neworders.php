<?php 
session_start(); 
$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");
$result=mysqli_query($connect, "SELECT * FROM employees WHERE login='{$_SESSION['login']}' AND pass='{$_SESSION['pass']}';");
if(mysqli_num_rows($result)==0) {
    Header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $_SESSION['login']; ?> – AppleDealer</title>
    <link rel="icon" href="assets/icons/favicon.png" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet'>
    <link rel="stylesheet" href="../styles/base.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <header class="header">
        <div class="info-bar">
            <a class="info-bar-address" href="https://goo.gl/maps/6XaMBcnDsrfsMUQ39">
                Авторизовано: <? echo $_SESSION['login']; ?>
            </a>
            <button class="info-bar-tel">
                +380637776363
                <div class="info-bar-tel-desc">
                    Telegram, Viber, WhatsApp
                </div>
            </button>
        </div>
        <div class="nav-bar-wrapper">
            <div class="nav-bar">
                <div class="nav-bar-mobile">
                    <div class="nav-logo-wrapper">
                        <i class="nav-logo"></i>
                    </div>
                    <div class="nav-menu-logo-wrapper">
                        <i class="nav-menu-logo"></i>
                    </div>
                </div>
                <div class="nav-pages">
                    <a href="allorders.php">Всі</a>
                    <a href="neworders.php" id="nav-active-page">Нові</a>
                    <a href="waitorders.php">В процесі</a>
                    <a href="logout.php">Вихід</a>
                </div>
                <div class="nav-social-wrapper">
                    <div class="nav-social-logo-wrapper">
                        <a href="https://www.instagram.com/appledealer_ua/" class="nav-instagram-logo"></a>
                    </div>
                    <div class="nav-social-logo-wrapper">
                        <a href="https://www.instagram.com/appledealer_ua/" class="nav-telegram-logo"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <?php

        // Нові
        $orders=mysqli_query($connect, "SELECT o.id, o.name, o.surname, o.tel, o.email, o.status, s.model, s.type, s.cost, o.employee, o.newdate, o.procdate, o.donedate FROM orders o INNER JOIN services s ON o.service = s.id WHERE o.status = '1'");
        
        while ($order=mysqli_fetch_array($orders)){

            $handler=mysqli_query($connect, "SELECT e.login FROM orders o, employees e WHERE o.employee = e.id AND o.id = '{$order['id']}'");
            $handle=mysqli_fetch_array($handler);

            // convert serviceID to serviceType
            if ($order['type'] == "1"){
                $type="Дисплей";
            }
            if ($order['type'] == "2"){
                $type="Корпус";
            }
            if ($order['type'] == "3"){
                $type="Акумулятор";
            }

            // converting modelID to modelName
            $query="SELECT string FROM transcript WHERE value='{$order['model']}'";
            $string=mysqli_fetch_array(mysqli_query($connect, $query));
            $model=$string['string'];

            echo "<table border=\"1\" cellspacing=\"1\">";
                echo "<tr>";
                    echo "<td rowspan=\"2\">" . $order['id'] . "</td>";
                    echo "<td>" . $order['name'] . "</td>";
                    echo "<td>" . $order['tel'] . "</td>";
                    echo "<td>" . $model . "</td>";
                    echo "<td rowspan=\"2\">" . $order['cost'] . "грн</td>";
                    if ($_SESSION['privs'] == '1') { // якщо є привілеї
                        echo "<td rowspan=\"4\"><a href=\"delete.php?id=" . $order['id'] . "\"><font color=\"red\"><b>Delete</b></font></a></td>";
                    }
                echo "</tr>";
                echo "<tr>";
                    echo "<td>" . $order['surname'] . "</td>";
                    echo "<td>" . $order['email'] . "</td>";
                    echo "<td>" . $type . "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td><i>Created</i></td>";
                    echo "<td><i>Processing</i></td>";
                    echo "<td><i>Done</i></td>";
                    echo "<td colspan=\"2\">Handler</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td>" . $order['newdate'] . "</td>";

                    if ($order['employee'] != null){ // якщо заявка має обробника
                        echo "<td>" . $order['procdate'] . "</td>"; // показати час прийняття в обробку
                    }
                    else { // якщо не оброблюється
                        echo "<td><a href=\"process.php?id=" . $order['id'] . "\"><b>GET IN PROCESS</b></a></td>";
                    }

                    // Обмеження, щоб зачиняти заявку міг тільки employee з privs=true або оброблювач
                    if ($order['donedate'] != null){ // якщо заявка закрита
                        echo "<td>" . $order['donedate'] . "</td>"; // показати час закриття
                    }
                    else { // якщо не закрита
                        if ($order['employee'] != null) { // перевірка того що заявка в процесі
                            if ($handle['login'] == $_SESSION['login'] || $_SESSION['privs'] == '1' ){ // перевірка прав
                                echo "<td><a href=\"done.php?id=" . $order['id'] . "\"><b>SET DONE</b></a></td>"; // є права
                            }
                            else {
                                echo "<td>Оброблюється</td>"; // немає прав
                            }
                        }
                        else {
                            echo "<td></td>"; // немає прав
                        }
                    }


                    echo "<td colspan=\"2\">" . $handle['login'] . "</td>";
                echo "</tr>";
            echo "</table>";
            echo "<br>";
        }
        ?>
    </main>
    <footer class="footer">
        <div class="footer-credentials">
            (с) 2022 AppleDealer. Всі права захищені
        </div>
    </footer>
</body>
<script type="text/javascript" src="../scripts/admin.js" defer></script>
</html>