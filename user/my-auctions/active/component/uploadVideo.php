<?php
	include_once "../../../../config/connect.php";
	echo "We are here";
	if(isset($_POST['submitVideo']))
	{
		$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$fileName= $_FILES['file']['name'];
		$stockId = $_POST['auctionID'];

		if ((($_FILES["file"]["type"] == "video/mp4") || ($_FILES["file"]["type"] == "audio/mp3") || ($_FILES["file"]["type"] == "audio/wma") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 20000000) && in_array($extension, $allowedExts))
		{
			echo "File is Good";
		  if ($_FILES["file"]["error"] > 0)
		  {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		  }
		  else
		  {
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

			if(file_exists("../video/" . $_FILES["file"]["name"]))
			{
			  echo $_FILES["file"]["name"] . " already exists. ";
			}
			else
			{
			   $sql = "INSERT INTO `livestockvideo` (`locationstring`, `stockId`) VALUES ('$fileName', '$stockId')";
			   echo $sql;
			   if(mysqli_query($link, $sql))
			   {
					$update = "UPDATE `livestock` SET `statusId` = 3 WHERE `livestock`.`stockId` = $stockId";
					if(mysqli_query($link, $update))
					{
						//header("Location: ../index.php");
					}
			   } 
				move_uploaded_file($_FILES["file"]["tmp_name"],"../video/" . $_FILES["file"]["name"]);
				echo "Stored in: " . "../video/" . $_FILES["file"]["name"];
				//header("Location: ../index.php");
			  }
			}
		}
		else
		{
		  echo "Invalid file";
		}
	}
	else
	{
		echo "Not set";
	}
?>