<?php
    $database = "biddingsystem";
    $password = "";
    $username = "root";
    $servername = "localhost";
    $_SESSION['sellerId'] = 0;
    $link = mysqli_connect($servername, $username, $password, $database);
    if($link == false){
        die ("ERROR: Could not connect " . mysqli_connect_error());
    }
?>