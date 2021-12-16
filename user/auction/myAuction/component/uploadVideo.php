<?php
    include_once "../../../../config/connect.php";
    if(isset($_POST['submitVideo']))
    {
        $targetDir = "../video/";
        $stockId = $_POST['auctionID'];
        $fileName = $_FILES["uploadVideo"]["name"];
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES["uploadVideo"]["tmp_name"], $targetFile)){
        // echo "The file ". htmlspecialchars( basename( $_FILES["uploadVideo"]["name"])). " has been uploaded.";
            //Insert The Create a record for the video which has been uploaded
            $sql = "INSERT INTO `livestockvideo` (`locationstring`, `stockId`) VALUES ('$fileName', '$stockId')";
            if(mysqli_query($link, $sql))
            {
                header("Location: ../index.php");
            }
            else
            {
                $sql;
                echo "Sorry, There was an error recording your file";
            }
  
        } 
        else 
        {

            echo "Sorry, there was an error uploading your file.";
        }
    }
