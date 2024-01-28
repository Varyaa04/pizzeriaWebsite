<?php
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
      'idPizza' => $idPizza,
      'composition' => $current_added_pizza['composition'],
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="css/oneCart.css">
    <link rel="stylesheet" href="css/dropCSS.css">
    <script src="js/drop.js"></script>
    <title>Пицца</title>
</head>
<body onclick="myFunction1()">
<div class="overlay"></div>
    <div class="grid">
      
      <div class="menu">
        <button onclick="myFunction()" class="dropbtn">Меню</button>
        <div id="myDropdown" class="dropdown-content">
          <button onclick="document.location='PizzeriaFirst.php'" class="buttonDropbox"><span class="menu1">Главное меню</span></button></br>
          <button onclick="document.location='PizzeriaSborka.php'" class="buttonDropbox"><span class="menu1">Собрать пиццу</span></button></br>
          <button onclick="document.location='login.php'" class="buttonDropbox"><span class="menu1">Войти в аккаунт</span></button></br>
          <button onclick="document.location='PizzeriaMain.php'" class="buttonDropbox"><span class="menu1">Готовые пиццы</span></button>
          <button onclick="document.location='ContactInf.php'" class="buttonDropbox"><span class="menu1">Контактная информация</span></button>
          <?php if ( isset($_SESSION['login']) ) : ?>
          <button onclick="document.location='Admin.php'" class="buttonDropbox"><span class="menu1">Страница админа</span></button></br>	<?php endif; ?>  
        </div>
      </div>
      <div class="korzina"><button class="korzina" onclick="document.location='Korzina.php'">Корзина</button></div>
    </div>
  <div class="pizza">
  <script> 
        $(document).ready(function () { 
        $(".Add").on("click", function (){ 
            var productId = $(this).data("id"); 
            <?php 
                $servername = "localhost";  
                $username = "root";  
                $password = "";  
                $dbname = "pizzeria"; 
                         
        $mysqli = new mysqli($servername, $username, $password, $dbname); 
    $query = "set names utf8"; 
    $mysqli->query($query); 
                $productId = isset($_GET['idPizza']) ? $_GET['idPizza'] : null; 
       $query = "insert into Basket (User_id, Count_product, Product_id) VALUES (1, 1, $productId)"; 
    $results = $mysqli->query($query); 
    echo 'Товар успешно добавлен в корзину'; 
            ?> 
        }) 
    }) 
    </script>
    <?php 
     if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) != 0) { 
      foreach ($_SESSION['cart_list'] as $pizza) {?>
     <div class="imagePizza"><?php 
      echo "<input type='hidden' name='id' value='" . $row["id"] . "' />";
      echo "<img src='image/pizza/" . $pizza["Image"] . "' height=20% width=20% alt=''"?></image>    
    </div>
    <div class="namePizza">
    <?php
    echo "<h2>".$pizza['Name']."</h2>"
    ?>
    </div>
    <div class="costPizza">
    <?php
    echo "<h2>".$pizza['Cost']."</h2>"
    ?>
    </div>
    <div class="DescriptionPizza">
    <?php
    echo "<h2>".$pizza['composition']."</h2>"
    ?>
    </div>
    <div class="inKorzina">
    <?php
    echo '<button class="Add"><b>В корзину<b></button>'
    ?>
    </div>
      <?php
          
      }
    }?>
  </div>

</body>
</html>