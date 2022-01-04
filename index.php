<?php
    include_once "config/connect.php";
    
    include_once "config/component/login.php";
    if(isset($_POST['loginuser']))
    {
        //Ge the users login information
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $username;
        //   $sql = "SELECT * FROM `user`, `seller`, `buyer` WHERE `email` = '$username' AND `password` = '$password'";
        $sql = "SELECT * FROM `user`, `seller`, `buyer`WHERE `email` = \"$username\" AND `password` = '$password' AND `user`.`userId` = `seller`.`userId` AND `user`.`userId` = `buyer`.`userId`";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                date_default_timezone_set('Africa/Johannesburg');
                $_SESSION['fName'] = $row['fName'];
                $_SESSION['lName'] = $row['lName'];
                $_SESSION['idNumber'] = $row['idNumber'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['cAddress'] = $row['cAddress'];
                $_SESSION['sellerId'] = $row['sellerId'];
                $_SESSION['buyerId'] = $row['buyerId'];
                $_SESSION['status'] = $row['status'];
            }   
            header("location: user");
        }
        else{
            $html = "
                <h1>WELCOME TO THE BIDDING SYSTEM</h1>
                <h2>User Not Found</h2>
                <h2>Sign In</h2>" . login("", "loginuser") . "
                <div class=\"\">
                    <a href=\"create\">New User?</a><br>
                </div>
    </body>
</html>";
            echo $html;
        }
    }
    else
    {
        $html = "
        <h1>WELCOME TO THE BIDDING SYSTEM</h1>
        <h2>Sign In</h2>" . login("", "loginuser") . "
        <div class=\"\">
            <a href=\"create\">New User?</a><br>
        </div>
    </body>
</html>";

        echo $html;
    }

?>