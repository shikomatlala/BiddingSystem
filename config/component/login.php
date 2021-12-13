<?php
    //Our components need to have classes how are we going make sure that these components indeed do have classes?
    //Except if all our elements have classes defined here 
    function login($action, $submitname)
    {
        $login = "
        <form class=\"\" action=\"$action\" method=\"post\">
            <label for=\"email\">Email</label><br>
            <input class=\"inputFunction\" type=\"email\" id=\"username\" name=\"username\"  required><br><br>
            <label for=\"password\">Password</label><br>
            <input class=\"inputFunction\" type=\"password\" id=\"password\" name=\"password\" title=\"Eight or more characters\" required><br><br>
            <input class=\"submitButton\" type=\"submit\" value=\"Submit\" name=\"$submitname\"><br><br>
        </form>";
        return $login;
    }

    function createuser($action, $submitname)
    {
        $createuser = "
        <form action=\"$action\" method=\"POST\">
            <label name=\"lblFName\"id=\"lblFname\"class=\"\"for=\"fName\">First Name</label>
            <input type=\"text\"id=\"fName\"name=\"fName\"class=\"\"placeholder=\"First Name\" required>
            <br>   <br>
            <label name=\"lblLName\"id=\"lblLName\"class=\"\"for=\"lName\">Last Name</label>
            <input type=\"text\"id=\"lName\"name=\"lName\"class=\"\"placeholder=\"Last Name\"required >
            <br>   <br>
            <label name=\"lblIdNumber\"id=\"lblIdNumber\"class=\"\"for=\"idNumber\">ID Number</label>
            <input type=\"text\"id=\"idNumber\"name=\"idNumber\"class=\"\"placeholder=\"ID Number\"required >
            <br>   <br>
            <label name=\"lblPhone\"id=\"lblPhone\"class=\"\"for=\"phone\">Phone</label>
            <input type=\"tel\"id=\"phone\"name=\"phone\"class=\"\"placeholder=\"e.g 078 980 0909\" pattern=\"[0]{1}[1-9]{2}[0-9]{3}[0-9]{4}\" required >
            <br>   <br>
            <label name=\"lblEmail\"id=\"lblEmail\"class=\"\"for=\"email\">Email</label>
            <input type=\"email\"id=\"email\"name=\"email\"class=\"\"placeholder=\"Email Address\" required >
            <br>   <br>
            <label name=\"lblPassword1\"id=\"lblPassword1\"class=\"\"for=\"password1\">Enter Password</label>
            <input type=\"password\"id=\"password\"name=\"password\"class=\"\"placeholder=\"Password\"  title=\"Eight or more characters\" required >
            <br>   <br>

            <label name=\"lblPassword2\"id=\"lblPassword2\"class=\"\"for=\"password2\">Confirm Password</label>
            <input type=\"password\"id=\"password2\"name=\"password2\"class=\"\"placeholder=\"Password\" title=\"Eight or more characters\" required >
            <br>   <br>
            <label name=\"lblAddress\"id=\"lblAddress\"class=\"\"for=\"address\">Address</label>

            <input type=\"text\"id=\"address\"name=\"cAddress\"class=\"\"placeholder=\"Address\"required >
            <br>   <br>
            <input type=\"submit\"name=\"$submitname\"value=\"Submit\">
        </form>";
        return $createuser;
    }



    function updateuser($action, $submitname)
    {
        $fName = $_SESSION['fName'];
        $lName = $_SESSION['lName'];
        $idNumber = $_SESSION['idNumber'];
        $phone = $_SESSION['phone'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $address = $_SESSION['cAddress'];
        $udpateuser = "
        <form action=\"$action\" method=\"POST\">
            <label name=\"lblFName\"id=\"lblFname\"class=\"\"for=\"fName\">First Name</label>
            <input type=\"text\"id=\"fName\"name=\"fName\"class=\"\"placeholder=\"First Name\" value=\"$fName\" required>
            <br>   <br>
            <label name=\"lblLName\"id=\"lblLName\"class=\"\"for=\"lName\">Last Name</label>
            <input type=\"text\"id=\"lName\"name=\"lName\"class=\"\"placeholder=\"Last Name\"value=\"$lName\" required >
            <br>   <br>
            <label name=\"lblIdNumber\"id=\"lblIdNumber\"class=\"\"for=\"idNumber\">ID Number</label>
            <input type=\"text\"id=\"idNumber\"name=\"idNumber\"class=\"\"placeholder=\"ID Number\"value=\"$idNumber\" required >
            <br>   <br>
            <label name=\"lblPhone\"id=\"lblPhone\"class=\"\"for=\"phone\">Phone</label>
            <input type=\"tel\"id=\"phone\"name=\"phone\"class=\"\"placeholder=\"e.g 078 980 0909\"value=\"$phone\" pattern=\"[0]{1}[1-9]{2}[0-9]{3}[0-9]{4}\" required >
            <br>   <br>
            <label name=\"lblEmail\"id=\"lblEmail\"class=\"\"for=\"email\">Email</label>
            <input type=\"email\"id=\"email\"name=\"email\"class=\"\"placeholder=\"Email Address\"value=\"$email\" pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$\" required >
            <br>   <br>
            <label name=\"lblPassword1\"id=\"lblPassword1\"class=\"\"for=\"password1\">Enter Password</label>
            <input type=\"password\"id=\"password\"name=\"password\"class=\"\"placeholder=\"Password\"value=\"$password\" pattern=\"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}\" title=\"Eight or more characters\" required >
            <br>   <br>

            <label name=\"lblPassword2\"id=\"lblPassword2\"class=\"\"for=\"password2\">Confirm Password</label>
            <input type=\"password\"id=\"password2\"name=\"password2\"class=\"\"placeholder=\"Password\"value=\"$password\" pattern=\"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}\" title=\"Eight or more characters\" required >
            <br>   <br>
            <label name=\"lblAddress\"id=\"lblAddress\"class=\"\"for=\"address\">Address</label>

            <input type=\"text\"id=\"address\"name=\"cAddress\"class=\"\"placeholder=\"Address\"value=\"$address\" required >
            <br>   <br>
            <input class=\"submitButton\" type=\"submit\"name=\"$submitname\"value=\"Submit\">
        </form>";
        return $udpateuser;


    }

