<?php
session_start();
if(isset($_GET['clear_cart']) && $_GET['clear_cart'] === 'true') {
    unset($_SESSION['cart_list']);
}

require_once "connection.php"; 
require_once "functions.php";

if (isset($_GET['idPizza']) && isset($_GET['quantity'])) {
    $idPizza = $_GET['idPizza'];
    $quantity = $_GET['quantity'];

    $current_added_pizza = get_pizza_by_id($idPizza);

    if (!isset($_SESSION['cart_list'])) {
        $_SESSION['cart_list'] = array();
    }

    $cart_item = array(
        'idPizza' => $idPizza,
        'Name' => $current_added_pizza['Name'],
        'idPizza' => $idPizza,
        'Image' => $current_added_pizza['Image'],
        'quantity' => $quantity,
        'Cost' => $current_added_pizza['Cost']
    );

    $_SESSION['cart_list'][] = $cart_item;
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    foreach ($_SESSION['cart_list'] as $key => $item) {
        if ($item['idPizza'] == $delete_id) {
            unset($_SESSION['cart_list'][$key]);
            break;
        }
    }
}

if ( isset($_GET['idPizza']) && !empty($_GET['idPizza']) ) {

	$current_added_pizza = get_pizza_by_id($_GET['idPizza']);

	// ...
	if ( !empty($current_added_pizza) ) {

		if ( !isset($_SESSION['cart_list'])) {
			$_SESSION['cart_list'][] = $current_added_pizza;
		}


		$course_check = false;

		if ( isset($_SESSION['cart_list']) ) {
			foreach ($_SESSION['cart_list'] as $value) {
				if ( $value['idPizza'] == $current_added_pizza['idPizza'] ) {
					$course_check = true;
				}
			}
		}


		if ( !$course_check ) {
			$_SESSION['cart_list'][] = $current_added_pizza;
            header("Location: PizzeriaMain.php");
		}

	} else {
		header("Location: 404.php");
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="css/korzCSS.css">
    <link rel="stylesheet" href="css/dropCSS.css">
    <script src="js/drop.js"></script>
    <title>Корзина</title>
</head>
<body onclick="myFunction1()">
    <div class="overlay"></div>
<div class="grid">
    <div class="menu"> 
    <button onclick="myFunction()" class="dropbtn">Меню</button>
    <div id="myDropdown" class="dropdown-content">
        <button onclick="document.location='PizzeriaFirst.php'" class="buttonDropbox"><span>Главное меню</span></button></br>
        <button onclick="document.location='PizzeriaSborka.php'" class="buttonDropbox"><span>Собрать пиццу</span></button></br>
        <button onclick="document.location='PizzeriaMain.php'" class="buttonDropbox"><span>Готовые пиццы</span></button></br>
        <button onclick="document.location='login.php'" class="buttonDropbox"><span>Войти в аккаунт</span></button></br>
        <button onclick="document.location='ContactInf.php'" class="buttonDropbox"><span>Контактная информация</span></button>
    </div>
    </div>

     <div class="header" style="font-family: Oblako;"><h1>Корзина</h1></div>
</div>
<center>
    <div class="goods">
    <?php 
        if(isset($_SESSION['cart_list'])){
            $totalCost = 0;
            foreach ($_SESSION['cart_list'] as $pizza) {
                $totalCost += $pizza['Cost'];
            }
            if($totalCost != 0){
                echo "<h2  >ИТОГО: $totalCost руб.</h2>";
            }
            else{
                echo "<center><p style='font-size:400%'>Ваша корзина пуста :(</p>";

            }
        } else {
            echo "<center><p style='font-size:400%'>Ваша корзина пуста :(</p>";
        }
        
        if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) != 0) {
            echo '<ul style="border: 2px solid #000;
            padding: 10px;
            border-radius: 10px;
            background-color: #;
            width: 50%;
            list-style-type: none;">';
            foreach ($_SESSION['cart_list'] as $pizza) {
                echo '<li style="font-size:200%;text-align:left;">';
                echo $pizza['Name'] . ' | ' . $pizza['Cost'] . ' руб.    ';
                echo '<a href="korzina.php?delete_id=' . $pizza['idPizza'] . '" style="text-decoration: none;color:black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Х</a>';
                echo '</li>';
                
                $totalCost += $pizza['price'];
            }
            echo '</ul>';
            
            if(isset($_SESSION['cart_list']) && !empty($_SESSION['cart_list'])) {

                echo '<a href="korzina.php?clear_cart=true" 
                style="border: solid #723d25;width: 100%;background: #9c5912;color: wheat;font-size: 210%;text-decoration: none;"
                >Удалить все товары</a></BR>';
            }
            echo '</br><a href="Order.php" 
            style="border: solid #723d25;width: 100%;background: #9c5912;color: wheat;font-size: 210%;text-decoration: none;margin:10%"
            >Оформить заказ</a></BR>';
            
        } ?>
    <div class="cost">
    

        <center><div class="dalee" ></br><a href="PizzeriaMain.php"
        style="border: solid #723d25;width: 100%;background: #9c5912;color: wheat;font-size: 210%;text-decoration: none;">Продолжить покупки</a></div>
        </div>    </div></center>

    </body>
</html>
