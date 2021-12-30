<?php   
    include_once "../../../../config/connect.php";

    if(isset($_POST['createAuctionButton'])){
      $password = $_SESSION['password'];
      $username = $_SESSION['email'];
      $sellerId = 0;
      //$sql = "SELECT `sellerId` FROM `user` , `seller` WHERE `email` = '$username' AND `password` = '$password'";
      //$result = mysqli_query($link, $sql);
      /*if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          //When I get the user Id I now need to get the user's seller Id.
          $sellerId =  (int)$row['sellerId'];
        }
      }*/
      $sellerId = $_SESSION['sellerId'];
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

      $sql = "INSERT INTO `livestock` ( `sex`, `livestockName`, `breedId`, `age`, `ageType`, `weight`, `sellerId`, `askamount`, `startdate`, `enddate`, `bio`, `statusId`) VALUES ('$sex', '$name', $breedId, $age, '$ageType', $weight, $sellerId, $askAmount , '$startDate', '$endDate', \"$animalBio\", 1)";
      echo $sql;
      //Create Open up another page where the user is going to upload their video
      if(mysqli_query($link, $sql)){
        header("Location: ../../active");
      }
    }

    
 