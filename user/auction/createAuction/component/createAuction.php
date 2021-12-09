<?php   
    include_once "api/connect.php";

    $targetDir = "uploads/";
    $targetFile = $targetDir;
    basename($_FILES["uploadVideo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    if(isset($_POST['createAuctionButton']))
    {

        getimagesize($_FILES["uploadVideo"]["tmp_name"]);
        if($check !==false){
            echo "file is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }else{
            echo "File is not an image.";
            $uploadOk =0;
        }


        $breedId = (int)$_POST['selectAnimalBreed'];
        $sex = $_POST['selectAnimalSex'];
        $name = $_POST['inputAnimalName'];
                
        $age = (int)$_POST['inputAnimalAge'];
        $ageType = $_POST['selectAnimalAge'];
        $weight = $_POST['inputAnimalWeight'];
        $animalBio = $_POST['inputAnimalBio'];
        $askAmount = $_POST['askAmount'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $sql = "INSERT INTO `livestock` ( `sex`, `name`, `breedId`, `age`, `ageType`, `weight`, `sellerId`, `askamount`, `startdate`, `enddate`, `bio`) VALUES ('$sex', '$name', $breedId, $age, '$ageType', $weight, 1, $askAmount , '$startDate', '$endDate', \"$animalBio\")";
        echo $sql;


    }