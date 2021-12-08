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