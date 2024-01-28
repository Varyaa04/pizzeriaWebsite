<?php

    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "pizzeria"; 
 
    $induction = mysqli_connect($servername, $username, $password, $dbname);

    if($induction == false){
        echo "Ошибка подключения! <br>";
        echo mysqli_connect_error();
    exit();
    }
?>