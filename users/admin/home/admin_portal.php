<?php
  include "../../../connect.php";
  echo header_html_("../../../style.css");
?>
    <h1>WELCOME TO THE BIDDING SYSTEM</h1>
    <h2>Sign In</h2>
    <form class="form_admin_portal" action="confirm_admin_user.php" method="post">
      <label for="email">Email:</label><br>
      <input class="input_" type="text" id="username" name="username" required><br><br>

      <label for="password">Password:</label><br>
      <input class="input_" type="password" id="password" name="password" required><br><br>

      <input class="submit_button" type="submit" value="Submit" name="submit"><br><br>
    </form>
    <div class="basic_center">
      <a href="../insertUser/createAdmin.php">New User?</a><br>
    </div>

  </body>
</html>
