<?php
    include_once "../../../config/connect.php";
    include_once "../component/navbar.php";
    include_once "component/function.php";

    //Create a way for our person to be able to view all of his auctions - But what is most important is that our user should complete their auction.
    //Create a table for showing our orders -- But one thing that we can do is to allow javascript to handle that part of the create because all that we are looking for is the auction - but yet again we want to insert the video to complete the auction.

    // echo uploadVideo();
    //Create a table where we show all the livestock or rather bids that have been created.
    $sellerId = $_SESSION['sellerId'];
    $sql = "SELECT stockId, sex, livestockName, age, ageType, weight, askamount, startdate, enddate, bio, b.name as breedName, c.name as animalTypeName
    FROM `livestock` a, `breed` b, `animalType` c WHERE sellerId = $sellerId
    AND a.breedId = b.breedId
    AND b.typeId = c.typeId
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
    $attendanceRoll = "";
    if(mysqli_num_rows($result) > 0){
        //Find the number of create my auctions.
        while($row = mysqli_fetch_assoc($result))
        {
            $attendanceRoll .= "
        <div id=\"auction-" . $row['stockId'] . "\" class=\"\">";
            $attendanceRoll .= "\n\t\t<table class=\"\">
            <tr>";
            $attendanceRoll .= "\n\t\t\t<th width=\"60\">Auction ID</th>";
            $attendanceRoll .= "\n\t\t\t<th>Livestock Name</th>";
            $attendanceRoll .= "\n\t\t\t<th>Livestock Type</th>";
            $attendanceRoll .= "\n\t\t\t<th>Breed</th>";
            $attendanceRoll .= "\n\t\t\t<th>Sex</th>";
            $attendanceRoll .= "\n\t\t\t<th>Weight</th>";
            $attendanceRoll .= "\n\t\t\t<th>Age</th>";
            $attendanceRoll .= "\n\t\t\t<th>Age Unit</th>";
            $attendanceRoll .= "\n\t\t\t<th>Bio</th>";
            $attendanceRoll .= "\n\t\t\t<th>Ask Amount</th>";
            $attendanceRoll .= "\n\t\t\t<th>Start Date</th>";
            $attendanceRoll .= "\n\t\t\t<th>End Date</th>";
            $attendanceRoll .= "\n\t\t\t<th>Auction Status</th>";
            $attendanceRoll .= "\n\t\t     </tr>";

            $attendanceRoll .= "\n\t\t     <tr>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['stockId'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['livestockName'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['animalTypeName'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['breedName'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['sex'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['weight'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['age'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['ageType'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['bio'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['askamount'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['startdate'] . "</td>";
            $attendanceRoll .= "\n\t\t\t<td>" .$row['enddate'] . "</td>";
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
                $videoHtml = "<br><video controls autoplay>
                <source src=\"$videoName\" type=\"video/mp4\">
                Your browser does not support the video tag.
              </video>";

            }
            else{
                $statusValue = "Auction Incomplete<br>" . uploadVideo($stockId);//Create a button which will be used to insert the video
            }
            $attendanceRoll .= "\n\t\t\t<td>" .$statusValue . "</td>";
            $attendanceRoll .= "\n\t\t</tr>";
            
            $attendanceRoll .= "\n\t\t</tr><br>";
            $attendanceRoll .= $videoHtml;
            $attendanceRoll .= "</div>";
            //Create somewhere to put the video

        }
       
    }
    echo $attendanceRoll;


?>