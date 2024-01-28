<?php

session_start();

if ( !isset($_SESSION['login']) ) {
	header("Location: 404.php");
}

require_once "db.php";

  
  if (isset($_POST['submit'])) {
	$us = $_POST['user'];
	$log = $_POST['login'];
	$pas = $_POST['password'];
	$em = $_POST['email'];
	$rol = $_POST['rol'];

	$connection = mysqli_connect('localhost', 'root', '', 'pizzeria');
  
	if (!$connection) {
	  die("Ошибка подключения: " . mysqli_connect_error());
	}
  
	$us = mysqli_real_escape_string($connection, $us);
	$log = mysqli_real_escape_string($connection, $log);
	$pas = mysqli_real_escape_string($connection, $pas);
	$em = mysqli_real_escape_string($connection, $em);

	if($rol == "Администратор")
	{
		$query = "INSERT INTO users (username,Login, Password, Email, Role) VALUES ('$us', '$log','$pas', '$em', 1)";
		if (mysqli_query($connection, $query)) {
			header('Location: Admin.php'); 		
			?> <script>alert('Новый администратор успешно добавлен!')</script><?php


			} else {
		  die("Ошибка создания записи: " . mysqli_error($connection));
		}
	}
	elseif($rol == "Редактор"){
		$query = "INSERT INTO users (username,Login, Password, Email, Role) VALUES ('$us', '$log','$pas', '$em', 3)";
		if (mysqli_query($connection, $query)) {
			?> <script>alert('Новый редактор успешно добавлен!')</script><?php
			header('Location: Admin.php'); 		

			} else {
		  die("Ошибка создания записи: " . mysqli_error($connection));
		}
	}
	else{
		$query = "INSERT INTO users (username,Login, Password, Email, Role) VALUES ('$us', '$log','$pas', '$em', 2)";
		if (mysqli_query($connection, $query)) {
			?> <script>alert('Новый пользователь успешно добавлен!')</script><?php
			header('Location: Admin.php'); 		
		} else {
		  die("Ошибка создания записи: " . mysqli_error($connection));
		}
	}
  
	
  
	mysqli_close($connection);
  }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
	<link rel="stylesheet" href="../css/Createcss.css">
	<title>Добавление</title>
</head>
<body>
<div class="grid">
	<div class="main"><button class="mainb" onclick="document.location='Admin.php'">Вернуться обратно</button></div>
	<div class="header" ><h1>Добавление</h1></div>
</div>
<div class="formCreate">
	<label>Добавление пользователя</label>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
	<input name="user" type="text" placeholder="Имя" required autocomplete="off">
	<input name="login" type="text" placeholder="Логин" required autocomplete="off">
	<input name="password" type="text" placeholder="Пароль" required autocomplete="off">
	<input name="email" type="email" placeholder="Email" required autocomplete="off"></br>
	<select aria-placeholder="Выберите способ оплаты" name="rol" >
        <option >Пользователь</option>
		<option >Редактор</option>      
		<option >Администратор</option>
      </select>
	<input name="submit" type="submit" value="Зарегистрировать" onclick="myalert()">
	</form>
</div>
<script>
    </script>
    </body>
</html>