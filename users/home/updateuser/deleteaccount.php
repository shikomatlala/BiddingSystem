<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h1>Delete Your Account!!!</h1>
    <h2>NB: You are about to delete your account Take note of the following</h2>
    <p> - Your bids will be removed from the system</p>
    <p> - Your livestock auctions will be removed</p>
    <p> - You will not be able to retrieve your information again</p>
    <br><br>

    <h2>Are you Sure you want to delete your account?</h2>
    <form action="" method="POST">
    <input type="submit" name="deleteaccount" value="Delete"><br><br>   
    <li><a href="updateuser.php">back</a><br></li>   
    </form>
</body>


<?php
    include_once "../../../config/connect.php";
    if(isset($_POST['deleteaccount'])){
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];
        $sql = "DELETE FROM `user` WHERE `password`=\"$password\" AND `email`=\"$email\";";
        if(mysqli_query($link, $sql)){
            //Go outside
            header("location: ../../../index.php");
        }
    }

?>