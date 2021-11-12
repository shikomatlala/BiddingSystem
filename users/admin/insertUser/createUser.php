<?php

include_once "../../../connect.php";
include_once "../class/form.php";
include_once "../class/user.php";
// include_once "form.php";
echo header_html_("../../../style.css");
$user = new User();
$form = new Form();
$input = new Input();
$label = new Label();
$div = new Div();
$user->setLink($link);
echo "<h1>Create your account here</h1>\n<br><hr>";
//create a back button - which is actually a form - 
$form->set_form("../home/admin_portal.php", "POST", "");
//$label->set_label("Click to Register new Student", "First Name", "");
$input->set_input("submit", "back", "Back", "", "back_button");
echo $form->get_form_wrapper($input->get_input());
//what do we need to insert this student -- well we just need to know the current studen stumber - but ai its going to take us time-- wel
//Create an error list - if we can do so we will be ale to know how to work with out erros - or we can push the person back and then just change a few things to the class -
//$status_stud_name = "";
if(isset($_POST['createUser']))
{
  //echo "Now in here";
    //Get the
    //$user->validate_name($)
    //print_r($user->get_link());
    $_SESSION['admin_label'] = "";
    $_SESSION['user'] = array();
    $user->setFirstname($_POST['first_name']);
    $user->setLastname($_POST['last_name']);
    $user->setId($_POST['id_nr'], $link);
    $showMe = "";
    $showMe .= $user->getFirstname();
    $showMe .= $user->getLastname();
    $showMe .= $user->getId();
    echo $showMe . "<br>";
    $user->setSex($_POST['sex']);
    $user->setPhone($_POST['phone'], $link);
    $user->setEmail($_POST['email']);
    $user->setAddress($_POST['address']);
    $user->setPassword($_POST['password']);
    //here we have stored everything inside our array - .
    array_push($_SESSION['user'], $_POST['first_name'],$_POST['last_name'],$_POST['id_nr'], $_POST['sex'], $_POST['phone'],$_POST['email'], $_POST['address'], $_POST['password']);
    //Now there is no where we are comparing the sex and ID 
    //This is actually compared at the javascript level
  
    if(strpos($user->viewSql(), "NULL") == false)//Meaning no string found
    {
        $sql = $user->viewSql();
        if(mysqli_query($link, $user->viewSql()))
        {
            echo "<h1>Account Created</h1><hr>";
            //Now le us go to the point were we have the user add more information about our student.
            //Now let us show the student details for the student that has just registered
            //The details are stored in the session
            //create lables contain
            $_SESSION['stud_label'] = $user->getUserLabel();
            echo $user->getUserLabel();
            //Create a form where the select will be held
            echo "<br><hr><br>";
            $form->set_form("../home/admin_portal.php", "POST", "");
            $input->set_input("submit", "back", "Finish", "", "update_button");
            echo $form->get_form_wrapper($input->get_input());
            //Create a finish button -- to insert this lecturer to the system -- The finish button cannot make use of 
            //We need to make sure that the user can actually put is their password.
            //The user needs to enter their email address right as they create their account, so i do not think that this will make sense to have another stepp where a user creates or inserts their password.
        }
    }
    else
    {
        //echo "<br>Many Errors Found change this dude <br><br>";
        //return the student with the errors that they have made
        //The issue that I have with using a component is that I cannot make sure that I set the values inside the input boxes. - 
        $form = new Form();
        $input = new Input();
        $label = new Label();
        $input_wrapper = "";
        $form->set_form("createAdmin.php", "POST", "");
        //first _name
        $label->set_label("first_name", $user->getUserNameStatus($user->getFirstname()), "");
        $input->set_input("text", "first_name",$user->getFirstname(), "First Name", "input_");
        $input_wrapper .= $label->get_label() . "<br>\n";
        $input_wrapper .= $input->get_input_text() . "<br><br>\n";
        //Last Name
        $label->set_label("last_name", $user->getUserSurnStatus($user->getLastname()), "");
        $input->set_input("text", "last_name", $user->getLastname(), "Last Name", "input_");
        $input_wrapper .= $label->get_label() . "<br>\n";
        $input_wrapper .= $input->get_input_text() . "<br><br>\n";
        //ID Number
        $label->setLabel("id_nr", $user->getIdStatus($user->getId()), "", "lblId_nr");
        $input->setInput("text", "id_nr", $user->getId(), "ID Number", "input_", "id_nr", "oninput", "validate_id()");
        $input_wrapper .= $label->getLabel() . "<br>\n";
        $input_wrapper .= $input->getInput() . "<br><br>\n";
        //Select Sex
        $label->setLabel("sex", $user->validateSex($user->getId(), $user->getSex()), "", "lblSex");
        $input_wrapper .= $label->getLabel() . "<br>\n";
        $select = new Select();
        $select->setSelect("sex","sex", "input_", "onchange", "validate_id()");
        $select->set_option("M", "Male");
        $gender_option = "\t".$select->get_option();
        $select->set_option("F","Female");
        $gender_option .= "\t".$select->get_option();
        $select_output = $select->getSelect($gender_option);
        $input_wrapper.= $select_output . "<br>";
        //Phone Number
        $label->setLabel("phone", $user->getPhoneStatus($user->getPhone()), "", "lblPhone");
        $input->setInput("text", "phone", $user->getPhone(), "Phone Number", "input_", "phone", "oninput", "validatePhone()");
        $input_wrapper .= $label->getLabel() . "<br>\n";
        $input_wrapper .= $input->getInput() . "<br><br>\n";
        //Email Address
        $label->set_label_("email", $user->emailStatus(), "", "lblEmail");
        $input->setInput("text", "email", $user->getEmail(), "Email", "input_", "email", "oninput", "validateEmail()");
        $input_wrapper .= $label->get_label_() . "<br>\n";
        $input_wrapper .= $input->getInput() . "<br><br>\n";

        //Address
        $label->set_label("address", "Home Address", "");
        $input->set_input("text", "address", $user->getAddress(), "Home Address", "input_");
        $input_wrapper .= $label->get_label() . "<br>\n";
        $input_wrapper .= $input->get_input_text() . "<br><br>\n";

        $input_wrapper .= "<h3 class=\"center_el\">Enter Password</h3>";

        $label->setLabel("pword1", "Password Good", "", "lblPword1");
        //$label->set_label("password", "Password", "");
        $input->setInput("password", "password", $user->getPassword(), "Password", "input_", "pword1", "oninput", "validatePassword(this.id,'lblPword1')");
        //$input->set_input("text", "password", "", "Password", "");
        $input_wrapper .= $label->getLabel() . "<br>\n";
        $input_wrapper .= $input->getInput() . "<br><br>\n";
    
        //first _name
        $label->setLabel("pword2", "Password Good", "", "lblPword2");
        $input->setInput("password", "password", $user->getPassword(), "Password", "input_", "pword2", "oninput", "validatePassword(this.id,'lblPword2')");
        $input_wrapper .= $label->getLabel() . "<br>\n";
        $input_wrapper .= $input->getInput() . "<br><br>\n";

        $input->set_input("submit","createUser", "Create User", "","update_button", "createUser", "", "");
        $input_wrapper .= $input->get_input() ."<br>\n";
        $div->set_div("form_input", "");

        
        echo $div->get_div($form->get_form_wrapper($input_wrapper));
    }
}
else
{
    echo "CraeteUser not set";
}
//Let us show the student information the form that we want to use.
echo "<br>";
echo "<br>";


