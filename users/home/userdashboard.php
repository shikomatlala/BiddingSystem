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
        <li><a href="updateuser/updateuser.php">My Account</a><br></li>
        <li><a href="createauction/createauction.php">Create Auction</a><br></li>
        <li><a href="userdashboard.php">Dashboard</a><br></li>
    </ul>
    <h1>Welcome <?php include_once "../../config/connect.php";
                                                            $fName = $_SESSION['fName'];
                                                            $lName = $_SESSION['lName'];
                                                            echo "$fName | $lName";?> </h1>
</body>