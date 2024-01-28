<?php

session_start();

if ( !isset($_SESSION['login']) ) {
	header("Location: 404.php");
}


require_once "db.php";

if (isset($_FILES['photo'])) { 
	$file = $_FILES['photo'];
  
	if ($file['error'] === UPLOAD_ERR_OK) {
	  $filename = $file['name'];
  
	  move_uploaded_file($file['tmp_name'], 'uploads/' . $filename);
	}
  }
  
  if (isset($_POST['submit'])) {
	$title = $_POST['Name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$priceyou = $_POST['priceyou'];
  
	$connection = mysqli_connect('localhost', 'root', '', 'pizzeria');
  
	if (!$connection) {
	  die("Ошибка подключения: " . mysqli_connect_error());
	}
  
	$title = mysqli_real_escape_string($connection, $title);
	$description = mysqli_real_escape_string($connection, $description);
	$price = mysqli_real_escape_string($connection, $price);
	$filename = mysqli_real_escape_string($connection, $filename);
  
	$query = "INSERT INTO Pizza (Name, Cost,CostYourself, Image,composition) VALUES ('$title', '$price','$priceyou', '$filename', '$description')";
  
	if (mysqli_query($connection, $query)) {
	  header("Location: PizzeriaMain.php");
	} else {
	  die("Ошибка создания записи: " . mysqli_error($connection));
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
	<div class="header" style="font-family: Oblako;"><h1>Добавление</h1></div>
</div>
<div class="formCreate">
	<label style="margin-left:30%">Добавление пиццы</label>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
	<input name="title" type="text" placeholder="Наименование" required>
	<textarea name="description" placeholder="Состав" required></textarea>
	<input name="price" type="text" pattern="[0-9]+" placeholder="Цена (цифры от 1 до 0)"autocomplete="off" required>
	<input name="priceyou" type="text" pattern="[0-9]+" placeholder="Себестоимость (цифры от 1 до 0)"autocomplete="off" required>
	<input type="file" name="photo"  >
	<input name="submit" type="submit" value="Добавить">
	</form>
</div>
</body>
</html>