<?php 
    $url = $_SERVER['REQUEST_URI'];
    $connectFile = "";
    $y = 0;
    for($x = 0; $x < strlen($url); $x++){ 
        if($url[$x] === "/"){
            $y++;
            if($y >= 4){
                $connectFile .= ".." .  $url[$x];
            }
        }
    }
    $connectFile .= "config/connect.php";
    include_once $connectFile;
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $username;
          $sql = "SELECT * FROM `user` WHERE `email` = '$username' AND `password` = '$password'";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION['fName'] = $row['fName'];
                $_SESSION['lName'] = $row['lName'];
                $_SESSION['idNumber'] = $row['idNumber'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['cAddress'] = $row['cAddress'];
            }   
            header("location: home/userdashboard.php");
        }
    }