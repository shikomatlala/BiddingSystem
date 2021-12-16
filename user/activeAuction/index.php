<?php
    include_once "../../config/connect.php";
    include_once "../component/navbar.php";
    // include_once "component/function.php";

    //Create a way for our person to be able to view all of his auctions - But what is most important is that our user should complete their auction.
    //Create a table for showing our orders -- But one thing that we can do is to allow javascript to handle that part of the create because all that we are looking for is the auction - but yet again we want to insert the video to complete the auction.

    // echo uploadVideo();
    //Create a table where we show all the livestock or rather bids that have been created.
    $sellerId = $_SESSION['sellerId'];
    $buyerId = $_SESSION['buyerId'];
    $sql = "SELECT stockId, sex, livestockName, age, ageType, weight, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName
    FROM `livestock` a, `breed` b, `animalType` c WHERE sellerId <> $sellerId
    AND a.breedId = b.breedId
    AND b.typeId = c.typeId
    ORDER BY stockId DESC";
    //     SELECT a.stockId, sex, livestockName, age, ageType, weight, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName 
    //      FROM `livestock` a, `breed` b, `animalType` c, `livestockvideo` d
    //      WHERE sellerId <> 2 
    // 	        AND a.breedId = b.breedId 
    //          AND b.typeId = c.typeId 
    //          AND d.stockId = a.stockId
    //      ORDER BY stockId DESC;

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
    $auctionCard = "";
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
            $stockId = $row['stockId'];
            $currentBid = "";
            $sqlCurrentBid = "SELECT CONCAT(\"<br><br>Current Bid R\",MAX(amount)) as currentBid  FROM `bid` WHERE stockId = $stockId";
            $resultCurrentBid = mysqli_query($link, $sqlCurrentBid);
            if(mysqli_num_rows($resultCurrentBid) > 0){
                while($rowCurrentBid = mysqli_fetch_assoc($resultCurrentBid)){
                    $currentBid = $rowCurrentBid['currentBid'];
                }
            }
            $livestockName = $row['livestockName'];
            $auctionCard .= "<h1>$stockId | $livestockName | $currentBid</h1>";
            $auctionCard .= "\n\t\t<table class=\"\">";
            $auctionCard .= "\n\t\t<tr>";
            $auctionCard .= "\n\t\t\t<th width=\"60\">Auction ID</th>";
            $auctionCard .= "\n\t\t\t<th>Livestock Name</th>";
            $auctionCard .= "\n\t\t\t<th>Livestock Type</th>";
            $auctionCard .= "\n\t\t\t<th>Breed</th>";
            $auctionCard .= "\n\t\t\t<th>Sex</th>";
            $auctionCard .= "\n\t\t\t<th>Weight</th>";
            $auctionCard .= "\n\t\t\t<th>Age</th>";
            $auctionCard .= "\n\t\t\t<th>Age Unit</th>";
            $auctionCard .= "\n\t\t\t<th>Bio</th>";
            $auctionCard .= "\n\t\t\t<th>Ask Amount</th>";
            $auctionCard .= "\n\t\t\t<th>Start Date</th>";
            $auctionCard .= "\n\t\t\t<th>End Date</th>";
            $auctionCard .= "\n\t\t\t<th>Auction Status</th>";
            $auctionCard .= "\n\t\t</tr>";
            $auctionCard .= "\n\t\t<tr>";
            $auctionCard .= "\n\t\t\t<td>" .$row['stockId'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['livestockName'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['animalTypeName'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['breedName'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['sex'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['weight'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['age'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['ageType'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['bio'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['askamount'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['startdate'] . "</td>";
            $auctionCard .= "\n\t\t\t<td>" .$row['enddate'] . "</td>";
            //Check if the video exists and if it does not exist then let user user know such
            //But we also need to know if the auction is active or not.
            $_SESSION['stockId'] = $row['stockId'];
            $stockId = $row['stockId'];
            $checkVideoSql ="SELECT * FROM `livestockvideo` WHERE `stockId` = $stockId";
            $checkVideoResult = mysqli_query($link, $checkVideoSql);
            $statusValue = "";
            $videoName = "";
            $videoHtml = "";
            if(mysqli_num_rows($checkVideoResult) > 0){
                $statusValue = "Active for Bids";
                //Now we need to know the time that the bid is valid or not
                //If a bid is not longer valid then we need to let the use know that the bid is not loger valid
                //If a bid has not yet started it should be put to a waiting list
                //But for now we want to be able to bid.
                //Create a display to show the video which we have created.
                //Let us start to allow the users to be able to bid
                while($videoRow = mysqli_fetch_assoc($checkVideoResult)){
                    $videoName = "../auction/myAuction/video/" . $videoRow['locationString'];
                }

                // $myfile = fopen($videoName, "r") or die("Unable to open file!");//Rather that do this I can just open a video
                // echo fgets($myfile);
                // fclose($myfile);
                $videoHtml = "<br><video controls autoplay>
                <source src=\"$videoName\" type=\"video/mp4\">
                Your browser does not support the video tag.
              </video>";

            }
            else{
                $statusValue = "Auction Incomplete<br>";//Create a button which will be used to insert the video
            }
            $auctionCard .= "\n\t\t\t<td>" .$statusValue . "</td>";
            $auctionCard .= "\n\t\t</tr>";
        
            $auctionCard .= $videoHtml;
            

            //Show The Active bids for this item.

            //Create somewhere to put the video
            $auctionCard .= "<h2>Place Your Bid</h2>";//Create a button where we are going to allow the user to place a bid.
            //Firstly we want to know where the user is bidding, once we know where user is bidding we can then place the bid.
            //We need the livestockID.
            //We need to put in the amount first in order for us to bid.
            $buyerId = $_SESSION['buyerId'];
            $auctionCard .="
            <form action=\"component/placebid.php\" method=\"POST\">
                <label for=\"inputBidPrice\" class=\"\">Place your bid heres | Enter the amount of money below</label><br>
                <input type=\"text\" placeholder=\"e.g 3999.99\" name=\"inputBidPrice\" id=\"inputBidPrice\" class=\"\"><br>
                <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                <input type=\"submit\" value=\"Bid\" name=\"submitBid\">
            
            </form>";
            //Show a list of active bids for a give livestock.
            //Show people who have placed their bids on the auction
            $sqlBids = "SELECT b.buyerId, CONCAT(SUBSTRING(c.fName, 1, 1), \" \", c.lName) as username, CONCAT(\"R\",a.amount) amount, a.bidtime, bidId
            FROM `bid`a, `buyer` b, `user`c
            WHERE a.buyerId = b.buyerId
            AND c.userId = b.userId
            AND a.stockId = $stockId
            ORDER BY amount DESC";
            $resultBids = mysqli_query($link, $sqlBids);
            if(mysqli_num_rows($resultBids)>0){
                $auctionCard .= "\n\t\t<table name=\"biddersList\" class=\"\"><tr>";
                $auctionCard .= "\n\t\t\t<th width=\"60\">Buyer ID</th>";
                $auctionCard .= "\n\t\t\t<th>Buyer Name</th>";
                $auctionCard .= "\n\t\t\t<th>Bid Amount</th>";
                $auctionCard .= "\n\t\t\t<th>Bid Time</th>";
                $auctionCard .= "\n\t\t\t<th>Withdraw</th>";
                $auctionCard .= "\n\t\t</tr>";
                while($row = mysqli_fetch_assoc($resultBids)){
                    $auctionCard .= "\n\t\t     <tr>";
                    $rowBuyerId = $row['buyerId'];
                    $bidId = $row['bidId'];
                    $auctionCard .= "\n\t\t\t<td>" .$row['buyerId'] . "</td>";
                    $auctionCard .= "\n\t\t\t<td>" .$row['username'] . "</td>";
                    $auctionCard .= "\n\t\t\t<td>" .$row['amount'] . "</td>";
                    $auctionCard .= "\n\t\t\t<td>" .$row['bidtime'] . "</td>";
                    $withdrawAuctionForm = "";
                    if($rowBuyerId == $buyerId){
                        
                        $withdrawAuctionForm = "<form action=\"component/placebid.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                        <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                        <input class=\"deleteButton\" type=\"submit\" value=\"Cancel\" name=\"withdrawBid\">
                        </form>";
                        $auctionCard .= "\n\t\t\t<td>" . $withdrawAuctionForm . "</td>";

                    }
                    else
                    {
                        $withdrawAuctionForm = "";
                        $auctionCard .= "\n\t\t\t<td></td>";

                    }

                    $auctionCard .= "\n\t\t     </tr>";
                }

            }
 
            echo $auctionCard;
        }
    }
    else
    {
        echo "<br>No Active Auctions";
    }
    


?>
