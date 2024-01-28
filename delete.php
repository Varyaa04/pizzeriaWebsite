<?php
session_start();
include "db.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
  
	// Запрос на удаление товара из базы данных
	$sql = "DELETE FROM Pizza WHERE idPizza = $id";
  
	// Выполнение запроса
	if (mysqli_query($connection, $sql)) {
	  // Успешное удаление товара
	  header("Location: PizzeriaMain.php");
	  ?> <script> alert("Товар успешно удален!")</script><?php
	} else {
	  // Ошибка при удалении товара
	  echo "Ошибка при удалении товара: " . mysqli_error($connection);
	}
  } else {
	// Параметр id не был отправлен
	echo "Не удалось получить идентификатор товара.";
  }


?>