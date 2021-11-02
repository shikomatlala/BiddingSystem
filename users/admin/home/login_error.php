<?php
include_once "../../../connect.php";
echo header_html_("../../../style.css");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Portal</title>
  </head>
  <body>
      <h1>WELCOME TO ADMIN PORTAL</h1>
      <h2>Try again</h2>
      <!--<p>Your username is your staff number:  <?php //echo " '". $_SESSION["staff_number"] . "'"?> <br>Your password is the new password which you have created</p>-->
      <form class="form_admin_portal" action="confirm_admin_user.php" method="post">
        <label for="username">Username:</label><br>
        <input class="input_" type="text" id="username" name="username"><br><br>

        <label for="username">Password:</label><br>
        <input class="input_" type="password" id="password" name="password"><br><br>

        <input class="submit_button" type="submit" value="Submit"><br><br>
      </form>
      <a href="admin_portal.php">back</a>
  </body>
</html>
