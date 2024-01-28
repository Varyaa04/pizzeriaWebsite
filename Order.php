<?php 
session_start();

include 'connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $mobile = $_POST['Mobile'];
    $address = $_POST['Address'];
    $dateOrders = date("Y-m-d H:i:s");
    $option = $_POST['opinion'];
    $orderDetails = "";
    if (isset($_SESSION['cart_list'])) {
        foreach ($_SESSION['cart_list'] as $pizza) {
            $orderDetails .= $pizza['Name'] . " | " . $pizza['Cost'] . " руб., ";
        }
    }

    $sql = "INSERT INTO Orders (NameClient, Address, Phone, OrderUser, DateOrder,PaymentMethod) VALUES ('$name', '$address', '$mobile', '$orderDetails','$dateOrders','$option')";
    
}

$totalCost = 0;
if (isset($_SESSION['cart_list'])) {
  foreach ($_SESSION['cart_list'] as $course) {
    $totalCost += $course['Cost'];
  }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
 <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
  <link rel="stylesheet" href="../css/OrderCSS.css">
  <link rel="stylesheet" href="css/dropCSS.css">
  <script src="js/drop.js"></script>
 <title>Заказ</title>
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

     <div class="header" style="font-family: Oblako;"><h1>Заказ</h1></div>
</div>

<p>
<?php if(isset($_SESSION['cart_list'])){
            $totalCost = 0;
            foreach ($_SESSION['cart_list'] as $course) {
                $totalCost += $course['Cost'];
            }
            if($totalCost != 0){
                echo "<a href='Korzina.php'  style='font-size: 150%;text-decoration: none; background-color: #9c5912;padding: 0.2%;
                color: white;
                cursor: pointer;
                border-radius: 10px;'>Изменить заказ</a>";

            }
            
        } 
    ?>
   </p>
<?php
if ($induction->query($sql) === TRUE) 
{
    unset($_SESSION['cart_list']);
    ?><p>
    <a href='PizzeriaMain.php' style='text-decoration: none;font-size: 150%;color: #321a08;border: solid #723d25;border-radius: 20px;width: 100%;background: #9c5912;color: wheat;'>Вернуться на главную</a>
   </p><?php
}
 
 if(isset($_SESSION['cart_list']))
 {
    
   if($totalCost != 0){
     echo "<center><h2 style='font-size:250%'>ИТОГО: $totalCost руб.</h2></center>";
    }
     else{
         echo "<center><p style='font-size:400%'>Ваша корзина пуста </p>";
        
    }
 } else {
            echo "<center><p style='font-size:400%'>Ваш заказ принят</p>";
        
        }
        ?>

<div class="goods">
<?php
if ( isset($_GET['Name']) ) : ?>
   <p>Ваш заказ: <?php echo $_GET['Name']; ?></p>
  <?php elseif ( isset($_SESSION['cart_list']) ) : ?>
   <center><ul style="font-size:200%;
            padding: 10px;
            border-radius: 10px;
            width: 50%;
            list-style-type: none;
            margin-top:-2%">
    <?php foreach( $_SESSION['cart_list'] as $course ) : ?>

     <li><?php echo $course['Name']; ?>  <?php echo $course['Cost']; ?> руб.</li>
    <?php endforeach; ?>    </center>

   </ul>

</div>
   
  <?php endif;?>
  <div class="formCreate">
  <form method="POST">
    <input type="text" name="Name" placeholder="Ваше имя" required autocomplete="off">
    <input type="text" name="Mobile"  placeholder="Номер телефона" id="phone" required autocomplete="off">
    <input type="text" name="Address" placeholder="Адрес доставки" required autocomplete="off">
    <select aria-placeholder="Выберите способ оплаты" name="optiion" >
        <option>Наличными</option>
        <option>Картой курьеру</option>
      </select>
    <input type="submit" value="Заказать" name="submit">
 </form>
 <script>
$(function($){
      $('[name="phone"]').mask("+7(999) 999-9999");
    });
</script>

</body>
</html>