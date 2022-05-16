<?php
$connect = mysqli_connect("remotemysql.com:3306", "9loMZIDsgF", "mtlKq0K3Hn");
mysqli_select_db($connect, "9loMZIDsgF");
$response=mysqli_query($connect, "SELECT o.id, o.status, s.model, s.type, s.cost, o.newdate, o.procdate, o.donedate FROM orders o, services s WHERE o.service = s.id AND o.id='{$_POST['id']}' AND o.tel='{$_POST['tel']}'");
$order=mysqli_fetch_array($response);

if ($order['id'] == null){
    Header("Location: failed.html");
}

// перекладаємо ID компонента в назву компонента
if ($order['type'] == "1"){
    $type="Дисплей";
}
if ($order['type'] == "2"){
    $type="Корпус";
}
if ($order['type'] == "3"){
    $type="Акумулятор";
}

// перекладаємо ID статусу в назву статусу та привласнюємо актуальну дату
if ($order['status'] == "1"){
    $status="Зареєстровано";
    $date=$order['newdate'];
}
if ($order['status'] == "2"){
    $status="В обробці";
    $date=$order['procdate'];
}
if ($order['status'] == "3"){
    $status="Готово";
    $date=$order['donedate'];
}

// перекладаємо value моделі в назву моделі
$response="SELECT string FROM transcript WHERE value='{$order['model']}'";
$string=mysqli_fetch_array(mysqli_query($connect, $response));
$model=$string['string'];

// виводимо з order залишені зміні та видаляємо змінну
$id=$order['id'];
$cost=$order['cost'];
$model_value=$order['model'];
unset($order);

// variables
// echo $id;
// echo $model;
// echo $cost;
// echo $status;
// echo $date;
// echo $type;


?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Замовлення №<? echo $id; ?> – AppleDealer</title>
    <link rel="icon" href="assets/icons/favicon.png" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800' rel='stylesheet'>
    <link rel="stylesheet" href="styles/base.css">
    <link rel="stylesheet" href="styles/status.css">
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
                    <a href="order.html">Замовити ремонт</a>
                    <a href="status.html" id="nav-active-page">Перевірити статус</a>
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
        <div class="tile">
            <h1 id="tile-header">Статус замовлення №<? echo $id; ?></h1>
            <div id="tile-desc">Виникли питання? Зателефонуйте нам</div>
            <div class="space"></div>
            <div class="tile-status">
                <div class="tile-detail"><? echo $status; ?></div>
                <div class="tile-detail"><? echo $date; ?></div>
            </div>
            <div class="tile-model-image-wrapper">
                <div class="tile-model-image" style="background-image: url('../assets/images/iphones/<? echo $model_value; ?>.png');"></div>
            </div>
            <div class="tile-info">
                <div class="tile-detail"><? echo $model . " " . $type; ?></div>
                <div class="tile-detail">Вартість: <? echo $cost; ?>грн</div>
            </div>
            <button id="return" class="green-button" >На головну</button>
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
<script type="text/javascript" src="./scripts/base.js" defer></script>
<script type="text/javascript" src="./scripts/return.js" defer></script>
</html>