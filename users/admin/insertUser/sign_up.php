<?php
include_once "../../../connect.php";
include_once "form.php";
include_once "student.php";
echo header_html_("../../../style.css");
$form = new Form();
$input = new Input();
$label = new Label();
$student = new Student();
$input_wrapper = "";

echo "<h1>Signing Up</h1>\n<br><hr>";
//This is the back button - it is a functio which takes us back
//echo back_button("../home/admin_portal.html");

echo "<h2>Finish Signing Up</h2>\n";
echo "<h3>Follow the form to create your password to access this portal</h3>\n";
echo "<p>Keep this information save for you will need it to login...</p>";
echo "<h3>Staff Number: " . $_POST['staff_number']. "</h3>";
echo "<h3>ID Number: " . $_POST['id_nr']. "</h3>";
echo "<hr><p>Set your new password</p>";

$form->set_form("finish_sign_up.php", "POST", "");
//first _name
$label->set_label("staff_number", "Stuff Number", "");
$input->set_input("text", "staff_number",  $_POST['staff_number'], $_POST['staff_number'], "");
$input_wrapper .= $label->get_label() . "<br>\n";
$input_wrapper .= $input->get_input_text() . "<br><br>\n";
//Last Name
$label->set_label("staff_id", "ID Number", "");
$input->set_input("text", "id_number", $_POST['id_nr'], $_POST['id_nr'], "");
$input_wrapper .= $label->get_label() . "<br>\n";
$input_wrapper .= $input->get_input_text() . "<br><br>\n";
//first _name
$label->setLabel("pword1", "Password", "", "lblPword1");
//$label->set_label("password", "Password", "");
$input->setInput("password", "password", "", "Password", "", "pword1", "oninput", "validatePassword(this.id,'lblPword1')");
//$input->set_input("text", "password", "", "Password", "");
$input_wrapper .= $label->getLabel() . "<br>\n";
$input_wrapper .= $input->getInput() . "<br><br>\n";

//first _name
$label->setLabel("pword2", "Password", "", "lblPword2");
$input->setInput("password", "password", "", "Password", "", "pword2", "oninput", "validatePassword(this.id,'lblPword2')");
$input_wrapper .= $label->getLabel() . "<br>\n";
$input_wrapper .= $input->getInput() . "<br><br>\n";

$input->set_input("submit", "sumbmit", "Sign up", "", "update_button");
$input_wrapper .= $input->get_input() ."<br>\n";
echo $form->get_form_wrapper($input_wrapper);

function back_button($back_url)
{
    $form = new Form();
    $input = new Input();
    $out = "";
        //create a back button - which is actually a form - 
        $form->set_form($back_url, "POST", "");
        //$label->set_label("Click to Register new Student", "First Name", "");
        $input->set_input("submit", "back", "Back", "", "");
        echo $form->get_form_wrapper($input->get_input());
        //Above is the back button
    return $out;
}

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
        $input->set_input("submit", $button_name, $button_caption, "", "");
        $inputs .= $input->get_input() . "\n";
        $out =  $form->get_form_wrapper($inputs);
        //Above is the back button
    return $out;
}

?>