function button($data1, $data_name1, $data2, $data_name2, $button_name, $button_caption, $action)
{
    $form = new Form();
    $input = new Input();
    $inputs = "";
    $out = "";
        //create a back button - which is actually a form - 
        $form->set_form($action, "POST", "");
        $input->set_input("hidden", $data_name1, $data1, "", "");
        $inputs .= $input->get_input() . "\n";
        $input->set_input("hidden", $data_name2, $data2, "", "");
        $inputs .= $input->get_input() . "\n";
        $input->set_input_("submit", $button_name, $button_caption, "update_button", "update_button", "subMit");
        $inputs .= $input->get_input_() . "\n";
        $out =  $form->get_form_wrapper($inputs);
        //Above is the back button
    return $out;
}


function back_button($back_url)
{
    $form = new Form();
    $input = new Input();
    $out = "";
        //create a back button - which is actually a form - 
        $form->set_form($back_url, "POST", "");
        //$label->set_label("Click to Register new Student", "First Name", "");
        $input->set_input("submit", "back", "Back", "", "back_button");
        echo $form->get_form_wrapper($input->get_input());
        //Above is the back button
    return $out;
}
function finish_button($back_url)
{
    $form = new Form();
    $input = new Input();
    $out = "";
        //create a back button - which is actually a form - 
        $form->set_form($back_url, "POST", "");
        //$label->set_label("Click to Register new Student", "First Name", "");
        $input->set_input("submit", "finish", "Finish", "update_button", "update_button");
        echo $form->get_form_wrapper($input->get_input());
        //Above is the back button
    return $out;
}

?>
