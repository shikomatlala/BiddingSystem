<?php
    function createuser($action, $submitname)
    {
        $createuser = "
        <form action=\"$action\"method=\"POST\">
            <label name=\"lblFName\"id=\"lblFname\"class=\"\"for=\"fName\">First Name</label>
            <input type=\"text\"id=\"fName\"name=\"fName\"class=\"\"placeholder=\"First Name\"quired>
            <br>   <br>
            <label name=\"lblLName\"id=\"lblLName\"class=\"\"for=\"lName\">Last Name</label>
            <input type=\"text\"id=\"lName\"name=\"lName\"class=\"\"placeholder=\"Last Name\"required >
            <br>   <br>
            <label name=\"lblIdNumber\"id=\"lblIdNumber\"class=\"\"for=\"idNumber\">ID Number</label>
            <input type=\"text\"id=\"idNumber\"name=\"idNumber\"class=\"\"placeholder=\"ID Number\"required >
            <br>   <br>
            <label name=\"lblPhone\"id=\"lblPhone\"class=\"\"for=\"phone\">Phone</label>
            <input type=\"text\"id=\"phone\"name=\"phone\"class=\"\"placeholder=\"e.g 078 980 0909\"required >
            <br>   <br>
            <label name=\"lblEmail\"id=\"lblEmail\"class=\"\"for=\"email\">Email</label>
            <input type=\"text\"id=\"email\"name=\"email\"class=\"\"placeholder=\"Email Address\"required >
            <br>   <br>
            <label name=\"lblPassword1\"id=\"lblPassword1\"class=\"\"for=\"password1\">Enter Password</label>
            <input type=\"password\"id=\"password\"name=\"password\"class=\"\"placeholder=\"Password\"required >
            <br>   <br>

            <label name=\"lblPassword2\"id=\"lblPassword2\"class=\"\"for=\"password2\">Confirm Password</label>
            <input type=\"password\"id=\"password2\"name=\"password2\"class=\"\"placeholder=\"Password\"required >
            <br>   <br>
            <label name=\"lblAddress\"id=\"lblAddress\"class=\"\"for=\"address\">Address</label>

            <input type=\"text\"id=\"address\"name=\"cAddress\"class=\"\"placeholder=\"Address\"required >
            <br>   <br>
            <input type=\"submit\"name=\"$submitname\"value=\"Submit\">
        </form>";
        return $createuser;
    }




?>