<?php
    include_once "../config/connect.php";
    include_once "../config/component/login.php";
    echo "<h1>Welcome to Biding System</h1>
    <h2>Create your user account</h2>";
    echo createuser("insert.php", "createUser");
    echo "<br><br><a href=\"../\">Login</a>";
?>