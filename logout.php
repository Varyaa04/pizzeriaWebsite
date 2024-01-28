<?php

session_start();

if ( isset($_SESSION['login']) ) {
	unset($_SESSION['login']);
	header("Location: PizzeriaMain.php");
}
if ( isset($_SESSION['user']) ) {
	unset($_SESSION['user']);
	header("Location: PizzeriaMain.php");
}
if ( isset($_SESSION['redactor']) ) {
	unset($_SESSION['redactor']);
	header("Location: PizzeriaMain.php");
}
?> 