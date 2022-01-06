	<?php
    include_once "../../../config/connect.php";
    if(isset($_POST['withdrawBid'])){
        //Show the user their values.
        // $t=time();
        // $bidTime = date("Y-m-d") . $t;
        $message = "Bid cancelled Successfully";
        $stockId = $_POST['stockId'];
        $buyerId = $_SESSION['buyerId'];
		//Here I also need the bidId
		$bidId = $_POST['bidId'];
        $amount = $_POST['inputBidPrice'];
        $sql = "DELETE FROM `bid` WHERE `bid`.`bidId` = $bidId";
		//Now we want to be able to cancel the bid but we should cancel only the latest bid.
		//Or rather the hightst bid, the idea is that we have already lost our previous bids thats why we cannot cancel them.
		//So we need to find the maximum bid first and then work on cancelling them.
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
				alert('Error cancelling Bid'); 
				setTimeout(function (){window.location.href = 'http://biddingsystem.bitnamiapp.com/user/active-auctions';},0); // 5 seconds 
				</script>";
        }      

    }