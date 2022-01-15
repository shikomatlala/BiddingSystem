<?php
    include_once "../../../config/connect.php";
    include_once "../component/navbar.php";
    include_once "component/function.php";

    //Create a way for our person to be able to view all of his auctions - But what is most important is that our user should complete their auction.
    //Create a table for showing our orders -- But one thing that we can do is to allow javascript to handle that part of the create because all that we are looking for is the auction - but yet again we want to insert the video to complete the auction.

    // echo uploadVideo();
    //Create a table where we show all the livestock or rather bids that have been created.
    $sellerId = $_SESSION['sellerId'];
    $sql = "SELECT a.statusId, stockId, sex, livestockName, age, ageType, weight, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName
    FROM `livestock` a, `breed` b, `animalType` c, `auctionStatus` d
    WHERE sellerId = $sellerId
        AND d.statusId = a.statusId
        AND a.breedId = b.breedId
        AND b.typeId = c.typeId
        AND a.statusId = 1
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
    $livestockTable = "";
    $noIncomplete = "";
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
        $livestockTable .= "
        <div id=\"auction-" . $row['stockId'] . "\" class=\"\">";
        $livestockTable .= "\n\t\t<table class=\"\">
            <tr>";
        $livestockTable .= "\n\t\t\t<th width=\"60\">Auction ID</th>";
        $livestockTable .= "\n\t\t\t<th>Livestock Name</th>";
        $livestockTable .= "\n\t\t\t<th>Livestock Type</th>";
        $livestockTable .= "\n\t\t\t<th>Breed</th>";
        $livestockTable .= "\n\t\t\t<th>Sex</th>";
        $livestockTable .= "\n\t\t\t<th>Weight</th>";
        $livestockTable .= "\n\t\t\t<th>Age</th>";
        $livestockTable .= "\n\t\t\t<th>Age Unit</th>";
        $livestockTable .= "\n\t\t\t<th>Bio</th>";
        $livestockTable .= "\n\t\t\t<th>Ask Amount</th>";
        $livestockTable .= "\n\t\t\t<th>Start Date</th>";
        $livestockTable .= "\n\t\t\t<th>End Date</th>";
        $livestockTable .= "\n\t\t\t<th>Auction Status</th>";
        $livestockTable .= "\n\t\t     </tr>";

        $livestockTable .= "\n\t\t     <tr>";
        $livestockTable .= "\n\t\t\t<td>" .$row['stockId'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['livestockName'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['animalTypeName'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['breedName'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['sex'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['weight'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['age'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['ageType'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['bio'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>R" .$row['askamount'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['startdate'] . "</td>";
        $livestockTable .= "\n\t\t\t<td>" .$row['enddate'] . "</td>";
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
                $statusValue = "Auction Created";
                //Create a display to show the video which we have created.
                while($videoRow = mysqli_fetch_assoc($checkVideoResult)){
                    $videoName = "video/" . $videoRow['locationString'];
                }
                // $myfile = fopen($videoName, "r") or die("Unable to open file!");//Rather that do this I can just open a video
                // echo fgets($myfile);
                // fclose($myfile);
                $videoHtml = "<br><video>
                <source src=\"$videoName\" type=\"video/mp4\">
                Your browser does not support the video tag.
              </video>";
            }
            else{
                $statusValue = "Auction Incomplete<br>" . uploadVideo($stockId);//Create a button which will be used to insert the video
            }
        $livestockTable .= "\n\t\t\t<td>" .$statusValue . "</td>";
        $livestockTable .= "\n\t\t</tr>";
            
        $livestockTable .= "\n\t\t</tr><br>";
        $livestockTable .= $videoHtml;
        $livestockTable .= "</div>";
            //Create somewhere to put the video
        }
    }
    else
    {
        $noIncomplete =  "<h3>You do not have any incomplete auctions</h3>";
    }
    echo "<h1>Incomplete Auctions</h1>";
    echo $noIncomplete; //empty 
    echo $livestockTable;
?>