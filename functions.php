<?php
require_once "connection.php";

function get_pizza_by_id( $id ){
	global $induction;

	$query = "SELECT * FROM Pizza WHERE idPizza=" . $id;
	$req = mysqli_query($induction, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp; 
}