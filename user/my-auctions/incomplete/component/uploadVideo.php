<?php
	include_once "../../../../config/connect.php";
	//echo "We are here";

	if(isset($_POST['submitVideo']))
	{	
		ini_set('post_max_size', '64M');
		ini_set('upload_max_filesize', '64M');
		$stockId = $_POST['auctionID'];
		// $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
		$allowedExts = array("mp4");
		$fileName = $stockId . "-" . $_FILES['file']['name'];
		echo $fileName . "<br>";
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		echo $extension . "<br>";

		//if (($_FILES["file"]["type"] == "video/mp4") && ($_FILES["file"]["size"] < 9000000000) && in_array($extension, $allowedExts))
		if (($_FILES["file"]["type"] == "video/mp4") && ($_FILES["file"]["size"] < 9000000000) && in_array($extension, $allowedExts))
		{
		  //echo "File is Good";
		  if ($_FILES["file"]["error"] > 0)
		  {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		  }
		  else
		  {	
			echo "Upload: " . $fileName . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />	";

			if(file_exists("../../active/video/" . $fileName))
			{
			  echo $fileName . " already exists. ";
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
						header("Location: ../index.php");
					}
			   } 
				move_uploaded_file($_FILES["file"]["tmp_name"],"../../active/video/" . $fileName);
				//echo "Stored in: " . "../video/" . $_FILES["file"]["name"];
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
<!-- 
|| 
		($_FILES["file"]["type"] == "audio/mp3") || 
		($_FILES["file"]["type"] == "audio/wma") || 
		($_FILES["file"]["type"] == "image/pjpeg") || 
		($_FILES["file"]["type"] == "image/gif") || 
		($_FILES["file"]["type"] == "image/jpeg") -->