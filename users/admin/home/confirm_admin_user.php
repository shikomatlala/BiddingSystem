<?php
include "../../../connect.php";
echo header_html_("../../../style.css");

$username = $_POST['username'];
$password = $_POST['password'];
if(isset($_POST['submit']))
{
    //Let us login the user
    //Check if their stud_number and password are imagegammacorrect
    if(isset($username))
    {
      $sql = "SELECT * FROM user WHERE password = '$password' AND email = '$username' ";
      echo $sql;
      $result = mysqli_query($link, $sql);
      if(mysqli_num_rows($result) > 0)
      {

          // include "admin_home.php";
          // header("")
          header("LOCATION: admin_home.php");
          $_SESSION['loginGood'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['email'] = $username;
          //echo $_SESSION['staff_number'];
      }
      else
      {
        //include "login_error.php";
        header("LOCATION: admin_portal.php");
      }
     }
}
else
{
  header("LOCATION: admin_portal.php");
}




 ?>
