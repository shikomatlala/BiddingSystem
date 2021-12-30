<?php
    include_once "../../../config/connect.php";
    include_once "../component/navbar.php";
    if(isset($_POST['deleteaccount'])){
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];
        $sql = "SELECT `userId` FROM `user` WHERE `password`=\"$password\" AND `email`=\"$email\";";//Get the userid
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $userId = $row['userId'];
                $sql = "DELETE FROM `seller` WHERE `userId`=$userId";
                if(mysqli_query($link, $sql)){
                        $sql = "DELETE FROM `buyer` WHERE `userId`=$userId";
                        if(mysqli_query($link, $sql)){
                            $sql = "DELETE FROM `user` WHERE `userId`=$userId";
                            if(mysqli_query($link, $sql)){
                                header("location: ../../../");
                            }
                            else{
                                echo "Error Removing User Account";
                            }
                        }
                        else{
                            echo "Error Removing Buyer Information";
                        }
                }
                else{
                    echo "Error Removing Seller Information";
                }
            }
        }
        else{
            echo "User Not Found<br>";            
        }  
    }
?>

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

    <h2>NB: Upon successful deletion you will be logged out of the system automatically</h2>

    <h2>Are you Sure you want to delete your account?</h2>
    <form action="" method="POST">
    <input  class="deleteButton" type="submit" name="deleteaccount" value="Delete"><br><br>      
    </form>
</body>

