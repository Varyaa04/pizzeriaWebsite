<?php

session_start();

if ( !isset($_SESSION['login']) ) {
	header("Location: 404.php");
}

include "db.php";

$id = $_GET['id'];


if ( isset($_GET['id']) && !empty($_GET['id']) ) {
	$current_course_id = mysqli_real_escape_string($connection, $_GET['id']);

	$query = "SELECT * FROM Pizza WHERE idPizza=" . $current_course_id;
	$req = mysqli_query($connection, $query);
	$course_data = mysqli_fetch_assoc($req);

	if (empty($course_data)) {
		header("Location: 404.php");
	}
}

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($connection, $_GET['idPizza']);
    $title = $_POST['title'];
    $composition = $_POST['composition'];
    $price = $_POST['price'];

    $query = "UPDATE Pizza SET Name = '{$title}', composition = '{$composition}', Cost = '{$price}' WHERE idPizza = {$id}";

    if (mysqli_query($connection, $query)) {
        header("Location: PizzeriaMain.php");
        exit();
    } else {
        die("Ошибка при изменении данных: " . mysqli_error($connection));
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="Website Icon" type="png" href="image/pizza/icon.PNG">
	<link rel="stylesheet" href="../css/CssEdit.css">
	<title>Редактирование</title>
</head>
<body>
<div class="grid">
	<div class="main"><button class="mainb" onclick="document.location='PizzeriaMain.php'">Вернуться обратно</button></div>
	<div class="header" style="font-family: Oblako;"><h1>Редактирование</h1></div>
</div>
<div class="formCreate">
	<form action="<?php echo $_SERVER['PHP_SELF'];?>?idPizza=<?php echo isset($course_data) ? $course_data['idPizza'] : ""; ?>" method="post">
		<input name="title" type="text" placeholder="Наименование" required 
		value="<?php echo isset($course_data) ? $course_data['Name'] : ""; ?>">

		<textarea name="composition"  required >
		<?php echo isset($course_data) ? $course_data['composition'] : ""; ?>
		</textarea>

		<input name="price" type="text" placeholder="Цена" pattern="[0-9]+" autocomplete = off required 
		value="<?php echo isset($course_data) ? $course_data['Cost'] : ""; ?>">

		<input name="submit" type="submit" value="Изменить">
	</form>
</div>	
</body>
</html>