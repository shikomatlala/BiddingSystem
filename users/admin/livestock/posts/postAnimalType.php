<?php
    //headers - link to our databse and our models
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    //Includes our database and our models
    include_once "../config/Database.php";
    include_once "../models/selectAnymalType.php";//This is where we write our SQL 
    //Instantiate db & connect
    $database = new Database();
    $db = $database->connect();
    $select = new SELECT($db);
    $result = $select->read();
    $num = $result->rowCount();
    if($num > 0)
    {
        $select_arr = array(); //I do not see the purpose of this associative array
        // $selects_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            Extract($row);
            $select_item = array(
                'typeId' => $typeId,
                'name' => $name
            );
            //Push to data associative array
            array_push($select_arr, $select_item);
        }
        //Turn to JSON
        echo json_encode($select_arr);
    }
    else
    {
        echo json_encode(array('message'=> 'No posts found'));
    }
?>