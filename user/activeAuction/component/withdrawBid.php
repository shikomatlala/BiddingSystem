<?php
    include_once "../../../config/connect.php";
    if(isset($_POST['withdrawBid'])){
        //Show the user their values.
        // $t=time();
        // $bidTime = date("Y-m-d") . $t;
        $message = "Bid placed Successfully";
        $stockId = $_POST['stockId'];
        $buyerId = $_SESSION['buyerId'];
        $amount = $_POST['inputBidPrice'];
        $sql = "DELETE FROM `bid` WHERE `bid`.`bidId` = 2";
        if(mysqli_query($link, $sql))
        {
            echo "<script type='text/javascript'>alert('$message'); </script>";
            header("Location: ../index.php");
        }  
        else
        {
            echo "<script type='text/javascript'>alert('Error Placing Bid'); </script>";
            header("Location: ../index.php");
        }      

    }