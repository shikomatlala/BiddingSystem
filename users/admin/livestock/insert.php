<?php

    include_once "../../../connect.php";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    //Includes our database and our models
    include_once "config/Database.php";
    include_once "models/Insert.php";
    include_once "../class/livestock.php";
    $sellerId = $_SESSION['sellerId'];
    //Check if the form has been set from the database side.]
    $x = 0;
    if(isset($_POST['livestock']))
    {
        //get all the information - now we need to figure out a way of getting all of this informaiton and then posting it to the relevant information
        $livestock =  json_decode($_POST['livestock']);
        $sql = "INSERT INTO livestock (`sex`, `breedId`, `age`, `askamount`, `startdate`, `enddate`, `timeout`, `bio`, `sellerId`) VALUES (";
        foreach($livestock as $field)
        {
            $x++;
            if( $x == 3 || $x == 4 || $x == 7)
            {
                $sql .=  $field . ",";
            }
            else if($x == 2)
            {
                $sql .=  $field+1 . ",";
            }
            else
            {
                $sql .= "\"" . $field . "\",";
            }
            //Now need to insert this infromation to our database now the interesting thing about is that we also need to be able to store information about the fows and other things like that - But the first quesiton is what information is the time - e are going to store everythng in minures, what this meanis that we are going to create a variable that will allow us to sore minutes
        }
        $sql .= ")";//We need to 
        $sql = str_replace(",)", ",", $sql);
        //We need to get the seller Id
        $sql .= $sellerId . ")";
        if (mysqli_query($link, $sql))
        {
                echo "Added Successfully";
        }
        
   }
