<?php
    include_once "../component/navbar.php";
    include_once "../../config/connect.php";
    session_destroy();
    header("Location: ../../");
?>