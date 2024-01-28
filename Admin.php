<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
	<link rel="stylesheet" href="../css/AdminCSS.css">
    <link rel="stylesheet" href="css/dropCSS.css">
    <script src="js/drop.js"></script>
    <title>Администратор</title>
</head>
<body>
<div class="grid">
    <div class="menu">
        <button onclick="myFunction()" class="dropbtn">Меню</button>
        <div id="myDropdown" class="dropdown-content">
          <button onclick="document.location='PizzeriaMain.php'" class="buttonDropbox"><span class="menu1">Готовые пиццы</span></button>
          <button onclick="document.location='PizzeriaSborka.php'" class="buttonDropbox"><span class="menu1">Собрать пиццу</span></button></br>
         </div>
      </div>

     <div class="header"><h1>Администратор</h1></div>
</div>
    <center>
    <div class='FlexCreate'>
        <div class="create"><button onclick="document.location='createPizza.php'" class="cr">Добавить новую пиццу</button></div><p></p>
        <div class="create" style="margin-left: 3%;"><button onclick="document.location='create.php'"  class="cr" >Добавить нового пользователя</button></div>
    </div>
</center>
</body>
</html>