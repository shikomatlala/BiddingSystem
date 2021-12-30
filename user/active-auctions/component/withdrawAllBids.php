<?php
	include_once "../../../config/connect.php";
	if(isset($_POST['withdraw']))
	{
		$message = "Withdrawn Successfully";
		$stockId = $_POST['stockId'];
        $buyerId = $_SESSION['buyerId'];
		$sql = "DELETE FROM `bid` WHERE `bid`.`stockId` = $stockId AND `bid`.`buyerId` = $buyerId";
		if(mysqli_query($link, $sql))
		{
			echo "<script type='text/javascript'>
				alert('$message'); 
				setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); //  seconds 
				</script>";
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('Error Widthrawing From Auction'); 
				setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); // 5 seconds 
				</script>";
		}
			
		
	}