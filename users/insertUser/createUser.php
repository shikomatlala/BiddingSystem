<?php
include_once "../../config/connect.php";
if(isset($_POST['createUser']))
{
    //Get the values of all the elements that we have created
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $idNumber = $_POST['idNumber'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['cAddress'];
    //Set the sever.
    //But if the person has not started an account.
    //We need to read the information 
    $_SESSION['fName'] = $fname;
    $_SESSION['lName'] = $lname;
    $_SESSION['idNumber'] = $idNumber;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['cAddress'] = $address;

    $sql = "INSERT INTO user (`fName`, lName, idNumber, phone, email, `password`, cAddress) 
    VALUES (\"$fname\",\"$lname\",'$idNumber','$phone',\"$email\",\"$password\",\"$address\");";
    if(mysqli_query($link, $sql))
    {
        $sql = "SELECT `userId` FROM `user` WHERE `email`=\"$email\""; //We need to add other users into the system as well
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $userId = $row['userId'];
                $sql = "INSERT INTO `seller` (`userId`) VALUES ($userId)";
                if(mysqli_query($link, $sql))
                {
                    $sql = "INSERT INTO `buyer` (`userId`, `status`) VALUES ($userId, \"G\")";
                    if(mysqli_query($link, $sql))
                    {
                        echo "User Added Successfully";//We can create a pop-up using java script to indicate that the user has successfully logged in
                        header("location: ../../index.php");
                    }
                }
            }
        }
        

    }
    else
    {
        echo "\nThere was an Error\n";
        echo "\n". $sql;


    }
}

?>
