<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    include_once "connect.php";
    $sql = "SELECT `name`, `typeId` FROM `animalType`";
    $result = mysqli_query($link, $sql);
    $postArr = array();
    if(mysqli_num_rows($result) >0){
        while($row = mysqli_fetch_assoc($result)){
            Extract($row);
            $postItem = array(
                'name'=>$name,
                'typeId'=>$typeId
            );
            array_push($postArr, $postItem);
            
        }
        echo json_encode($postArr);
    }
    else
    {
        echo json_encode(array('message'=> 'No posts found'));
    }

?>

