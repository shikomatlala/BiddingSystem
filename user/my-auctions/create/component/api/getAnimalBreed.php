<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    
    include_once "connect.php";
    if(isset($_POST['typeId']))
    {
        $typeId = $_POST['typeId'];
        $sql = "SELECT `breedId`, `name` FROM `breed` WHERE `typeId`=$typeId";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) >0){
            $postArray = array();
            while($row = mysqli_fetch_assoc($result)){
                Extract($row);
                $postItem = array(
                    'breedId'=>$breedId,
                    'name'=>$name
                );
                array_push($postArray, $postItem);
            }
            echo json_encode($postArray);
        }
        else
        {
            echo json_encode(array('message'=> 'No posts found'));
        }
    } 

    