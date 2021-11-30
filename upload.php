<?php
include 'student/header_sess.php';

?>

<!DOCTYPE html>
<html lang ="en" dir ="ltr">
<head>
   <meta charset="utf-8">

  <title>Home</title>


   <link rel ="stylesheet" href="student/css/edit.css">

    <link rel ="stylesheet" href="file:///C:/Users/Pfano%20Munyai/Desktop/grouping_system-Shiko_on_github/users/admin/fontawesome-free-5.15.3-web/css/all.css"><style>


BODY.video-playey{
left:50%;
}

</style>

</head>
 
 
<body>

 <?php


$conn= new mysqli('localhost','root','','test');
if($conn->connect_error){
    die('connection error ;' .$conn->connect_error);
}
if(isset($_POST['upload'])){
//$name= $_FILES['file'];
//echo "<pre>";
//print_r($name);
    $file_name = $_FILES['file']['name'];
    $file_type =$_FILES['file']['type'];
    $temp_name =$_FILES['file']['tmp_name'];
    $file_size =$_FILES['file']['size'];
    $file_destination ="upload/".$file_name;
    $type=$_POST['type'];
    $breed=$_POST['breed'];
    $price=$_POST['price'];
    $userid=$id;

if(move_uploaded_file($temp_name,$file_destination)){
    $q =" INSERT INTO file(userid,type,breed,price,file) VALUES ('$userid','$type','$breed','$price','$file_name')";
    if(mysqli_query($conn,$q)){
      echo '<script type="text/javascript">alert("You Succesfully Reseted the password"); window.location = "student/index.php";</script>';
    }else{
        $failed =" something went wrong";
    }
}else{
$msz ="please select a video to upload";
}

}

?>




 <form action="vid.php" method="post" enctype="multipart/form-data">
<br>
<br>
<div class="control-group">
             
    <label><strong>Upload video</strong></label>
    <input type="file" name="file">
    <?php if(isset($success)) {?>
        <div class="alert alert-success">
            <?php echo $success;?>
    </div>
    <?php } ?>

    <?php if(isset($failed)) {?>
        <div class="alert alert-danger">
            <?php echo $failed;?>
    </div>
    <?php } ?>
    <?php if(isset($msz)) {?>
        <div class="alert alert-success">
            <?php echo $msz;?>
    </div>
    <?php } ?>

    <input type="submit" name="upload" value="Upload" class="btn btn-success ml -3">
</form>



</body>

</html>


</body>

</html>