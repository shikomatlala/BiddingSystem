<?php
    include_once "../../../config/connect.php";
    if(isset($_POST['submitBid']))
	{
        //Show the user their values.
        // $t=time();
        // $bidTime = date("Y-m-d") . $t;
		//You cannot place bid if you are already the highest bidder
		//Firstly we need find out that you are not the highest bidder
		//Find the highest bidder
		
        $message = "Bid placed Successfully";
        $stockId = $_POST['stockId'];
        $amount = $_POST['inputBidPrice'];
        $endDate = $_POST['endDate'];
		$buyerId = (int)$_SESSION['buyerId'];
		$startingBidAmount = "
			  SELECT IFNULL(
					(SELECT MAX(amount) FROM bid WHERE stockId = $stockId), 
					(SELECT askamount FROM livestock WHERE stockId = $stockId)
				) currentBid";
		
		//NB:: - 
		//There is a problem with this query here, the issue is that it returns values that are not correct, it does not return what we are looking for, so we need to make sure that this query here can return values that we are looking for.
		$highestBidderSql = "
		SELECT MAX(amount) currentBid, buyerId, stockId
			FROM bid
			WHERE stockId = $stockId
			AND amount = (SELECT MAX(amount) FROM bid WHERE stockId = $stockId)
			GROUP BY buyerId, stockId;";
		$highestBidderId  = -1;
		$presentBidAmount = 0;
		$startingBidAmountResult = mysqli_query($link, $startingBidAmount);
		if(mysqli_num_rows($startingBidAmountResult) > 0)
		{
			while($rowBidAmount = mysqli_fetch_assoc($startingBidAmountResult))
			{
				$presentBidAmount = $rowBidAmount['currentBid'];
				//echo $startingBidAmount . "<br>";
				$highestBidderResult = mysqli_query($link, $highestBidderSql);
				//echo $highestBidderSql . "<br>";
				if(mysqli_num_rows($highestBidderResult) > 0)
				{
					while($rowHighestBidder = mysqli_fetch_assoc($highestBidderResult))
					{
						$highestBidderId = $rowHighestBidder['buyerId'];
					}
				}
				//echo "Present Bid Amount " . $rowBidAmount['currentBid'] . "<br>";

			}	
		}
		//echo "<br>" . $startingBidAmount . "<br>";
		//echo $buyerId . " != " . $highestBidderId . "<br>";
		//echo $presentBidAmount  . " < " . $amount . "<br>";
		
		if($buyerId != $highestBidderId)
		{
			//Test if the time is not yet closed.
			//If the time is cloed we need to know that the time is closed.
			//Well we cannot create a session or rather we can push the time with the post form so that we can test ensure that our time is still valid
			date_default_timezone_set('Africa/Johannesburg');
			if($endDate >= date("Y-m-d H:i:s") && $presentBidAmount < $amount )
			{
				// echo $endDate . " | " . date("Y-m-d H:i:s");
				//If the money is less than the current bid
				$sql = "INSERT INTO `bid` (`bidTime`, `amount`, `buyerId`, `stockId`) VALUES (CURRENT_TIMESTAMP(), $amount, $buyerId, $stockId)";
				//echo $sql;
				if(mysqli_query($link, $sql))
				{
					echo "<script type='text/javascript'>
							alert('$message'); 
							setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); //  seconds 
							</script>";	//header("Location: ../index.php");
				}  
				else
				{
					echo "<script type='text/javascript'>
							alert('Error Placing bid'); 
							setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); // 5 seconds 
							</script>";
				} 
			}
			else
			{
				echo "<script type='text/javascript'>
						alert('Invalid Bid Amount'); 
						setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); // 5 seconds 
						</script>";
			}
		}
		else
		{
			echo "<script type='text/javascript'>
				alert('You are already the highest bidder'); 
				setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); // 5 seconds 
				</script>";
		}
		
		
		
    }