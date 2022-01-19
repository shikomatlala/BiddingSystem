<?php
    //Our components need to have classes how are we going make sure that these components indeed do have classes?
    //Except if all our elements have classes defined here 
    function login($action, $submitname)
    {
        $login = "
        <form class=\"\" action=\"$action\" method=\"post\">
            <label for=\"email\">Email</label><br>
            <input class=\"inputStyle\" type=\"email\" id=\"username\" name=\"username\" required><br><br>
            <label for=\"password\">Password</label><br>
            <input class=\"inputStyle\" type=\"password\" id=\"password\" name=\"password\" title=\"Eight or more characters\" required><br><br>
            <input class=\"submitButton\" type=\"submit\" value=\"Submit\" name=\"$submitname\"><br><br>
        </form>";
        return $login;
    }

    function createuser($action, $submitname)
    {
        $createuser = "

        <div class=\"card\">
        <br>
        <form action=\"$action\" method=\"POST\">
           
            <label name=\"lblFName\"id=\"lblFname\"class=\"\"for=\"fName\">First Name</label><br>
            <input type=\"text\"id=\"fName\"name=\"fName\"class=\"inputStyle\"placeholder=\"First Name\"quired>
            <br>   <br>
            <label name=\"lblLName\"id=\"lblLName\"class=\"\"for=\"lName\">Last Name</label><br>
            <input type=\"text\"id=\"lName\"name=\"lName\"class=\"inputStyle\"placeholder=\"Last Name\"required >
            <br>   <br>
            <label name=\"lblIdNumber\"id=\"lblIdNumber\"class=\"\"for=\"idNumber\">ID Number</label><br>
            <input type=\"text\"id=\"idNumber\"name=\"idNumber\"class=\"inputStyle\"placeholder=\"ID Number\"required >
            <br>   <br>
            <label name=\"lblPhone\"id=\"lblPhone\"class=\"\"for=\"phone\">Phone</label><br>
            <input type=\"tel\"id=\"phone\"name=\"phone\"class=\"inputStyle\"placeholder=\"e.g 078 980 0909\" pattern=\"[0]{1}[1-9]{2}[0-9]{3}[0-9]{4}\" required >
            <br>   <br>
            <label name=\"lblEmail\"id=\"lblEmail\"class=\"\"for=\"email\">Email</label><br>
            <input type=\"email\"id=\"email\"name=\"email\"class=\"inputStyle\"placeholder=\"Email Address\"  required >
            <br>   <br>
            <label name=\"lblPassword1\"id=\"lblPassword1\"class=\"\"for=\"password1\">Enter Password</label><br>
            <input type=\"password\"id=\"password\"name=\"password\"class=\"inputStyle\"placeholder=\"Password\"  title=\"Eight or more characters\" required >
            <br>   <br>

            <label name=\"lblPassword2\"id=\"lblPassword2\"class=\"\"for=\"password2\">Confirm Password</label><br>
            <input type=\"password\"id=\"password2\"name=\"password2\"class=\"inputStyle\"placeholder=\"Password\" title=\"Eight or more characters\" required >
            <br>   <br>
            <label name=\"lblAddress\"id=\"lblAddress\"class=\"\"for=\"address\">Address</label><br>

            <input type=\"text\"id=\"address\"name=\"cAddress\"class=\"inputStyle\"placeholder=\"Address\"required >
            <br>   <br>
            <input class=\"submitButton\" type=\"submit\"name=\"$submitname\"value=\"Submit\">
        </form>
        <br>
        </div>";
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
        <div class=\"card\">
        <br>
        <form action=\"$action\" method=\"POST\">
            <label name=\"lblFName\"id=\"lblFname\"class=\"\"for=\"fName\">First Name</label><br>
            <input type=\"text\"id=\"fName\"name=\"fName\"class=\"inputStyle\"placeholder=\"First Name\" value=\"$fName\" required>
            <br>   <br>
            <label name=\"lblLName\"id=\"lblLName\"class=\"\"for=\"lName\">Last Name</label><br>
            <input type=\"text\"id=\"lName\"name=\"lName\"class=\"inputStyle\"placeholder=\"Last Name\"value=\"$lName\" required >
            <br>   <br>
            <label name=\"lblIdNumber\"id=\"lblIdNumber\"class=\"\"for=\"idNumber\">ID Number</label><br>
            <input type=\"text\"id=\"idNumber\"name=\"idNumber\"class=\"inputStyle\"placeholder=\"ID Number\"value=\"$idNumber\" required readonly>
            <br>   <br>
            <label name=\"lblPhone\"id=\"lblPhone\"class=\"\"for=\"phone\">Phone</label><br>
            <input type=\"tel\"id=\"phone\"name=\"phone\"class=\"inputStyle\"placeholder=\"e.g 078 980 0909\"value=\"$phone\" pattern=\"[0]{1}[1-9]{2}[0-9]{3}[0-9]{4}\" required >
            <br>   <br>
            <label name=\"lblEmail\"id=\"lblEmail\"class=\"\"for=\"email\">Email</label><br>
            <input type=\"email\"id=\"email\"name=\"email\"class=\"inputStyle\"placeholder=\"Email Address\"value=\"$email\"  required >
            <br>   <br>
            <label name=\"lblPassword1\"id=\"lblPassword1\"class=\"\"for=\"password1\">Enter Password</label><br>
            <input type=\"password\"id=\"password\"name=\"password\"class=\"inputStyle\"placeholder=\"Password\"value=\"$password\"  title=\"Eight or more characters\" required >
            <br>   <br>

            <label name=\"lblPassword2\"id=\"lblPassword2\"class=\"\"for=\"password2\">Confirm Password</label><br>
            <input type=\"password\"id=\"password2\"name=\"password2\"class=\"inputStyle\"placeholder=\"Password\"value=\"$password\" title=\"Eight or more characters\" required >
            <br>   <br>
            <label name=\"lblAddress\"id=\"lblAddress\"class=\"\"for=\"address\">Address</label><br>

            <input type=\"text\"id=\"address\"name=\"cAddress\"class=\"inputStyle\"placeholder=\"Address\"value=\"$address\" required >
            <br>   <br>
            <input class=\"submitButton\" type=\"submit\"name=\"$submitname\"value=\"Submit\">
        </form>
        <br>
        </div>";
        return $udpateuser;


    }
