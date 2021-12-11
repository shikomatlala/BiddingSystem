<?php
    session_start();
    $database = "biddingsystem";
    // $password = "l79fIrV%@18E";
    $password = "";
    $username = "root";
    $servername = "localhost";

    //CREATE SESSION VARIABLES
    $link = mysqli_connect($servername, $username, $password, $database);
    if($link == false){
        die ("ERROR: Could not connect " . mysqli_connect_error());
    }
    //One of the things that we can do is to make sure that we create a script that purely hold functions -- but the issue is that we have a lot of moving parts.
    $url = $_SERVER['REQUEST_URI'];

    //index location
    $js_file = "";
    $css_file = "";
    $ico_file = "";
    //loop through the slashes
    $y = 0;
    for($x = 0; $x < strlen($url); $x++){ 
        //now display all the slashes
        //Now the goal is to cut the first two slashes
        if($url[$x] === "/"){
            $y++;
            if($y >= 4){
                $js_file .= ".." .  $url[$x];
                $css_file .= ".." . $url[$x];
                $ico_file .= ".." . $url[$x];
            }
        }
    }
    $js_file .= "javascript/index.js";  
    $css_file .= "style/index.css";
    $ico_file .= "media/icon/index.png";
    // echo $js_file . "<br>";
    // echo $css_file;
    $out = "<!DOCTYPE html>\n<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\">";
    $out .= "
    <head>
        <meta charset=\"utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <link rel=\"icon\" href=\"$ico_file\" type =\"image/png/x-icon\">
        <link rel=\"stylesheet\" href=\"$css_file\" />
        <title>Bidding System</title>
        <meta charset=\"UTF-8\" />
    </head>
    <body>
        <script src=\"$js_file\"></script>
";
    echo $out;


?>