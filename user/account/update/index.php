<?php    
    include_once "../../../config/connect.php";
    include_once "../../../config/component/login.php";
    include_once "../component/navbar.php";
    echo updateuser("", "update");
    

    if(isset($_POST['update'])){
        $fname = $_POST['fName'];
        $lname = $_POST['lName'];
        $idNumber = $_SESSION['idNumber'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['cAddress'];
        $sql = "UPDATE `user` SET `fName`=\"$fname\", `lName`=\"$lname\", `phone`=\"$phone\", `email`=\"$email\", `password`=\"$password\", `cAddress`=\"$address\" WHERE `idNumber`=\"$idNumber\"";
        if(mysqli_query($link, $sql)){
            $message = "Information Updated Successfully";
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['fName'] = $fname;
            $_SESSION['lName'] = $lname;
            $_SESSION['idNumber'] = $idNumber;
            $_SESSION['phone'] = $phone;
            $_SESSION['cAddress'] = $address;
            echo "<script type='text/javascript'>alert('$message'); </script>";
            header("Refresh: 0; url=http://localhost$url");
        }   
        else{
            echo "<br>Error In Updated Ensure that you entered all values correctly";
        }

    }
?>