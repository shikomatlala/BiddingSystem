<?php
include_once "../class/form.php";
include_once "../../../connect.php";
include_once "../class/student.php";
include_once "../class/component.php";
echo header_html_("../../../style.css");
$form = new Form();
$input = new Input();
$label = new Label();
$student = new Student();
$div = new Div();
$input_wrapper = "";
echo "<h1>Create your account here</h1>\n<br><hr>";
//This is the back button - it is a functio which takes us back
echo back_button("../home/admin_portal.php");
echo "<h3 class=\"center_el\">Enter The Following Details and then Submit</h3>\n";

$form->set_form("createUser.php", "POST", "");
$input_wrapper .= newUser();
$input->setInput("submit", "createUser", "Create User", "", "update_button", "createUser", "", "");
//formtype="submit", submitto="createUser.php", buttonCaption="Create", buttonStyle="update_button", buttonID="createUser"
$input_wrapper .= $input->getInput() ."<br>\n";

$div->set_div("form_input", "");
echo $div->get_div($form->get_form_wrapper($input_wrapper));


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