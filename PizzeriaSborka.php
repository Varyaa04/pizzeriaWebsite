<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
    <link rel="stylesheet" href="css/SborkaCSS.css">
    <script src="js/pizzeriafirst.js"></script>
    <title>Сборка пиццы</title>
</head>
<body onclick="myFunction1()">
  <div class="overlay"></div>
<div class="grid">

  <div class="menu">
    <button onclick="myFunction()" class="dropbtn">Меню</button>
    <div id="myDropdown" class="dropdown-content">
      <button onclick="document.location='PizzeriaFirst.php'" class="buttonDropbox"><span>Главное меню</span></button></br>
      <button onclick="document.location='PizzeriaMain.php'" class="buttonDropbox"><span>Готовые пиццы</span></button></br>
      <button onclick="document.location='login.php'" class="buttonDropbox"><span>Войти в аккаунт</span></button></br>
      <button onclick="document.location='ContactInf.php'" class="buttonDropbox"><span>Контактная информация</span></button></br>
      <?php session_start();
      if ( isset($_SESSION['login']) ) : ?>
      <button onclick="document.location='Admin.php'" class="buttonDropbox"><span class="menu1">Страница админа</span></button></br>	<?php endif; ?>  
    </div>
  </div>

    <div class="header" style="font-family: Oblako;"><h1>Собери</h1> <h1>свою</br>пиццу</h1></div>
    <div class="korzina"><button class="korzina" onclick="document.location='Korzina.php'">Корзина</button></div>
    <div class="nachinka"><img src="image/pizza/dough.PNG" width="63%" height="1000%" style="z-index: 1;"></div>
    <label class="vubor1">

        <input id="sauce" type="checkbox" onclick="addSauce()" value="10">
        соус
    </label>
        <div class="nachinka"><img id="sauceimg" src="image/pizza/sauce.PNG" width="62%" height="1000%" style="z-index: 2;"></div>
    
    <label class="vubor2">
        <input id="cheese" type="checkbox" onclick="addCheese()" value="45">
    сыр
    </label>
        <div class="nachinka"><img id="cheeseimg" src="image/pizza/cheese.PNG" width="62%" height="1000%" style="z-index: 3;"></div>
  </br>
  <label class="vubor3">
    <input id="sausage" type="checkbox" onclick="addSausage()" value="50">
колбаса
</label>
    <div class="nachinka"><img id="sausageimg" src="image/pizza/sosiski.PNG" width="62%" height="1000%" style="z-index: 4;"></div>

    <label class="vubor4">
        <input id="bacon" type="checkbox" onclick="addBacon()" value="50">
    бекон
    </label>
       <div class="nachinka"> <img id="baconimg" src="image/pizza/bacon.PNG" width="62%" height="1000%" style="z-index: 5;"></div>

       <label class="vubor5">
        <input id="tomato" type="checkbox" onclick="addTomato()" value="15">
    томаты
    </label>
    <div class="nachinka"><img id="tomatoimg" src="image/pizza/tomato.PNG" width="62%" height="1000%" style="z-index: 6;"></div>

    <label class="vubor6">
      <input id="pepper" type="checkbox" onclick="addPepper()" value="25">
  перец
  </label>
      <div class="nachinka"><img id="pepperimg" src="image/pizza/pepper.PNG" width="62%" height="1000%" style="z-index: 7;"></div>
</br>
    <label class="vubor7">
        <input id="mushrooms" type="checkbox" onclick="addMushrooms()" value="20">
    грибы
    </label>
       <div class="nachinka"> <img id="mushroomsimg" src="image/pizza/mushrooms.PNG" width="62%" height="1000%" style="z-index: 8;"></div>
  </br>
    <label class="vubor8">
        <input id="onion" type="checkbox" onclick="addOnion()" value="10">
    лук
    </label>
        <div class="nachinka"><img id="onionimg" src="image/pizza/onion.PNG" width="62%" height="1000%" style="z-index: 9;"></div>

   
    <label class="vubor9">
        <input id="olives" type="checkbox" onclick="addOlives()" value="20" >
    оливки
    </label>
        <div class="nachinka"><img id="olivesimg" src="image/pizza/olives.PNG" width="62%" height="1000%" style="z-index: 10;"></div>
    
        <div class="removeall"><button class="rem" id="remove" onclick="uncheckCheckbox()" ondblclick="addNachinka()">Убрать всё</button></div>
   
    <div class="total" style="font-size: 250%; color: #5c3826;-webkit-text-stroke: 2px;-webkit-text-stroke-color: #5b3c2d;"><p>Итого: <span id="total1">335 </span> руб.</p></div>

      
    <button class="basket" name="submit" onclick="addToCart()" id="addToCartButton" style="margin-top: 10%;">Добавить в корзину</button></div>
 </div>
    </center>


<!-- SCRIPT -->
<script>
document.getElementById('cheese').checked=true;
document.getElementById('sauce').checked=true;
document.getElementById('onion').checked=true;
document.getElementById('mushrooms').checked=true;
document.getElementById('bacon').checked=true;
document.getElementById('pepper').checked=true;
document.getElementById('olives').checked=true;
document.getElementById('sausage').checked=true;
document.getElementById('tomato').checked=true;

var s = document.forms.Sum
function calculateTotal() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        var total = 90;
        for (var i = 0; i < checkboxes.length; i++) {
            total += parseInt(checkboxes[i].value);
        }
        document.getElementById("total1").innerText = total;
    }

    window.onload = function() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener("change", calculateTotal);
        }
    }

    function uncheckCheckbox() {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
        total = 90;
        document.getElementById("total1").innerText = total;
      }
      var button = document.getElementById('remove');
      button.innerHTML = 'Убрать всё';
      button.disabled = true;
        button.innerHTML = 'Добавить всё';
        button.disabled = false;
      addBacon();addCheese();addMushrooms();addOlives();addOnion();addPepper();addSauce();addSausage();addTomato();
      
}

function addToCart() {
  var button = document.getElementById('addToCartButton');
  button.innerHTML = 'Добавлено в корзину';
  button.disabled = true;
  setTimeout(function() {
    button.innerHTML = 'Добавить в корзину';
    button.disabled = false;
  }, 1000);
}


function addNachinka() {
  var button = document.getElementById('remove');
  button.innerHTML = 'Добавить всё';
  button.disabled = true;
    button.innerHTML = 'Убрать всё';
    button.disabled = false;
document.getElementById('cheese').checked=true;
document.getElementById('sauce').checked=true;
document.getElementById('onion').checked=true;
document.getElementById('mushrooms').checked=true;
document.getElementById('bacon').checked=true;
document.getElementById('pepper').checked=true;
document.getElementById('olives').checked=true;
document.getElementById('sausage').checked=true;
document.getElementById('tomato').checked=true;

addBacon();addCheese();addMushrooms();addOlives();addOnion();addPepper();addSauce();addSausage();addTomato();
total = 335;
        document.getElementById("total1").innerText = total;
}



</script>    
</body>
</html>