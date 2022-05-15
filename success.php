<?php
session_start();

$id = $_SESSION['id'];
$model = $_SESSION['model'];
$date = $_SESSION['date'];

if ($_SESSION['type'] == "1"){
    $type="Дисплей";
}
if ($_SESSION['type'] == "2"){
    $type="Корпус";
}
if ($_SESSION['type'] == "3"){
    $type="Акумулятор";
}
$cost = $_SESSION['cost'];


// connecting to db
mysql_connect("localhost", "root", "") or die ("Неможливо під'єднатися до серверу");
mysql_select_db("appledealer") or die ("Немає такої бази даних!");

// model converting to string
$select = "value='{$model}'";
$query="SELECT string FROM transcript WHERE $select";
$string=mysql_fetch_array(mysql_query($query));
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Замовити ремонт – AppleDealer</title>
    <link rel="icon" href="assets/icons/favicon.png" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet'>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/success.css">
</head>
<body>
    <header class="header">
        <div class="info-bar">
            <a class="info-bar-address" href="https://goo.gl/maps/6XaMBcnDsrfsMUQ39">
                Дніпро, вул. Михайла Коцюбинського 16
            </a>
            <button class="info-bar-tel">
                +380637776363
                <div class="info-bar-tel-desc">
                    Telegram, Viber, WhatsApp
                </div>
            </button>
            <button class="info-bar-feedback green-button">
                Зворотній зв'язок
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
                    <a href="admin/login.html">Працівникам</a>
                    <a href="order.html" id="nav-active-page">Замовити ремонт</a>
                    <a href="status.html">Перевірити статус</a>
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
        <div class="tile-wrapper">
            <div class="tile">
                <h1 id="tile-header">Дякуємо за замовлення</h1>
                <div id="tile-desc">Наш менеджер зв’яжиться з вами для уточнення умов</div>
                <div class="tile-details">
                    <span class="tile-detail" id="id">Замовлення №<?php echo $id; ?></span>
                    <span class="tile-detail" id="device"><?php echo "{$string['string']} $type"; ?></span>
                    <span class="tile-detail" id="cost">Вартість: <?php echo $cost; ?>грн</span>
                    <span class="tile-detail" id="status">Статус: Зареєстровано</span>
                    <span class="tile-detail" id="date"><?php echo $date; ?></span>
                </div>
                <button id="return" class="green-button" >На головну</button>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-credentials">
            (с) 2022 AppleDealer. Всі права захищені
        </div>
    </footer>
    <button class="footer-callback green-button">
        <div class="footer-callback-icon"></div>
    </button>
</body>
<script type="text/javascript" src="scripts/base.js" defer></script>
<script type="text/javascript" src="scripts/return.js" defer></script>
</html>