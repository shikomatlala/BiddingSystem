<?php
    include_once "../../../config/connect.php";
    $password = $_SESSION['password'];
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM `user` WHERE `password`=\"$password\" AND `email`=\"$email\"";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $_SESSION['fName'] = $row['fName'];
            $_SESSION['lName'] = $row['lName'];
            $_SESSION['idNumber'] = $row['idNumber'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['cAddress'] = $row['cAddress'];
        }   
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <ul>
        <li><a href="updateuser.php">My Account</a><br></li>
        <li><a href="../userdashboard.php">Dashboard</a><br></li>
    </ul>

    <h1>Update Your Information</h1>
    <p>Enter the following details below to begin</p>
    <br>

    <form action="" method="POST">
        <label name="lblFName" id="lblFname" class="" for="fName">First Name</label>
        <input type="text" id="fName" name="fName" class="" <?php include_once "../../../config/connect.php";
                                                            $fName = $_SESSION['fName'];
                                                            echo "value=\"$fName\"";?> placeholder="First Name" required >
        <br><br>
        <label name="lblLName" id="lblLName" class="" for="lName">Last Name</label>
        <input type="text" id="lName" name="lName" class="" <?php include_once "../../../config/connect.php";
                                                            $lName = $_SESSION['lName'];
                                                            echo "value=\"$lName\"";?> placeholder="Last Name" required >
        <br><br>
        <label name="lblIdNumber" id="lblIdNumber" class="" for="idNumber">ID Number</label>
        <input type="text" id="idNumber" readonly name="idNumber" class="" <?php include_once "../../../config/connect.php";
                                                            $idNumber = $_SESSION['idNumber'];
                                                            echo "value=\"$idNumber\"";?> placeholder="ID Number" required >
        <br><br>
        <label name="lblPhone" id="lblPhone" class="" for="phone">Phone</label>
        <input type="text" id="phone" name="phone" class="" <?php include_once "../../../config/connect.php";
                                                            $phone = $_SESSION['phone'];
                                                            echo "value=\"$phone\"";?> placeholder="e.g 078 980 0909" required >
        <br><br>
        <label name="lblEmail" id="lblEmail" class="" for="email">Email</label>
        <input type="text" id="email" name="email" class="" <?php include_once "../../../config/connect.php";
                                                            $email = $_SESSION['email'];
                                                            echo "value=\"$email\"";?> placeholder="Email Address" required >
        <br><br>
        <label name="lblPassword1" id="lblPassword1" class="" for="password1">Enter Password</label>
        <input type="password" id="password" name="password" class="" <?php include_once "../../../config/connect.php";
                                                            $password = $_SESSION['password'];
                                                            echo "value=\"$password\"";?> placeholder="Password" required >
        <br><br>

        <label name="lblPassword2" id="lblPassword2" class="" for="password2">Confirm Password</label>
        <input type="password" id="password2" name="password2" class="" <?php include_once "../../../config/connect.php";
                                                            $password = $_SESSION['password'];
                                                            echo "value=\"$password\"";?> placeholder="Password" required >
        <br><br>
        <label name="lblAddress" id="lblAddress" class="" for="address">Address</label>

        <input type="text" id="address" name="cAddress" class="" <?php include_once "../../../config/connect.php";
                                                            $address = $_SESSION['cAddress'];
                                                            echo "value=\"$address\"";?>placeholder="Address" required >
        <br><br>
        <input type="submit" name="updateUserDetails" value="Update">
    </form>





<?php

    if(isset($_POST['updateUserDetails']))
    {
        $fname = $_POST['fName'];
        $lname = $_POST['lName'];
        $idNumber = $_POST['idNumber'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['cAddress'];
        $sql = "UPDATE `user` SET `fName`=\"$fname\" , `lName`=\"$lname\" 
        , `phone`=\"$phone\" , `email`=\"$email\" , `password`=\"$password\" , `cAddress`=\"$address\"
        WHERE `idNumber`=\"$idNumber\"";
        if(mysqli_query($link, $sql))
        {
            echo "<h3>Use Successfully Updated</h3>";
        }else
        {
            echo "<h3>Error Updating Your Account Please Try Again";
        }
    }
?>

<form action="deleteaccount.php" method="POST">
        <h3>Delete Your Account</h3>
        <input type="submit" name="deleteUser" value="Delete Account">
    </form>
</body>