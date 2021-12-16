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
    
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
            $auctionCard = "";
            $stockId = $row['stockId'];
            $mainDiv = "<div id=\"auctionD-$stockId\" class=\"\">";
            $auctionTitle = "<div id=\"auctionTtlD-$stockId\" class=\"\">";
            $auctionInformationDiv = "<div id=\"auctionInfoD-$stockId\" class=\"\">Empty For Now</div>";
            $livestockDetailsDiv = "<div id=\"lStockD-$stockId\" class=\"\">";
            $auctionDetailsDiv = "<div id=\"aDetailsD-$stockId\" calss=\"\">";
            $placeBidDiv = "<div id=\"placeBidD-$stockId\" class=\"\">\n";
            $biddersListDiv = "<div id=\"biddersListD-$stockId\" class=\"\">";
            $currentBid = "";
            $sqlCurrentBid = "SELECT CONCAT(\"<br><br>Current Bid R\",MAX(amount)) as currentBid  FROM `bid` WHERE stockId = $stockId";
            $resultCurrentBid = mysqli_query($link, $sqlCurrentBid);
            if(mysqli_num_rows($resultCurrentBid) > 0){
                while($rowCurrentBid = mysqli_fetch_assoc($resultCurrentBid)){
                    $currentBid = $rowCurrentBid['currentBid'];
                }
            }
            $livestockName = $row['livestockName'];
            //Auction Title
            $auctionTitle .= "<h1>$stockId | $livestockName <br> $currentBid</h1></div>";
            //Livestock Description Table
            $livestockDescriptionTable = "<div id=\"listockDescTblD-$stockId class=\"\">";
            $livestockDescriptionTable .= "\n\t\t<table class=\"\">";
            $livestockDescriptionTable .= "\n\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t<th width=\"60\">Auction ID</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Livestock Name</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Livestock Type</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Breed</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Sex</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Weight</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Age</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Age Unit</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Bio</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Ask Amount</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>Start Date</th>";
            $livestockDescriptionTable .= "\n\t\t\t<th>End Date</th>";
            // $livestockDescriptionTable .= "\n\t\t\t<th>Auction Status</th>";
            $livestockDescriptionTable .= "\n\t\t</tr>";
            $livestockDescriptionTable .= "\n\t\t<tr>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['stockId'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['livestockName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['animalTypeName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['breedName'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['sex'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['weight'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['age'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['ageType'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['bio'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['askamount'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['startdate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t\t<td>" .$row['enddate'] . "</td>";
            $livestockDescriptionTable .= "\n\t\t</tr>";
            $livestockDescriptionTable = "</div>";
            //Check if the video exists and if it does not exist then let user user know such
            //But we also need to know if the auction is active or not.
            $_SESSION['stockId'] = $row['stockId'];
            $stockId = $row['stockId'];
            $checkVideoSql ="SELECT * FROM `livestockvideo` WHERE `stockId` = $stockId";
            $checkVideoResult = mysqli_query($link, $checkVideoSql);
            $statusValue = "";
            $videoName = "";
            $livestockVideo = "<div id=\"lStockVideoD-$stockId\" class=\"\">";
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
                $livestockVideo .= "<br><video controls autoplay>
                <source src=\"$videoName\" type=\"video/mp4\">
                Your browser does not support the video tag.
              </video>
              </div>";
            }
            else{
                $livestockVideo = "<br>Auction Incomplete!<br>
                </div>";//Create a button which will be used to insert the video
            }        
            // $auctionCard .= $videoHtml;
            //Show The Active bids for this item.
            //Create somewhere to put the video
            $placeBidDiv .= "<h2>Place Your Bid</h2>\n";//Create a button where we are going to allow the user to place a bid.
            //Firstly we want to know where the user is bidding, once we know where user is bidding we can then place the bid.
            //We need the livestockID.
            //We need to put in the amount first in order for us to bid.
            $buyerId = $_SESSION['buyerId'];
            $placeBidDiv .="
            <form action=\"component/placebid.php\" method=\"POST\">
                <label for=\"inputBidPrice\" class=\"\">Place your bid heres | Enter the amount of money below</label><br>
                <input type=\"text\" placeholder=\"e.g 3999.99\" name=\"inputBidPrice\" id=\"inputBidPrice\" class=\"\"><br>
                <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                <input type=\"submit\" value=\"Bid\" name=\"submitBid\">\n</form>\n</div>";
            //Show a list bidders for a given livestock.
            //Show people who have placed their bids on the auction
            $sqlBids = "SELECT b.buyerId, CONCAT(SUBSTRING(c.fName, 1, 1), \" \", c.lName) as username, CONCAT(\"R\",a.amount) amount, a.bidtime, bidId
            FROM `bid`a, `buyer` b, `user`c
            WHERE a.buyerId = b.buyerId
            AND c.userId = b.userId
            AND a.stockId = $stockId
            ORDER BY amount DESC";
            $biddersTableList = "";
            $resultBids = mysqli_query($link, $sqlBids);
            if(mysqli_num_rows($resultBids)>0){
                $biddersTableList .= "\n\t\t<table name=\"biddersList\" class=\"\"><tr>";
                $biddersTableList .= "\n\t\t\t<th width=\"60\">Buyer ID</th>";
                $biddersTableList .= "\n\t\t\t<th>Buyer Name</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Amount</th>";
                $biddersTableList .= "\n\t\t\t<th>Bid Time</th>";
                $biddersTableList .= "\n\t\t\t<th>Withdraw</th>";
                $biddersTableList .= "\n\t\t</tr>";
                while($row = mysqli_fetch_assoc($resultBids)){
                    $biddersTableList .= "\n\t\t     <tr>";
                    $rowBuyerId = $row['buyerId'];
                    $bidId = $row['bidId'];
                    $biddersTableList .= "\n\t\t\t<td>" .$row['buyerId'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['username'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['amount'] . "</td>";
                    $biddersTableList .= "\n\t\t\t<td>" .$row['bidtime'] . "</td>";
                    $withdrawAuctionForm = "";
                    if($rowBuyerId == $buyerId){
                        $withdrawAuctionForm = "<form action=\"component/placebid.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"stockId\" value=\"$stockId\">
                        <input type=\"hidden\" name=\"buyerId\" value=\"$buyerId\">
                        <input class=\"deleteButton\" type=\"submit\" value=\"Cancel\" name=\"withdrawBid\">
                        </form>";
                        $biddersTableList .= "\n\t\t\t<td>" . $withdrawAuctionForm . "</td>";
                    }
                    else{
                        $withdrawAuctionForm = "";
                        $biddersTableList .= "\n\t\t\t<td></td>";

                    }
                    $biddersTableList .= "\n\t\t     </tr>";
                    $biddersListDiv .= $biddersTableList . "\n</div>";
                }
            }
            $livestockDetailsDiv .= $auctionTitle . "\n" . $auctionInformationDiv . "\n" . $livestockVideo . "\n" . $livestockDescriptionTable . "\n</div>";
            $auctionDetailsDiv .= $placeBidDiv . "\n" . $biddersListDiv . "</div>";
            $mainDiv .= $livestockDetailsDiv . "\n" . $auctionDetailsDiv . "</div>";
            echo $mainDiv;
        }
    }
    else{
        echo "<br>No Active Auctions";
    }
    


?>
