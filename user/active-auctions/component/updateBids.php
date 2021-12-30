<?php 
    //The goal here is to update our bids - we are not going to display anything we are just going to update and that is all.
    //We want to do the following - We want to close bids when the time is out. This is all
    //We have update the database so that our auctions can have a proper status.
    //updateBids();

    function updateBids($link){
		
        //include_once "../../../config/connect.php";// I am going to have a problem location where this connection is, because I am assuming that this component is going to be used by many scripts from different location in the system
        $sql = "SELECT * FROM `livestock` a, `auctionStatus` b 
                WHERE a.statusId = b.statusId
                AND a.statusId = 3";
        $result = mysqli_query($link, $sql);
        //echo $sql;
        if(mysqli_num_rows($result) > 0)
        {
            //Now get the times and compare if the time is not closed.
            //-- But as we bid we should also make sure that the time is not closed.
            while($row = mysqli_fetch_assoc($result))
            {
                //Now we need to know which auction has its time closed
                //Check the time
                date_default_timezone_set('Africa/Johannesburg');
                $endDate = $row['enddate'];
                $stockId = $row['stockId'];
                //echo "<br>" .$stockId  . " | " . $endDate;
                if($endDate < date('Y-m-d H:i:s'))
                {
                    $update = "UPDATE `livestock` SET `statusId` = 4 WHERE `livestock`.`stockId` = $stockId ";
                    if(mysqli_query($link, $update)){
                        //echo "Updated!!!";
                    }
                }       
            }
        }
		
    }
?>