<?php
include_once "../../../connect.php";
include_once "../class/form.php";
include_once "../class/user.php";
include_once "../class/student.php";
include_once "../class/functions.php";
echo header_html("../../../style.css");
echo "<h1>Welcome to bidding system</h1>";
// header("LOCATION: ../lecturer/timetable.php");
//Let us Show the user details
$loginGood = $_SESSION['loginGood'];


if($loginGood)
{
    //Get the user information
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
      $sql = "SELECT * FROM `user` WHERE `email` = '$username' AND `password` = '$password'";
    $result = mysqli_query($link, $sql);
    UserInfo($result, $link);
    echo "<h2>Activity Navigator</h1>";
    echo editNav();
    echo "<div id=\"activityCard\" name=\"activityCard\"> Activity Here</div>";
}
else
{
  echo "We are not good";
    $sql = "SELECT * FROM student WHERE stud_number = $userId";
    $result = mysqli_query($link, $sql);
}


function UserInfo($result, $link)
{
    $form = new Form();
    $input = new Input();
    $label = new Label();
    $user = new User();
    $user->setLink($link);
    $input_wrapper = "";
    $phone = "";
    $input_wrapper = "";
    $userId= (int)$_SESSION['stud_number'];
    $userName= "";
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
          // $idNumber = $row['idNumber'];
            //Get the students details - 
            //Let us work with see how this is going to turn out.
            //Show the person their information that they cannot change - 
            $_SESSION['userId'] = $row['userId'];
            $userId = $row['userId'] . "</td>";
            $user->setFirstname($row['fName']);
            $user->setLastname($row['lName']);
            $user->setId($row['idNumber'], $link);
            $user->setPhone($row['phone'], $link);
            $phone = $row['phone'];
            $user->setAddress($row['cAddress']);
            $user->setEmail($row['email']);
            //Labels to show the students information - 
            //This the Student Number
            $label->set_label("userId", "User ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['userId'] , "view_like_ptag");
            $input_wrapper .= $label->get_label() . " ";
            $input->set_input("hidden", "userId", $row['userId'], "", "");
            $input_wrapper .= $input->get_input();
            //ID Number
            $label->set_label("idNumber", "ID Number: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .  $row['idNumber'], "view_like_ptag");
            $input_wrapper .= $label->get_label() . " ";
            //Show the Gender

            $gender = "";
            $varGender ="";
            if($varGender == "M")
            {
                $gender = "Male";
            }
            elseif($varGender == "F")
            {
                $gender = "Female";
            }
            else
            {
                $gender = "Other";
            }
            $label->set_label("sex", "Sex:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $gender, "view_like_ptag");
            $input_wrapper .= $label->get_label() . "";
            //Email
            $label->set_label("email", "Email Address:&nbsp;&nbsp;" . $row['email'], "view_like_ptag");
            $input_wrapper .= $label->get_label();
            //first _name
            $label->set_label("fname", "First Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['fName'], "view_like_ptag");
            $input_wrapper .= $label->get_label();
            $userName = $row['fName'] . " ";
            //Last Name
            $label->set_label("lname", "Last Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .  $row['lName'], "view_like_ptag");
            $input_wrapper .= $label->get_label();
            $userName .= $row['lName'];
            //You cannot edit your gender because if you do it will mess up your ID 
            $label->set_label("phone", "Phone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['phone'], "view_like_ptag");
            $input_wrapper .= $label->get_label();
            //first _name
            $label->set_label("address", "Home Address:&nbsp;&nbsp;" . $row['cAddress'], "view_like_ptag");
            $input_wrapper .= $label->get_label();

        }
    }
    //All the Out put comes here
    echo "<h2>" .  $userName . " | " . $userId . "</h2>\n";

    //echo "<h3>Information for student : $userId</h3>\n<br>";
    echo "<h3>PERSONAL DETAILS</h3>";

    echo $input_wrapper;
    ///The input button
    $input_wrapper = ""; 
    $form->set_form("update_from_view_student.php", "POST", "");
    $input->set_input("hidden","stud_number", $userId, "","");
    $input_wrapper .= $input->get_input(). "<br>\n";
    $input->set_input("hidden","phone", $phone, "","");
    $input_wrapper .= $input->get_input(). "<br>\n";
    $input->set_input("submit","submit", "Update Details", "","update_button");
    $input_wrapper .= $input->get_input() ."\n";

    echo $form->get_form_wrapper($input_wrapper) . "<br>";
}


?>