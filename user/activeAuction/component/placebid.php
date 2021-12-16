<?php
    include_once "../../../config/connect.php";
    if(isset($_POST['submitBid'])){
        //Show the user their values.
        // $t=time();
        // $bidTime = date("Y-m-d") . $t;
        $message = "Bid placed Successfully";
        $stockId = $_POST['stockId'];
        $buyerId = $_SESSION['buyerId'];
        $amount = $_POST['inputBidPrice'];
        $sql = "INSERT INTO `bid` (`bidTime`, `amount`, `buyerId`, `stockId`) VALUES (CURRENT_TIMESTAMP, $amount, $buyerId, $stockId)";
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