<?php
    include_once "../../../config/connect.php";
    include_once "../component/navbar.php";
    //include_once "component/updateBids.php";
    // include_once "component/function.php";
    //updateBids($link);
    //Create a way for our person to be able to view all of his auctions - But what is most important is that our user should complete their auction.
    //Create a table for showing our orders -- But one thing that we can do is to allow javascript to handle that part of the create because all that we are looking for is the auction - but yet again we want to insert the video to complete the auction.

    // echo uploadVideo();
    //Create a table where we show all the livestock or rather bids that have been created.
    $sellerId = $_SESSION['sellerId'];
    $buyerId = $_SESSION['buyerId'];
    $sql = "SELECT d.statusId, stockId, sex, livestockName, age, ageType, `weight`, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName
    FROM `livestock` a, `breed` b, `animalType` c, `auctionStatus` d
    WHERE d.statusId = a.statusId
        AND a.breedId = b.breedId
        AND b.typeId = c.typeId
        AND a.statusId = 4
    ORDER BY stockId DESC";
    //Once I have selected all of them I want to create a way of showing what I need to have.

    $countAuctions = "SELECT COUNT(stockId) as countMyAuction FROM `livestock` WHERE sellerId = $sellerId";
    $countResult = mysqli_query($link, $countAuctions);
    $numOfAuctions = 0;
    if(mysqli_num_rows($countResult) > 0){
        while($row = mysqli_fetch_assoc($countResult)){
            $numOfAuctions = (int)$row['countMyAuction'];
        }

    }
    $livestockId = 0;
    $result = mysqli_query($link, $sql);
    // echo $sql;
    
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
            $auctionCard = "";
            $stockId = $row['stockId'];
            $mainDiv = "\n<div id=\"auctionD-$stockId\" class=\"\">";
            $auctionTitle = "\t\t<div id=\"auctionTtlD-$stockId\" class=\"\">";
            $sqlAuctionTimeLeft = "	
			SELECT (CASE 
						WHEN (MINUTE(enddate) - MINUTE(SYSDATE())) < 0 
						THEN (MINUTE(enddate) - MINUTE(SYSDATE()))+60 
						ELSE (MINUTE(enddate) - MINUTE(SYSDATE()))
					END) \"minutesLeft\", DATEDIFF( enddate,SYSDATE()) \"daysLeft\" , 
				  (CASE 
						WHEN (SELECT HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00' FROM `livestock` WHERE stockId = $stockId) >= 0 
						THEN (SELECT HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00' FROM `livestock` WHERE stockId = $stockId) 
						ELSE (SELECT (HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00')*0 FROM `livestock` WHERE stockId = $stockId) 
				  END ) as \"hoursLeft\" 
			FROM `livestock` 
			WHERE stockId = $stockId";
        // echo $sqlAuctionTimeLeft;
            $timeLeftForAuction = "";
            $resultAcutionTimeLeft = mysqli_query($link, $sqlAuctionTimeLeft);
            if(mysqli_num_rows($resultAcutionTimeLeft) > 0){
                while($rowAuctionTimeLeft = mysqli_fetch_assoc($resultAcutionTimeLeft)){
                    $timeLeftForAuction .="Time Left<br>". $rowAuctionTimeLeft['daysLeft'] . " Days | " . $rowAuctionTimeLeft['hoursLeft'] . " Hours | " . $rowAuctionTimeLeft['minutesLeft'] . " Minutes ";
                }
            }
            $auctionInformationDiv = "\t\t<div id=\"auctionInfoD-$stockId\" class=\"\">$timeLeftForAuction</div>";
            $livestockDetailsDiv = "\n\t<div id=\"lStockD-$stockId\" class=\"\">";
            $auctionDetailsDiv = "\t<div id=\"aDetailsD-$stockId\" calss=\"\">";
            $placeBidDiv = "\t\t<div id=\"placeBidD-$stockId\" class=\"\">\n";
            $animalBioDiv = "\t\t<div id=\"animalBio-$stockId\" class=\"\">\n";
            $biddersListDiv = "\t\t<div id=\"biddersListD-$stockId\" class=\"\">";
            $currentBid = "";
            $currentBid2 = 0.0;
            $sqlCurrentBid = "SELECT CONCAT(\"<br><br>Current Bid R\",MAX(amount)) as currentBid, MAX(amount) as currentBid2  FROM `bid` WHERE stockId = $stockId";
            $resultCurrentBid = mysqli_query($link, $sqlCurrentBid);
            if(mysqli_num_rows($resultCurrentBid) > 0){
                while($rowCurrentBid = mysqli_fetch_assoc($resultCurrentBid)){
                    $currentBid = $rowCurrentBid['currentBid'];
                    $currentBid2 = $rowCurrentBid['currentBid2'];
                }
            }
            $livestockName = $row['livestockName'];
            if(empty($row['livestockName'])){
                $livestockName = $row['breedName'];
            }
            //Auction Title
            $auctionTitle .= "<h1>$stockId | $livestockName <br> $currentBid</h1></div>";
            //Livestock Description Table
            $livestockDescriptionTable = "\t\t<div id=\"listockDescTblD-$stockId\" class=\"\">";
            $livestockDescriptionTable .= "\n\t\t\t<table class=\"\">";
            $livestockDescriptionTable .= "\n\t\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th width=\"60\">Auction ID</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Livestock Name</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Livestock Type</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Breed</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Sex</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Weight</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Age</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Age Unit</th>";
            //$livestockDescriptionTable .= "\n\t\t\t\t<th>Bio</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Ask Amount</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Start Date</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>End Date</th>";
            // $livestockDescriptionTable .= "\n\t\t\t<th>Auction Status</th>";
            $livestockDescriptionTable .= "\n\t\t\t</tr>";
            $livestockDescriptionTable .= "\n\t\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['stockId'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['livestockName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['animalTypeName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['breedName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['sex'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['weight'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['age'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['ageType'] . "</td>";
            //$livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['bio'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['askamount'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['startdate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['enddate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t</tr>";
            $livestockDescriptionTable .= "\n\t\t\t</table>";
            $animalBioDiv .= $row['bio'] . "</div>";
            //Check if the video exists and if it does not exist then let user user know such
            //But we also need to know if the auction is active or not.
            $_SESSION['stockId'] = $row['stockId'];
            $stockId = $row['stockId'];
            $checkVideoSql ="SELECT * FROM `livestockvideo` WHERE `stockId` = $stockId";
            $checkVideoResult = mysqli_query($link, $checkVideoSql);
            $statusValue = "";
            $videoName = "";
            $livestockVideo = "\t\t<div id=\"lStockVideoD-$stockId\" class=\"\">";
            if(mysqli_num_rows($checkVideoResult) > 0){
                $statusValue = "Active for Bids";
                //Now we need to know the time that the bid is valid or not
                //If a bid is not longer valid then we need to let the use know that the bid is not loger valid
                //If a bid has not yet started it should be put to a waiting list
                //But for now we want to be able to bid.
                //Create a display to show the video which we have created.
                //Let us start to allow the users to be able to bid
                while($videoRow = mysqli_fetch_assoc($checkVideoResult)){
                    $videoName = "../active/video/" . $videoRow['locationString'];
                    // "<iframe width=\"560\" height=\"315" src="https://www.youtube.com/embed/A2k3ulOJ3u4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>"
                }
                // $myfile = fopen($videoName, "r") or die("Unable to open file!");//Rather that do this I can just open a video
                // echo fgets($myfile);
                // fclose($myfile);
                $livestockVideo .= "<br>\n\t\t\t<video controls>
                <source src=\"$videoName\" type=\"video/mp4\">
                Your browser does not support the video tag.
            </video>
        </div>";
                //$livestockVideo .= "<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/A2k3ulOJ3u4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div>";
            }
            else{
                $livestockVideo = "<br>Auction Incomplete!<br>
                </div>";//Create a button which will be used to insert the video
            }        
            // $auctionCard .= $videoHtml;
            //Show The Active bids for this item.
            //Create somewhere to put the video
            $placeBidDiv .= "\t\t\t<h2>Place Your Bid</h2>\n";//Create a button where we are going to allow the user to place a bid.
            //Firstly we want to know where the user is bidding, once we know where user is bidding we can then place the bid.
            //We need the livestockID.
            //We need to put in the amount first in order for us to bid.
            $endDate = $row['enddate'];
            $buyerId = $_SESSION['buyerId'];
            $placeBidDiv .="\t\t\t<form action=\"component/placebid.php\" method=\"POST\">
                <label for=\"inputBidPrice\" class=\"\">Place your bid here | Enter the amount of money below</label><br>
                <input type=\"text\" placeholder=\"e.g 3999.99\" name=\"inputBidPrice\" id=\"inputBidPrice\" class=\"\" required>
                <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                <input type=\"hidden\" name=\"endDate\" value=\"$endDate\">
                <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                <input type=\"submit\" value=\"Bid\" name=\"submitBid\">\n\t\t\t</form>\n\t\t</div>";
            //Show a list bidders for a given livestock.
            //Show people who have placed their bids on the auction
			//create and sql for the highest  bid 
			$sqlHighestBid = "SELECT MAX(amount) highest FROM bid WHERE stockId = $stockId AND buyerId = $buyerId";
			$resultSqlHighestBid = mysqli_query($link, $sqlHighestBid);
			$highestBidValue = 0.0;
			if(mysqli_num_rows($resultSqlHighestBid) > 0)
			{
				while($rowHighestBidValue = mysqli_fetch_assoc($resultSqlHighestBid))
				{
					$highestBidValue = $rowHighestBidValue['highest'];
				}
			}
			//echo $highestBidValue . " is the Higest Bid Value" . "<br>";
				
            $sqlBids = "SELECT a.bidId, b.buyerId, CONCAT(SUBSTRING(c.fName, 1, 1), \" \", c.lName) as username, CONCAT(\"R\",a.amount) amount, amount amount2,  a.bidtime, bidId
            FROM `bid`a, `buyer` b, `user`c
            WHERE a.buyerId = b.buyerId
            AND c.userId = b.userId
            AND a.stockId = $stockId
            ORDER BY a.bidId DESC";
            //echo "<br>" . $sqlBids . "<br>";
            $biddersTableList = "";

            $resultBids = mysqli_query($link, $sqlBids);
            if(mysqli_num_rows($resultBids)>0){
				//Withdraw all bids
				// $biddersTableList .= "
				// <br>
				// <form action=\"component/withdrawAllBids.php\" method=\"POST\">
				// <label>To withdraw from Auction click the withdraw from auction button</label><br>
				// <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
				// <input class=\"deleteButton\" type=\"submit\" value=\"Withdraw From Auction\" name=\"withdraw\">
				// </form>";
                $biddersTableList .= "\n\t\t<table name=\"biddersList\" class=\"\">";
                $biddersTableList .= "\n\t\t<tr>";
                $biddersTableList .= "\n\t\t\t<th width=\"60\">Buyer ID</th>";
                $biddersTableList .= "\n\t\t\t<th>Buyer Name</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Amount</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Time</th>";
                $biddersTableList .= "\n\t\t\t<th>Cancel</th>";
                $biddersTableList .= "\n\t\t</tr>";
                while($row = mysqli_fetch_assoc($resultBids)){
                    $biddersTableList .= "\n\t\t<tr>";
                    $rowBuyerId = $row['buyerId'];
                    $bidId = $row['bidId'];
                    $biddersTableList .= "\n\t\t\t<td>" .$row['buyerId'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['username'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['amount'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['bidtime'] . "</td>";
                    $withdrawAuctionForm = "";
					//Now want to be strategic about this - we cannot withdraw bids that have been passed or outmatched
                    //echo "The current Bid " . $currentBid . "<br>";
                    if($rowBuyerId == $buyerId && $row['amount2'] >= $highestBidValue && $row['amount2'] == $currentBid2 )
					{
						//echo $rowBuyerId  . " == " .  $buyerId . " &&  " .  $row['amount2'] . " >= "  . $highestBidValue  . "<br>";
                        $withdrawAuctionForm = "<form action=\"component/withdrawBid.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
						<input type=\"hidden\" name=\"bidId\" value=\"$bidId\">
                        <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                        <input class=\"deleteButton\" type=\"submit\" value=\"Cancel\" name=\"withdrawBid\">
                        </form>";
                        $biddersTableList .= "\n\t\t\t<td>" . $withdrawAuctionForm . "</td>";
                    }
                    else{
                        $biddersTableList .= "\n\t\t\t<td></td>";
                    }
                    $biddersTableList .= "\n\t\t</tr>";
                }
                $biddersTableList .= "\n\t\t</table>";
                $biddersListDiv .= $biddersTableList . "\n</div>";
            }
            $livestockDetailsDiv .= "<h1>Your Auctions that are closed</h1><br>\t\t\n" . $auctionTitle . "\n";
            $livestockDetailsDiv .= $auctionInformationDiv . "\n" ;
            $livestockDetailsDiv .= $livestockVideo . "\n";
            $livestockDetailsDiv .= $livestockDescriptionTable . "\n\t\t</div>";
            $livestockDetailsDiv .= $animalBioDiv .  "\n\t</div>";

            //$auctionDetailsDiv .= "\t\t\n" .$placeBidDiv . "\n";
            $auctionDetailsDiv .=  $biddersListDiv . "</div>\n\t</div>";
            $mainDiv .= $livestockDetailsDiv . "\n" . $auctionDetailsDiv . "\n</div>";
            echo $mainDiv . "\n<hr>";
        }
    }
    else{
        echo "<br>No closed auctions found";
    }
    


?>





<!--This is all a comment -->
<!-- <?php




    include_once "../../../config/connect.php";
    include_once "../component/navbar.php";
    //include_once "component/updateBids.php";
    // include_once "component/function.php";
    //updateBids($link);
    //Create a way for our person to be able to view all of his auctions - But what is most important is that our user should complete their auction.
    //Create a table for showing our orders -- But one thing that we can do is to allow javascript to handle that part of the create because all that we are looking for is the auction - but yet again we want to insert the video to complete the auction.

    // echo uploadVideo();
    //Create a table where we show all the livestock or rather bids that have been created.
    $sellerId = $_SESSION['sellerId'];
    $buyerId = $_SESSION['buyerId'];
    $sql = "SELECT d.statusId, stockId, sex, livestockName, age, ageType, `weight`, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName
    FROM `livestock` a, `breed` b, `animalType` c, `auctionStatus` d
    WHERE sellerId = $sellerId
        AND d.statusId = a.statusId
        AND a.breedId = b.breedId
        AND b.typeId = c.typeId
        AND a.statusId = 4
    ORDER BY stockId DESC";
    //Once I have selected all of them I want to create a way of showing what I need to have.

    $countAuctions = "SELECT COUNT(stockId) as countMyAuction FROM `livestock` WHERE sellerId = $sellerId";
    $countResult = mysqli_query($link, $countAuctions);
    $numOfAuctions = 0;
    if(mysqli_num_rows($countResult) > 0){
        while($row = mysqli_fetch_assoc($countResult)){
            $numOfAuctions = (int)$row['countMyAuction'];
        }

    }
    //echo $sql;
    $livestockId = 0;
    $result = mysqli_query($link, $sql);
    // echo $sql;
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
            $auctionCard = "";
            $stockId = $row['stockId'];
            $mainDiv = "\n<div id=\"auctionD-$stockId\" class=\"\">";
            $auctionTitle = "\t\t<div id=\"auctionTtlD-$stockId\" class=\"\">";
            $sqlAuctionTimeLeft = "	
			SELECT (CASE 
						WHEN (MINUTE(enddate) - MINUTE(SYSDATE())) < 0 
						THEN (MINUTE(enddate) - MINUTE(SYSDATE()))+60 
						ELSE (MINUTE(enddate) - MINUTE(SYSDATE()))
					END) \"minutesLeft\", DATEDIFF( enddate,SYSDATE()) \"daysLeft\" , 
				  (CASE 
						WHEN (SELECT HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00' FROM `livestock` WHERE stockId = $stockId) >= 0 
						THEN (SELECT HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00' FROM `livestock` WHERE stockId = $stockId) 
						ELSE (SELECT (HOUR(enddate) - HOUR(SYSDATE()) % '24:00:00')*0 FROM `livestock` WHERE stockId = $stockId) 
				  END ) as \"hoursLeft\" 
			FROM `livestock` 
			WHERE stockId = $stockId";
        // echo $sqlAuctionTimeLeft;
            $timeLeftForAuction = "";
            $resultAcutionTimeLeft = mysqli_query($link, $sqlAuctionTimeLeft);
            if(mysqli_num_rows($resultAcutionTimeLeft) > 0){
                while($rowAuctionTimeLeft = mysqli_fetch_assoc($resultAcutionTimeLeft)){
                    $timeLeftForAuction .="Closed <br>". $rowAuctionTimeLeft['daysLeft'] . " Days | " . $rowAuctionTimeLeft['hoursLeft'] . " Hours | " . $rowAuctionTimeLeft['minutesLeft'] . " Minutes ";
                }
            }
            $auctionInformationDiv = "\t\t<div id=\"auctionInfoD-$stockId\" class=\"\">$timeLeftForAuction</div>";
            $livestockDetailsDiv = "\n\t<div id=\"lStockD-$stockId\" class=\"\">";
            $auctionDetailsDiv = "\t<div id=\"aDetailsD-$stockId\" calss=\"\">";
            $placeBidDiv = "\t\t<div id=\"placeBidD-$stockId\" class=\"\">\n";
            $bidAwardedTo = "\t\t<div id=\"awardedTo-$stockId\" class=\"\">\n";
            $animalBioDiv = "\t\t<div id=\"animalBio-$stockId\" class=\"\">\n";
            $biddersListDiv = "\t\t<div id=\"biddersListD-$stockId\" class=\"\">";
            $currentBid = "";
            $currentBid2 = 0.0;
            $sqlCurrentBid = "SELECT CONCAT(\"<br><br>Current Bid R\",MAX(amount)) as currentBid, MAX(amount) as currentBid2  FROM `bid` WHERE stockId = $stockId";
            $resultCurrentBid = mysqli_query($link, $sqlCurrentBid);
            if(mysqli_num_rows($resultCurrentBid) > 0){
                while($rowCurrentBid = mysqli_fetch_assoc($resultCurrentBid)){
                    $currentBid = $rowCurrentBid['currentBid'];
                    $currentBid2 = $rowCurrentBid['currentBid2'];
                }
            }
            $livestockName = $row['livestockName'];
            if(empty($row['livestockName'])){
                $livestockName = $row['breedName'];
            }
            //Auction Title
            $auctionTitle .= "<h1>$stockId | $livestockName </h1><h2>Closed at R$currentBid2</h2></div>";
            $bidAwardedTo .= "Livestock awarded to<br>";
            //Get the person awarded the bid
            $bidAwarded2Sql = "SELECT a.bidId, b.buyerId, CONCAT(SUBSTRING(c.fName, 1, 1), \" \", c.lName) as username, idNumber, phone, email, cAddress, CONCAT(\"R\",a.amount) amount, amount amount2,  a.bidtime, bidId
            FROM `bid`a, `buyer` b, `user`c
            WHERE a.buyerId = b.buyerId
            AND c.userId = b.userId
            AND a.stockId = $stockId
            AND amount = (SELECT MAX(amount) FROM bid WHERE stockId = $stockId)
            ORDER BY a.bidId DESC";
            $bidAwarded2Result = mysqli_query($link, $bidAwarded2Sql);
            $awardedBidderTable = "";
            if(mysqli_num_rows($bidAwarded2Result) > 0){
                $awardedBidderTable .= "\n\t\t<table name=\"biddersList\" class=\"\">";
                $awardedBidderTable .= "\n\t\t<tr>";
                $awardedBidderTable .= "\n\t\t\t<th>Auction ID</th>";
                $awardedBidderTable .= "\n\t\t\t<th width=\"60\">Buyer ID</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Buyer Name</th>";
                $awardedBidderTable .= "\n\t\t\t<th>ID Number</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Phone</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Email</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Address</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Amount</th>";
                $awardedBidderTable .= "\n\t\t\t<th>Bid Time</th>";
                $awardedBidderTable .= "\n\t\t</tr>";
                while($bidAwarded2Row = mysqli_fetch_assoc($bidAwarded2Result))
                {
                    $awardedBidderTable .= "\n\t\t<tr>";
                    $awardedBidderTable .= "\n\t\t\t<td>" . $stockId . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['buyerId'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['username'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['idNumber'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['phone'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['email'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['cAddress'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['amount'] . "</td>";
                    $awardedBidderTable .= "\n\t\t\t<td>" .$bidAwarded2Row['bidtime'] . "</td>";
                    $awardedBidderTable .= "\n\t\t</tr>";
                    $awardedBidderTable .= "\n\t\t</table>";
                }
            }
            else
            {
                $awardedBidderTable = "No Information!";
            }
            $bidAwardedTo .= $awardedBidderTable . "</div>";
            //Livestock Description Table
            $livestockDescriptionTable = "\t\t<div id=\"listockDescTblD-$stockId\" class=\"\">";
            $livestockDescriptionTable .= "\n\t\t\t<table class=\"\">";
            $livestockDescriptionTable .= "\n\t\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th width=\"60\">Auction ID</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Livestock Name</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Livestock Type</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Breed</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Sex</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Weight</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Age</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Age Unit</th>";
            //$livestockDescriptionTable .= "\n\t\t\t\t<th>Bio</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Ask Amount</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>Start Date</th>";
            $livestockDescriptionTable .= "\n\t\t\t\t<th>End Date</th>";
            // $livestockDescriptionTable .= "\n\t\t\t<th>Auction Status</th>";
            $livestockDescriptionTable .= "\n\t\t\t</tr>";
            $livestockDescriptionTable .= "\n\t\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['stockId'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['livestockName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['animalTypeName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['breedName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['sex'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['weight'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['age'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['ageType'] . "</td>";
            //$livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['bio'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['askamount'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['startdate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t\t<td>" .$row['enddate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t</tr>";
            $livestockDescriptionTable .= "\n\t\t\t</table>";
            $animalBioDiv .= $row['bio'] . "</div>";
            //Check if the video exists and if it does not exist then let user user know such
            //But we also need to know if the auction is active or not.
            $_SESSION['stockId'] = $row['stockId'];
            $stockId = $row['stockId'];       
            // $auctionCard .= $videoHtml;
            //Show The Active bids for this item.
            //Create somewhere to put the video
            $placeBidDiv .= "\t\t\t<h2>Place Your Bid</h2>\n";//Create a button where we are going to allow the user to place a bid.
            //Firstly we want to know where the user is bidding, once we know where user is bidding we can then place the bid.
            //We need the livestockID.
            //We need to put in the amount first in order for us to bid.
            $endDate = $row['enddate'];
            $buyerId = $_SESSION['buyerId'];
            $placeBidDiv .="\t\t\t<form action=\"component/placebid.php\" method=\"POST\">
                <label for=\"inputBidPrice\" class=\"\">Place your bid here | Enter the amount of money below</label><br>
                <input type=\"text\" placeholder=\"e.g 3999.99\" name=\"inputBidPrice\" id=\"inputBidPrice\" class=\"\" required>
                <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                <input type=\"hidden\" name=\"endDate\" value=\"$endDate\">
                <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                <input type=\"submit\" value=\"Bid\" name=\"submitBid\">\n\t\t\t</form>\n\t\t</div>";
            //Show a list bidders for a given livestock.
            //Show people who have placed their bids on the auction
			//create and sql for the highest  bid 
			$sqlHighestBid = "SELECT MAX(amount) highest FROM bid WHERE stockId = $stockId AND buyerId = $buyerId";
			$resultSqlHighestBid = mysqli_query($link, $sqlHighestBid);
			$highestBidValue = 0.0;
			if(mysqli_num_rows($resultSqlHighestBid) > 0)
			{
				while($rowHighestBidValue = mysqli_fetch_assoc($resultSqlHighestBid))
				{
					$highestBidValue = $rowHighestBidValue['highest'];
				}
			}
			//echo $highestBidValue . " is the Higest Bid Value" . "<br>";
				
            $sqlBids = "SELECT a.bidId, b.buyerId, CONCAT(SUBSTRING(c.fName, 1, 1), \" \", c.lName) as username, CONCAT(\"R\",a.amount) amount, amount amount2,  a.bidtime, bidId
            FROM `bid`a, `buyer` b, `user`c
            WHERE a.buyerId = b.buyerId
            AND c.userId = b.userId
            AND a.stockId = $stockId
            ORDER BY a.bidId DESC";
            //echo "<br>" . $sqlBids . "<br>";
            $biddersTableList = "";

            $resultBids = mysqli_query($link, $sqlBids);
            if(mysqli_num_rows($resultBids)>0){
				//Withdraw all bids
				// $biddersTableList .= "
				// <br>
				// <form action=\"component/withdrawAllBids.php\" method=\"POST\">
				// <label>To withdraw from Auction click the withdraw from auction button</label><br>
				// <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
				// <input class=\"deleteButton\" type=\"submit\" value=\"Withdraw From Auction\" name=\"withdraw\">
				// </form>";
                $biddersTableList .= "\n\t\t<table name=\"biddersList\" class=\"\">";
                $biddersTableList .= "\n\t\t<tr>";
                $biddersTableList .= "\n\t\t\t<th width=\"60\">Buyer ID</th>";
                $biddersTableList .= "\n\t\t\t<th>Buyer Name</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Amount</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Time</th>";
                // $biddersTableList .= "\n\t\t\t<th>Cancel</th>";
                $biddersTableList .= "\n\t\t</tr>";
                while($row = mysqli_fetch_assoc($resultBids)){
                    $biddersTableList .= "\n\t\t<tr>";
                    $rowBuyerId = $row['buyerId'];
                    $bidId = $row['bidId'];
                    $biddersTableList .= "\n\t\t\t<td>" .$row['buyerId'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['username'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['amount'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['bidtime'] . "</td>";
                    $withdrawAuctionForm = "";
					//Now want to be strategic about this - we cannot withdraw bids that have been passed or outmatched
                    //echo "The current Bid " . $currentBid . "<br>";
                    if($rowBuyerId == $buyerId && $row['amount2'] >= $highestBidValue && $row['amount2'] == $currentBid2 )
					{
						//echo $rowBuyerId  . " == " .  $buyerId . " &&  " .  $row['amount2'] . " >= "  . $highestBidValue  . "<br>";
                        $withdrawAuctionForm = "<form action=\"component/withdrawBid.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
						<input type=\"hidden\" name=\"bidId\" value=\"$bidId\">
                        <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                        <input class=\"deleteButton\" type=\"submit\" value=\"Cancel\" name=\"withdrawBid\">
                        </form>";
                        $biddersTableList .= "\n\t\t\t<td>" . $withdrawAuctionForm . "</td>";
                    }
                    else{
                        $biddersTableList .= "\n\t\t\t<td></td>";
                    }
                    $biddersTableList .= "\n\t\t</tr>";
                }
                $biddersTableList .= "\n\t\t</table>";
                $biddersListDiv .= $biddersTableList . "\n</div>";
            }
            $livestockDetailsDiv .= "\t\t\n" . $auctionTitle . "\n";
            $livestockDetailsDiv .= $bidAwardedTo . "\n";
            $livestockDetailsDiv .= $auctionInformationDiv . "\n" ;
            $livestockDetailsDiv .= $livestockDescriptionTable . "\n\t\t</div>";
            $livestockDetailsDiv .= $animalBioDiv .  "\n\t</div>";

            //$auctionDetailsDiv .= "\t\t\n" .$placeBidDiv . "\n";
            $auctionDetailsDiv .=  $biddersListDiv . "</div>\n\t</div>";
            $mainDiv .= $livestockDetailsDiv . "\n" . $auctionDetailsDiv . "\n</div>";
            echo $mainDiv . "\n<hr>";
        }
    }
    else{
        echo "<br>No Active Auctions";
    }
    


?> -->
