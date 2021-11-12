<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
//Includes our database and our models
include_once "../config/Database.php";
include_once "../models/selectAnimalBreed.php";

    if(isset($_POST['typeId']))
    {



        // echo "POST: The group ID is " . $_POST['group_id'];
        $typeId = $_POST['typeId'];

        $database = new Database();
        $db = $database->connect();
        $post = new SELECT($db);
        $result = $post->read($typeId);
        $num = $result->rowCount();
        if($num > 0)
        {
            $posts_arr = array(); //I do not see the purpose of this associative array
            // $posts_arr['data'] = array();
            while($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                Extract($row);
                $post_item = array(
                    'name' =>$name
                );
                //Push to data associative array
                array_push($posts_arr, $post_item);
            }
            //Turn to JSON
            echo json_encode($posts_arr);
        }
        else
        {
            echo json_encode(array('message'=> 'No posts found'));
        }
    }