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