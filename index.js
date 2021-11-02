function createAuction()
{
    //We need to be able to make sure that we can upload videos using javascript or something
    //Create a childiv and call the child Div createLiveStock   
    var inputStyle = "input_";
    var buttonInput = "update_button";
    var activityCard = document.getElementById("activityCard");

    var createLiveStock = document.createElement('div');
    var breakElment = document.createElement('br');
    createLiveStock.id = "createLiveStock";
    createLiveStock.style = "";
    createLiveStock.innerHTML = "Create Live Stock";
    activityCard.appendChild(createLiveStock);
    //Create input fields for stock information
    //The sex should validate on time - BUt we cannot ender the informatio so we are going to create a class since we cannot write the information directly into the database - So on exit we are going to input this information into the livestock class
    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Sex"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("sex", inputStyle, "sex", "Sex", "input", "text"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Breed"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("breed", inputStyle, "breed", "Breed", "input", "text"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Age"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("age", inputStyle, "age", "Age", "input", "text"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Ask Amount"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("askAmount", inputStyle, "askAmount", "Ask Amount", "input", "text"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Start Date"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("startDate", inputStyle, "startDate", "Start Date", "input", "date"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("End Date"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("endDate", inputStyle, "endDate", "End Date", "input", "date"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Time Out"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("timeOut", inputStyle, "timeOut", "timeOut", "input", "date"));

    breakEl(createLiveStock);
    createLiveStock.appendChild(createLabel("Bio"));
    breakEl(createLiveStock);
    createLiveStock.appendChild(createElement("bio", inputStyle, "bio", "Description of Livestock", "textarea", ""));
    breakEl(createLiveStock);

    breakEl(createLiveStock);
    var button = document.createElement('button');
    button.addEventListener('click', insertAuction);
    button.id = "createAution";
    button.className = buttonInput;
    button.innerHTML = "Create Auction";
    createLiveStock.appendChild(button);

    function createLabel(caption)
    {
        var label = document.createElement('label');
        label.innerHTML = caption;
        return label;
    }


    function createElement(elName, elStyle, elId, elPlaceholder, element, type)
    {
        var elInput = document.createElement(element);
        elInput.id = elId, 
        elInput.type = type;
        elInput.required = true;
        elInput.className = elStyle
        elInput.placeholder = elPlaceholder;
        elInput.name = elName;
        return elInput;
    }
    function breakEl(createLiveStock)
    {
        return  createLiveStock.appendChild(document.createElement('br'));
    }

}

class Livestock
{
    #sex= "";
    #breed = "";
    #age = "";
    #askAmount = "";
    #startDate;
    #endDate;
    #timeOut;
    #bio;

    // constructor(){}
    
    constructor(sex,breed,age,askAmount,startDate,endDate,timeOut,bio)
    {
        this.#sex = sex;
        this.#breed = breed;
        this.#age = age;
        this.#askAmount = askAmount;
        this.#startDate = startDate;
        this.#endDate = endDate;
        this.#timeOut = timeOut;
        this.#bio = bio;
    }

    setSex(sex)
    {
        this.#sex = sex;
    }
    getSex()
    {
        var livestock = "";
        livestock += this.#sex;
        livestock += this.breed;
        livestock += this.age;
        livestock += this.askAmount;
        return livestock;
    }


}


function insertAuction()
{

    //Now we can get all the values of the items taht we desire to get.
    alert(document.getElementById("sex").value);
    let livestock = new Livestock(document.getElementById("sex").value, document.getElementById("breed").value, document.getElementById("age").value, document.getElementById("askAmount").value);
    alert(livestock.getSex());

    // sex
    // breed
    // age
    // askAmount
    // startDate
    // endDate
    // timeOut
    // bio
    //We need to make sure that we can get all the information that we need and then from there we need to insert into the database.

}

//We need to start affresh to make sure that we are going to work on this properly
let pword1IsStrong = false;
let pword2IsStrong = false;
let pwordsIsMatch = false;

    //Create element variables  
let pword1El = document.getElementById("password");
let pword2El = document.getElementById("password2");
let pwordLabelEl1 = document.getElementById("lbl_password");
let pwordLabelEl2 = document.getElementById("lbl_password2");
function verify_delete()
{
    //We can also get the students details if we want do
    var answer = confirm("Are you Sure you want to delete " + "\nThis cation cannot be reversed");
    //var result = "";
    if(answer)
    {
        //Then proceed to deleting this person -- I am sure that we set the relevant things to deleting this person

    }
    else
    {
        //Then we need to do nothing
    }
}

function validate_search()
{
    //input element name is "search_stud_input"
    //button element name is "search_stud_button"
    
    let search_stud_input = document.getElementById("search_stud_input");
    let search_stud_button = document.getElementById("search_stud_button");
    if(Math.cos(search_stud_input.value))
    {
        //alert("I have been clicked");
        search_stud_button.disabled = false;
        search_stud_button.className = "submit_button";
    }
    else
    {
        //set input boarder-color to red
        search_stud_button.disabled = true;
        search_stud_button.className = "disable_button";
        alert("Student Number is a numeric value");
        //disable the search button
    }
    //make sure that the search is only digits -- how do we ensure that this is the case

}
function passwordStrength()
{
    //Check if characters are greater >= 8
    //Get element values
    if(pword1El.value === pword2El.value)
    {
        //Give this person a tick
        //Create a variable  for the tick
        // let img = document.createElement("img");
        //http://dsogroupingsystem.bitnamiapp.com/system_grouping/users/grouping_system/users/admin/home/admin_portal.php
        // img.src = "tick.png";
        // shikomatlala/JavaScript-Projects
        // img.width = 20;
        // img.setAttribute("width", 20);
        // img.setAttribute("heigh", 20);
        // img.setAttribute("margin-bottom", "10px");

        // let img2 = document.createElement("img");
        // img2.src = "tick.png";
        // img2.width = 20;
        // img2.setAttribute("width", 20);
        // img2.setAttribute("heigh", 20);
        // img2.setAttribute("margin-bottom", "10px");
        // let show_tick = document.getElementById("span_img");
        // let show_tick2 = document.getElementById("span_img2");
        // show_tick.replaceChild(img);
        // show_tick2.replaceChild(img2);
        //Tell the user that the password is good
        //Change the element to password match - make sure that the element is green
        pwordLabelEl1.textContent = "Passwords match";
        pwordLabelEl2.textContent = "Passwords match";
        //Now make sure that the color is green
        pwordLabelEl1.className = "lblMatch";
        pwordLabelEl2.className = "lblMatch";
        pwordsIsMatch = true;

    }
    else
    {
        pwordLabelEl1.className = "lblNotMatch";
        pwordLabelEl2.className = "lblNotMatch";
        pwordLabelEl1.textContent = "Passwords do not match";
        pwordLabelEl2.textContent = "Passwords do not match";
        pwordsIsMatch = false;
    }


    //Set the input text to be green when the password is strong.
    if(pword1El.value.length < 8 )
    {   
        pword1El.className = "input_weak";  
        pword1IsStrong = false;
    }
    else
    {
        pword1El.className = "input_strong";   
        pword1IsStrong = true;
    }

    if(pword2El.value.length < 8 )
    {   
        pword2El.className = "input_weak";
        pword2IsStrong = false; 
    }
    else
    {
        pword2El.className = "input_strong";  
        pword2IsStrong = true; 
    }
}
function display_result()
{
//     let pword1IsStrong = false;
// let pword2IsStrong = false;
// let pwordsIsMatch = false;

    if(pwordsIsMatch)
    {
        //Now test if the passwords are strong
        if(!pword2IsStrong && !pword1IsStrong)
        {
            pwordLabelEl2.textContent = "Password should contain 8 or more characters";
            pwordLabelEl1.textContent = "Password should contain 8 or more characters";
            pwordLabelEl1.className = "lblNotMatch";
            pwordLabelEl2.className = "lblNotMatch";
        }
    }
    else if(pword1El.value == "" && pword2El.value == "")
    {
        pwordLabelEl1.textContent = "Field is empty";
        pwordLabelEl2.textContent = "Field is empty";
    }
    else
    {
        //Tell the person that passwords do not match
        pwordLabelEl2.textContent = "Passwords do not match";
        pwordLabelEl1.textContent = "Passwords do not match";
        pwordLabelEl1.className = "lblNotMatch";
        pwordLabelEl2.className = "lblNotMatch";

    }
}

function viewGroups()
{
    if(document.getElementById("dsoGroups"))
    {
        document.getElementById("dsoGroups").remove();
    }

    //Create a new group which are going to use to display all the groups information
    let groupList = document.getElementById("groupList");
    groupList.style.display = "none";
    if(!document.getElementById("dsoGroups"))
    {
        // alert("TableFound");
            //Create a brand new table from the exisit data.
        //Now let us create a table with the group names. accordingly.
        let groupsTable = document.createElement('table');
        // groupsTable.className = "groupTable";
        groupsTable.id= "dsoGroups";
        // groupsTable.id = "testMe";
        groupsTable.style.width = "70%";
        groupsTable.className = "groupsTable";
        var hdrGroupName = document.createElement('th');
        var hdrStudCount = document.createElement('th');
        var hdrDeleteTable = document.createElement('th');
        var hdrshowMembers = document.createElement('th');
        var hdrExtraSpace = document.createElement('th');
        var headerRow = groupsTable.insertRow(0);

        hdrGroupName.innerHTML = "Group Name";
        headerRow.appendChild(hdrGroupName);
        hdrStudCount.innerHTML = "Total Students";
        headerRow.appendChild(hdrStudCount);
        hdrExtraSpace.innerHTML = "";
        headerRow.appendChild(hdrExtraSpace);
        hdrshowMembers.innerHTML = "View Members";
        headerRow.appendChild(hdrshowMembers);
        hdrDeleteTable.innerHTML = "Delete Group";
        headerRow.appendChild(hdrDeleteTable);
        // // console.log("view Groups clicked");
        // document.getElementById("button").addEventListener('click', loadGroups);
        // //Now the thing that I want to do is to make sure that when we click view delete groups we can get all this information that we re looking for overhere.
        // //Load DSO GROUPS
        // function loadGroups(){
        groupList.style.display = "none";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/dashboard/grouping_system/users/admin/lecturer/managegroup/posts/readAllGroups.php', true);
        xhr.onload = function()
        {
            if(this.status = 200)
            {
                var groups = JSON.parse(this.responseText);

                // console.log(groups);
                //OUTPUT THE INFORMATION TO THE BROWSER
                // var output = '';
                // output += '<ul>';
                for(var i in groups)
                {

                    // // output +='<li>' + groups[i].group_id+ ' | ' + groups[i].group_name + '</li>';


                    //Create the groups so that it corresponds with what we want to have it correspond with.
                    var y = +i + 1;
                    var row = groupsTable.insertRow(y);
                    row.id = groups[i].group_id;
                    // <a data-testid="linkElement" href="https://www.instagram.com/isizweagency/" target="_blank"  rel="nofollow noopener"><img src="instagram.webp" alt="Isizwe Recruitment Agency"></a>
                    // var aTag = document.createAttribute('a');
                    //Let us now create the cells that we are going to use in our group table
                    var cellGroupName = row.insertCell(0);
                    var celltotalStudents = row.insertCell(1);
                    var extraSpace = row.insertCell(2);
                    var deleteButton = document.createElement("button"); //The delete button for the group.
                    var openRows = row.insertCell(3);
                    var deleteCell = row.insertCell(4);
                    //We can make this get information from the database.
                    //Add information to the cells that we just created
                    cellGroupName.innerHTML = groups[i].group_name;
                    celltotalStudents.innerHTML = groups[i].count_member;
                    deleteButton.id = "del-" + i;
                    deleteButton.addEventListener('click', deleteGroup);
                    deleteButton.className = "delete_button";
                    deleteButton.innerHTML = "Delete Group";
                    deleteCell.appendChild(deleteButton);
                    openRows.id = "openRow"+ i;
                    extraSpace.innerHTML = "";
                    var imgTag = document.createElement("img");
                    imgTag.src = "../../../icons/add_black_24dp.svg";
                    //let us make the image size to be very small
                    imgTag.style.width = "25px";
                    imgTag.style.height = "auto";
                    imgTag.style.cursor = "pointer";
                    imgTag.id = 'imgID-' + groups[i].group_id;
                    imgTag.addEventListener('click', showMembers);
                    imgTag.addEventListener('mouseover', rotateElement);
                    imgTag.addEventListener('mouseout', unrotateElement);
                    //Now let us create an onclick even for this button so that when we click it we get to see all the members that are in this group.
                    //Now the question how can we make sure that we can do this?
                    //Can we even spin this tag or rather can we even rotate it?
                    openRows.appendChild(imgTag);  
                    document.body.appendChild(groupsTable);

                    


                }
            }
        }


        xhr.send();
    }
    else
    {
        document.getElementById("dsoGroups").style.display = "inline-block";
        document.getElementById("dsoGroups").style.marginLeft = "auto";
        document.getElementById("dsoGroups").style.marginRight = "auto";
    }
}

function unrotateElement()
{
    // this.style.width = "25px";
    // this.style.height = "auto";
    this.style.transform = "rotate(0deg)";
    this.style.transition = duration = "1s";

}

function addStudent()
{
    //Well firslty all we need to make sure that we can remove everything that is on the page before we can jump on to adding student.
    //And the interesting thing about it is that we are not always going to know what we stop displaying.
    alert("add student");
    //We can work with the same table ID all the time - 
    //So let us delete the table whole table first.
    let groupList = document.getElementById("groupList");
    groupList.style.display = "none";
    //Remove only if this exists
    if(document.getElementById("dsoGroups"))
    {
        document.getElementById("dsoGroups").remove();
    }


    //Cool now we want to recreate the same table again
    if(!document.getElementById("dsoGroups"))
    {
        // alert("TableFound");
            //Create a brand new table from the exisit data.
        //Now let us create a table with the group names. accordingly.
        let groupsTable = document.createElement('table');
        // groupsTable.className = "groupTable";
        groupsTable.id= "dsoGroups";
        // groupsTable.id = "testMe";
        groupsTable.style.width = "85%";
        groupsTable.className = "groupsTable";
        var hdrGroupName = document.createElement('th');
        var hdrStudCount = document.createElement('th');
        var hdrDeleteTable = document.createElement('th');
        var hdrshowMembers = document.createElement('th');
        var hdrExtraSpace = document.createElement('th');
        var hdrAddStudent = document.createElement('th');
        var headerRow = groupsTable.insertRow(0);

        hdrGroupName.innerHTML = "Group Name";
        headerRow.appendChild(hdrGroupName);
        hdrStudCount.innerHTML = "Total Students";
        headerRow.appendChild(hdrStudCount);
        hdrExtraSpace.innerHTML = "";
        headerRow.appendChild(hdrExtraSpace);
        hdrDeleteTable.innerHTML = "";
        headerRow.appendChild(hdrDeleteTable);
        hdrshowMembers.innerHTML = "Show Members";
        headerRow.appendChild(hdrshowMembers);
        hdrAddStudent.style.width = "1%";
        hdrAddStudent.innerHTML = "";
        headerRow.appendChild(hdrAddStudent);
        // // console.log("view Groups clicked");
        // document.getElementById("button").addEventListener('click', loadGroups);
        // //Now the thing that I want to do is to make sure that when we click view delete groups we can get all this information that we re looking for overhere.
        // //Load DSO GROUPS
        // function loadGroups(){
        groupList.style.display = "none";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/dashboard/grouping_system/users/admin/lecturer/managegroup/posts/readAllGroups.php', true);
        xhr.onload = function()
        {
            if(this.status = 200)
            {
                var groups = JSON.parse(this.responseText);

                // console.log(groups);
                //OUTPUT THE INFORMATION TO THE BROWSER
                // var output = '';
                // output += '<ul>';
                for(var i in groups)
                {

                    // // output +='<li>' + groups[i].group_id+ ' | ' + groups[i].group_name + '</li>';


                    //Create the groups so that it corresponds with what we want to have it correspond with.
                    var y = +i + 1;
                    var row = groupsTable.insertRow(y);
                    row.id = groups[i].group_id;
                    // <a data-testid="linkElement" href="https://www.instagram.com/isizweagency/" target="_blank"  rel="nofollow noopener"><img src="instagram.webp" alt="Isizwe Recruitment Agency"></a>
                    // var aTag = document.createAttribute('a');
                    //Let us now create the cells that we are going to use in our group table
                    var cellGroupName = row.insertCell(0);
                    var celltotalStudents = row.insertCell(1);
                    var extraSpace = row.insertCell(2);
                    var deleteButton = document.createElement("button"); //The delete button for the group.
                    var deleteCell = row.insertCell(3);
                    var openRows = row.insertCell(4);
                    var cellAddStudent = row.insertCell(5);
                    //We can make this get information from the database.
                    //Add information to the cells that we just created
                    cellGroupName.innerHTML = groups[i].group_name;
                    celltotalStudents.innerHTML = groups[i].count_member;
                    deleteButton.id = "del-" + i;
                    deleteButton.addEventListener('click', deleteGroup);
                    deleteButton.className = "delete_button";
                    deleteButton.innerHTML = "Delete Group";
                    // deleteCell.appendChild(deleteButton);
                    openRows.id = "openRow"+ i;
                    extraSpace.innerHTML = "";
                    var imgTag = document.createElement("img");
                    imgTag.src = "../../../icons/add_black_24dp.svg";
                    var imgAddStudent = document.createElement("img");
                    imgAddStudent.src = "../../../icons/add_black_24dp.svg";
                    //let us make the image size to be very small
                    imgTag.style.width = "25px";
                    imgTag.style.height = "auto";
                    imgTag.style.cursor = "pointer";


                    imgTag.id = 'imgID-' + groups[i].group_id;
                    imgTag.addEventListener('click', showMembersInAddStudent);
                    imgTag.addEventListener('mouseover', rotateElement);
                    imgTag.addEventListener('mouseout', unrotateElement);

                    imgAddStudent.style.width = "25px";
                    imgAddStudent.style.height = "auto";
                    imgAddStudent.style.cursor = "pointer";
                    imgAddStudent.id = 'imgAddId-' + groups[i].group_id;
                    //Now let us create an onclick even for this button so that when we click it we get to see all the members that are in this group.
                    //Now the question how can we make sure that we can do this?
                    //Can we even spin this tag or rather can we even rotate it?
                    openRows.appendChild(imgTag);  
                    cellAddStudent.appendChild(imgAddStudent);
                    document.body.appendChild(groupsTable);

                }
            }
        }


        xhr.send();
    }
}

function rotateElement()
{
    //Cool now let us rotate this element
    //alert(this.id);
    //Let us now rotate the element
    this.style.transform = "rotate(90deg)";
    this.style.transition = duration = "0.25s";
    // this.style.height = "auto";
}

var tableStatus = false;//Now this table status should be for a specific table and for every other table.

function showMembersInAddStudent(e)
{
    // alert("You have clicked me" + this.id);
    // var showMembersEl = document.getElementById(this.id);
    var showMembersEl = document.getElementById(this.id);
    var rowNumber = showMembersEl.parentElement.parentElement.rowIndex;
    if(!document.getElementById("tableRow-" + showMembersEl.id + 0))
    {
        //Now we need to make sure that if the element has been clicked we can remove it. how can we do that?
        this.style.transform = "rotate(45deg)";
        var parentElementID = this.id;
        //What do we need to show our members?
        //We need the group ID - Now where can we get the groupid?
        //Now we want to create rows for this part or our table.
        //Now the one thing that I am struggling with is to know which element want parts we want to have shown in our tables.
        //But we feel like we might just be able to work on this.
        //
        //Create a post request
        e.preventDefault();
        // var name = document.getElementById('')
        var xhr = new XMLHttpRequest();
        var params = "group_id="+this.id;
        xhr.open('POST', 'http://localhost/dashboard/grouping_system/users/admin/lecturer/managegroup/posts/postGroupMembersWhere.php', true);
        //Pass the information - but then again how can we get the request that we are looking for?
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function()
        {
            // console.log(this.responseText);
            //Now we need to find  a way to get all of this information for our own use
            //let us create a table.
            //Now that we have the row ID we need to make sure that we can take this ID and then using this ID we need to create a child table but it will be incremented inside this row.
            let groupMembersTable = document.createElement('table');
            groupMembersTable.id = "dsoGroups"+parentElementID; //now the group ID needs to be unique, how can we make sure that we create a group id that is unique?/
            //Well remember we have the element Id


            //What do we have here?
            if(this.status = 200)
            {
                var groupMembers = JSON.parse(this.responseText);

                // console.log(groups);
                //OUTPUT THE INFORMATION TO THE BROWSER
                var myTable = document.getElementById("dsoGroups");
                var row = myTable.tBodies[0].insertRow(+rowNumber + 1);//We need to get the row id?
                row.className = "tableRow";
                row.id = "tableRow-" + showMembersEl.id + 0;

                var hdrGroupName = document.createElement('th');
                var hdrStudNumber = document.createElement('th');
                var hdrFirstName = document.createElement('th');
                var hdrLastName= document.createElement('th');
                var hdrGender= document.createElement('th');
                var hdrAddStudent = document.createElement('th');

                var headerRow = groupMembersTable.insertRow(0);
                

                hdrGroupName.innerHTML = "Group ID";
                row.appendChild(hdrGroupName);
                hdrStudNumber.innerHTML = "Stud Number";
                row.appendChild(hdrStudNumber);
                hdrFirstName.innerHTML = "Group Name";
                row.appendChild(hdrFirstName);
                hdrLastName.innerHTML = "Group Member ID";
                row.appendChild(hdrLastName);
                hdrGender.innerHTML = "Member Mark";
                row.appendChild(hdrGender);
                hdrAddStudent.innerHTML = "";
                row.appendChild(hdrAddStudent);

                for(var i in groupMembers)
                {
                    //But we need to make an extra row - and then use this extra row to show students that are not grouped.
                    row = myTable.tBodies[0].insertRow(+rowNumber + 2 + +i);
                    row.className = "tableRow";
                    var rowIdIncrementer = +i + +1;
                    row.id = "tableRow-" + showMembersEl.id +  rowIdIncrementer;
                    var tdGroupName = document.createElement('td');
                    var tdStudNumber = document.createElement('td');
                    var tdFirstName = document.createElement('td');
                    var tdLastName= document.createElement('td');
                    var tdGender= document.createElement('td');
                    tdGroupName.innerHTML = groupMembers[i].group_id;
                    row.appendChild(tdGroupName);
                    tdStudNumber.innerHTML = groupMembers[i].stud_number;
                    row.appendChild(tdStudNumber);
                    tdFirstName.innerHTML = groupMembers[i].group_name;
                    row.appendChild(tdFirstName);
                    tdLastName.innerHTML = groupMembers[i].group_member_id;
                    row.appendChild(tdLastName);
                    tdGender.innerHTML = groupMembers[i].member_mark;
                    row.appendChild(tdGender);
                    //Add an extra row - 

                }
                var imgAddStudent = document.createElement("img");
                imgAddStudent.src = "../../../icons/add_black_24dp.svg";
                imgAddStudent.style.width = "25px";
                imgAddStudent.style.height = "auto";
                imgAddStudent.style.cursor = "pointer";
                imgAddStudent.id = 'imgAddId-' + groups[i].group_id;
                row.appendChild(imgAddStudent);
            }
        }
        xhr.send(params);
    }
    else
    {
        var imgEl = showMembersEl.parentElement.parentElement.id;
        var groupMembersStartingChildId = document.getElementById(imgEl).cells[4].children[0].id;
        var x= 0;
        var childrenID = "tableRow-" + groupMembersStartingChildId + x;
        while(document.getElementById(childrenID))
        {
            document.getElementById(childrenID).remove();
            x++;
            childrenID = "tableRow-" + groupMembersStartingChildId + x;
        }
    }
}

function showMembers(e)
{
    // alert("You have clicked me" + this.id);
    // var showMembersEl = document.getElementById(this.id);
    var showMembersEl = document.getElementById(this.id);
    var rowNumber = showMembersEl.parentElement.parentElement.rowIndex;
    if(!document.getElementById("tableRow-" + showMembersEl.id + 0))
    {
        //Now we need to make sure that if the element has been clicked we can remove it. how can we do that?
        this.style.transform = "rotate(45deg)";
        var parentElementID = this.id;
        //What do we need to show our members?
        //We need the group ID - Now where can we get the groupid?
        //Now we want to create rows for this part or our table.
        //Now the one thing that I am struggling with is to know which element want parts we want to have shown in our tables.
        //But we feel like we might just be able to work on this.
        //
        //Create a post request
        e.preventDefault();
        // var name = document.getElementById('')
        var xhr = new XMLHttpRequest();
        var params = "group_id="+this.id;
        xhr.open('POST', 'http://localhost/dashboard/grouping_system/users/admin/lecturer/managegroup/posts/postGroupMembersWhere.php', true);
        //Pass the information - but then again how can we get the request that we are looking for?
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function()
        {
            // console.log(this.responseText);
            //Now we need to find  a way to get all of this information for our own use
            //let us create a table.
            //Now that we have the row ID we need to make sure that we can take this ID and then using this ID we need to create a child table but it will be incremented inside this row.
            let groupMembersTable = document.createElement('table');
            groupMembersTable.id = "dsoGroups"+parentElementID; //now the group ID needs to be unique, how can we make sure that we create a group id that is unique?/
            //Well remember we have the element Id
            groupMembersTable.style.width = "inherit";
            //What do we have here?
            if(this.status = 200)
            {
                var groupMembers = JSON.parse(this.responseText);

                // console.log(groups);
                //OUTPUT THE INFORMATION TO THE BROWSER
                var myTable = document.getElementById("dsoGroups");
                var row = myTable.tBodies[0].insertRow(+rowNumber + 1);//We need to get the row id?
                row.className = "tableRow";
                row.id = "tableRow-" + showMembersEl.id + 0;

                var hdrGroupName = document.createElement('th');
                var hdrStudNumber = document.createElement('th');
                var hdrFirstName = document.createElement('th');
                var hdrLastName= document.createElement('th');
                var hdrGender= document.createElement('th');
                var headerRow = groupMembersTable.insertRow(0);

                hdrGroupName.innerHTML = "Group ID";
                row.appendChild(hdrGroupName);
                hdrStudNumber.innerHTML = "Stud Number";
                row.appendChild(hdrStudNumber);
                hdrFirstName.innerHTML = "Group Name";
                row.appendChild(hdrFirstName);
                hdrLastName.innerHTML = "Group Member ID";
                row.appendChild(hdrLastName);
                hdrGender.innerHTML = "Member Mark";
                row.appendChild(hdrGender);

                for(var i in groupMembers)
                {
                    row = myTable.tBodies[0].insertRow(+rowNumber + 2 + +i);
                    row.className = "tableRow";
                    var rowIdIncrementer = +i + +1;
                    row.id = "tableRow-" + showMembersEl.id +  rowIdIncrementer;
                    var tdGroupName = document.createElement('td');
                    var tdStudNumber = document.createElement('td');
                    var tdFirstName = document.createElement('td');
                    var tdLastName= document.createElement('td');
                    var tdGender= document.createElement('td');
                    tdGroupName.innerHTML = groupMembers[i].group_id;
                    row.appendChild(tdGroupName);
                    tdStudNumber.innerHTML = groupMembers[i].stud_number;
                    row.appendChild(tdStudNumber);
                    tdFirstName.innerHTML = groupMembers[i].group_name;
                    row.appendChild(tdFirstName);
                    tdLastName.innerHTML = groupMembers[i].group_member_id;
                    row.appendChild(tdLastName);
                    tdGender.innerHTML = groupMembers[i].member_mark;
                    row.appendChild(tdGender);

                }
            }
        }
        xhr.send(params);
    }
    else
    {
        var imgEl = showMembersEl.parentElement.parentElement.id;
        var groupMembersStartingChildId = document.getElementById(imgEl).cells[3].children[0].id;
        var x= 0;
        var childrenID = "tableRow-" + groupMembersStartingChildId + x;
        while(document.getElementById(childrenID))
        {
            document.getElementById(childrenID).remove();
            x++;
            childrenID = "tableRow-" + groupMembersStartingChildId + x;
        }

        // var groupMembersStartingChildId = document.getElementById(imgEl).cells[4].children[0].id;
        // var childrenID = "tableRow-" + groupMembersStartingChildId + x;
        // while(document.getElementById(childrenID))
        // {
        //     document.getElementById(childrenID).remove();
        //     x++;
        //     childrenID = "tableRow-" + groupMembersStartingChildId + x;
        // }

    }
}


function deleteGroup(e)
{
    // var imgEl = showMembersEl.parentElement.parentElement.id;


    //Now the goal is to be able to also delete everything inside of this group as well - we want to be able to delete this group on demand
    var childButton = document.getElementById(this.id);
    var showMembersEl = document.getElementById(this.id);

    var imgEl = showMembersEl.parentElement.parentElement.id;
    var groupMembersStartingChildId = document.getElementById(imgEl).cells[3].children[0].id;
    var rowIndex = childButton.parentElement.parentElement.rowIndex;
    var parentRow = childButton.parentElement.parentElement;
    var groupName = parentRow.cells[0].innerText;
    //Now let us try to show the group that is being deleted
    e.preventDefault();
    var answer = confirm("Are you Sure you want to delete \"" + groupName + "\"" +  "\nThis cation cannot be reversed");
    if(answer)
    {
        //Then proceed to deleting this person -- I am sure that we set the relevant things to deleting this person
        //Now we need to make sure that we can delete 
        //Fistly we need to make sure that we delete the whole table.

        var xhr = new XMLHttpRequest();
        var params = "group_id=" + this.id.substr(4);
        xhr.open('POST', 'http://localhost/dashboard/grouping_system/users/admin/lecturer/managegroup/delete/deleteAGroup.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // xhr.onload = function()
        // {
        //     console.log(this.responseText);
        // }
        xhr.send(params);
        //now the goal is to get the row index so that we can delete the row that we want to delete.
        var x= 0;
        var childrenID = "tableRow-" + groupMembersStartingChildId + x;
        while(document.getElementById(childrenID))
        {
            document.getElementById(childrenID).remove();
            x++;
            childrenID = "tableRow-" + groupMembersStartingChildId + x;
        }

        document.getElementById("dsoGroups").children[0].children[rowIndex].remove();
        //Remove child rows 
        var x = 0;

        // if(!document.getElementById("tableRow-" + showMembersEl.id + 0))
    }

}




function deleteRow(buttonID)
{
    // why dont I add the event hin here
    //table.children;
    //table.childNodes:NodeList
    //table.NodeList;
    //table.children
    //table.childNodes[1];
    //table.childNodes[1].children;
    //Now the question is how can we find the link of the button to know which button we want use.
    //Well we can find out which button which button is hit.
    //The one thing that we can do to be able to do this is know the position of the button in the table.
    //Now how can we know the position of the button in the table - Now remember that knowing the position or the location of the button we can find every other element in the same location
    //But remember every row has a number - now we can make use of that number to get the button.
    //firstly get the row number - but yet again how are we going to know this?
    //Well remember that we want to delete a row.
    //Now let us make sure that we delete from the last row?

    //But ye again - why should'nt we communicate with the server each time we make an insert and a delete?
    //Well another question is this, so far we learn that the one shared method is actually the even listener method, then at that point we can be able to use the 'this' pointer which is going to point to the variable that we want

    // var buttonClicked = document.getElementById("deleteRow");
    // buttonClicked.addEventListener("click", function(e){
    //     alert("Button ID: " + this.id);
    //     //Now remember after we get the button ID - what do we want to do this - How about we go up - and find the siblings of this button - 
    
    // });
    // this.addEventListener('click',function(){
    // alert(buttonID);
    var myID = buttonID;
    var pos = myID.indexOf("-");
    myID = myID.substr(pos+1);
    // alert(myID);
    // alert(pos);
    // })
    // alert(document.getElementById("myTable"))
    // alert(this.id);
    //now the question is which object are we calling?
    //because every object has an id//
    //but remember we are calling an object whihc is currently making use of the function - now which object is that?

    var table = document.getElementById("myTable");
    //This gives us the last row NB: Remember that the first row is a header - I do not know if it functions as a header -
    //But here is something interesting is the length the index or is it the count?
    //Yes in javascript table.deleteRow() //the deleteRow() function takes row index as a function so index 0 is normaly the table header
    //Now that we can get the ID - let us delete the element based upon the ID
    if(table.rows.length > 0)
    {
        table.deleteRow(myID);
    }
}


//Create an array that is going to dispaly hold all the displays
//Create an object
// let signup_labels= {
//     lbl_staffNum: "Staff Number",
//     lbl_idNum: "ID Number",
//     lbl_password: "Password ",
//     lbl_password2: "Password"
//     //create elements that will be embeded in this class
// }
// let signup_inputs = {
//     //Test if our elements are OK
//     //Test if the 
// }
// //elements
// //Confirm the two result to make sure that they do work.
// let x = "Shiko";
// //Now the goal is display all these elements into our htmls
// //Now let us make sure that the password is over 8 digits
// //change the color of the input.



// function display_result()
// {

//     document.getElementById("lbl_staffNum").textContent = signup_labels.lbl_staffNum;
//     document.getElementById("lbl_idNum").textContent = signup_labels.lbl_idNum;
//     pw1El.textContent = signup_labels.lbl_password;
//     pw2El.textContent = signup_labels.lbl_password2;
//     pw1El.class = "input_strong";
// }

// function passwordStrength()
// {



//     let inputPwordElementP1 =  document.getElementById("password");
//     let inputPwordElementP2 = document.getElementById("password2");
//     //Show the color red if the password length is not greater less than 8
//     //Now how can we confrol the css - Well we firstly need to create the CSS
//     if(inputPwordElementP1.value.length < 8)
//     {
//         inputPwordElementP1.className = "input_weak";

//     }
//     //But if there is nothing such as special character then we should give him a yellow view
//     else if(inputPwordElementP1.value.length >= 8)
//     {
//         inputPwordElementP1.className = "input_strong";

//     }


//     if(inputPwordElementP2.value.length < 8)
//     {
//         inputPwordElementP2.className = "input_weak";
//     }
//     //But if there is nothing such as special character then we should give him a yellow view
//     else if(inputPwordElementP2.value.length >= 8)
//     {
//         inputPwordElementP2.className = "input_strong";
//     }
//     let pw1El = document.getElementById("lbl_password");
//     let pw2El = document.getElementById("lbl_password2");

//     let p1 = document.getElementById("password").value;
//     let p2 = document.getElementById("password2").value;
//     if(validatePassword(p1) && validatePassword(p2))
//     {
//         confirm_passwords();
//     }
//     else
//     {
//         signup_labels.lbl_password = "Password should contain 8 or more digits";
//         signup_labels.lbl_password2 = "Password should contain 8 or more digits";
//     }
    
// }

// function validatePassword(p)
// {
//     //test the length of the string
//     if(p.length < 8)
//     {
//         return false;
//     }
//     else
//     {
//         return true;
//     }
// }
// function confirm_passwords()
// {
//     //Now we need to get the values of pwrd 1 and pword2
//     if(p1 === p2)
//     {
//         var img = document.createElement("img");
//         img.src = "tick.png";
//         img.width = 20;
//         var src = document.getElementById("span_img");
//         src.appendChild(img);
//         //Then here we want to say that our passwords are correct and that they do  match
//         signup_labels.lbl_password = "Good";
//         signup_labels.lbl_password2 = "Good";
//     }
//     else
//     {
//         signup_labels.lbl_password = "Password Does not Match";
//         signup_labels.lbl_password2 = "Password Does not Match";
//     }
// }
// var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
// document.write(format.test("My@string-with(some%text)") + "<br/>");
// document.write(format.test("My string with spaces") + "<br/>");
// document.write(format.test("MyStringContainingNoSpecialChars"));
/*
var x = document.getElementById("pword1");
undefined
x.value;
'Shiko'
    var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
undefined
format;
/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/
format.test(x.value);
false
x.value = "9900xxw2&2!!";
'9900xxw2&2!!'
format.test(x.value);
true
var lblPassword = document.getElementById("lblPword1");
undefined
lblPassword.style.color = "Green";
'Green'

*/
//=================================
//Ensure that the gender entered is correct.
//======================================
function validatePassword(pword, lblPword)
{
    var p1 = document.getElementById("pword1");
    var lblP1 = document.getElementById("lblPword1");
    checkPassword(pword, lblPword);
    var password = document.getElementById("pword2");
    var lblPassword = document.getElementById("lblPword2");
    if(password.value != p1.value)
    {
        //p1.style.color= "red";
        //p1.innerHTML = "Passwords do not Match";    
        lblPassword.style.color= "red";
        lblPassword.innerHTML = "Passwords do not Match";
        lblP1.style.color = lblPassword.style.color;
        lblP1.innerHTML = lblPassword.innerHTML;
    }
    else if( checkPassword(pword, lblPword) > 0)
    {
        lblPassword.style.color= "green";
        lblPassword.innerHTML = "Password";
        lblP1.style.color = lblPassword.style.color;
        lblP1.innerHTML = lblPassword.innerHTML;

    }
}
function checkPassword(pword, lblPword)
{
    // alert(lblPword);
    // alert(pword);
    var returnValue = 0;
    var numFound = 0;
    var specialCharacterFound = 0;
    var alphaFound = 0;
    var password = document.getElementById(pword);
    var lblPassword = document.getElementById(lblPword);
    password.value = password.value.trim();
    if(password.value.length >= 8)
    {  
        //Check if the password is strong or weak
        //Check if special characters are there.
        var specialCharFormat = /[`!@#$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        var numFormat = /[012345789]/;
        var alphaFormat = /[a-zA-Z]/i;
        if(alphaFormat.test(password.value))   
        {
            lblPassword.style.color= "grey";
            lblPassword.innerHTML = "Weak password";
            returnValue = 1;
            //document.write(format.test("My string with spaces"))
            if(numFormat.test(password.value))
            {
                lblPassword.style.color= "grey";
                lblPassword.innerHTML = "OK password";
                returnValue = 2;
                if(specialCharFormat.test(password.value))
                {
                    lblPassword.style.color= "green";
                    lblPassword.innerHTML = "Strong password ";
                    returnValue = 3;
                }
            }
        }
        else
        {
            lblPassword.style.color= "red";
            lblPassword.innerHTML = "Invalid Password";
            returnValue = 0;
        }
        //document.write(format.test("MyStringContainingNoSpecialChars"));

    }
    else
    {
        lblPassword.style.color= "red";
        lblPassword.innerHTML = "Password Must Contain 8 or more characters";
        returnValue = 0;
    }
    return returnValue;
}

// disableButton("createAdmin", "true");
function validateName(nameID, lblID)
{
    //Check if the password is strong or weak
    //Check if special characters are there.
    var fname = document.getElementById(nameID);
    // alert(nameID);
    var lblName = document.getElementById(lblID);
    fname.value = fname.value.trim();
    var specialCharFormat = /[`!@#$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var numFormat = /[012345789]/;
    // var alphaFormat = /[a-zA-Z]/i;
    if(specialCharFormat.test(fname.value) || numFormat.test(fname.value))   
    {
        lblName.style.color = "red";
        lblName.innerHTML = "Invalid Name"

        // lblPassword.style.color= "grey";
        // lblPassword.innerHTML = "Weak password";
        // returnValue = 1;
        // //document.write(format.test("My string with spaces"))
        // if(numFormat.test(password.value))
        // {
        //     lblPassword.style.color= "grey";
        //     lblPassword.innerHTML = "OK password";
        //     returnValue = 2;
        //     if(specialCharFormat.test(password.value))
        //     {
        //         lblPassword.style.color= "green";
        //         lblPassword.innerHTML = "Strong password ";
        //         returnValue = 3;
        //     }
        // }
    }
    else
    {
        // lblPassword.style.color= "red";
        // lblPassword.innerHTML = "Invalid Password";
        // returnValue = 0;
        lblName.style.color = "green";
        lblName.innerHTML = "Name";
    }



    // //trim
    // var name = document.getElementById(nameID);

    // name.value = name.value.trim();
    // lblName = document.getElementById(lblID);
    // //Make sure that there is no number
    // if(checkIDString(name.value))
    // {
    //     lblName.style.color = "red";
    //     lblName.innerHTML = "Invalid Name"

    // }
    // else
    // {
    //     lblName.style.color = "green";
    //     lblName.innerHTML = "Name";
    // }

}
//1 Get the two gender elements
//2 Make sure that the genders do actually match - So then we can call this function throughout.
// Hi there how are you 

function validatePhone()
{

    function invalidPhone(lblPhone)
    {
        //Pone number should not contain anything but number.
        lblPhone.style.color = "red";
        lblPhone.innerText = "Invalid Phone Number";
    }

    var specialCharFormat = /[`!@#$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var alphaFormat = /[a-zA-Z]/i;
    //The first digit should be a zero- 
    //The second digits should can be anything really 
    //This should only be numbers
    var phone = document.getElementById("phone");
    phone.value  = phone.value.trim();
    var lblPhone = document.getElementById("lblPhone");
    if(phone.value.length != 0)
    {
        //Phone
        //Ensure that the first value is a zero
        if(phone.value[0] != 0)
        {
            //Invalid phone number phone should start with 0
            invalidPhone(lblPhone);
        }
        else
        {
            //Make sure that the second digit is not 0
            //Make sure that the phone number does not include a non number value
            //We have already trimmed the string now we need to make sure that we 
            if(specialCharFormat.test(phone.value) || alphaFormat.test(phone.value))
            {

                invalidPhone(lblPhone);
            }
            else
            {
                if(phone.value.length != 10)
                {
                    invalidPhone(lblPhone);
                }
                else if(phone.value[1] != 0)
                {
                    lblPhone.style.color = "green";
                    lblPhone.innerText = "Phone Number";                   
                }
            }

            // if(!checkIDString(phone.value))
            // {
            //     //Pone number should not contain anything but number.
            //     invalidPhone(lblPhone);
            // }
            // else if(phone.value.length != 10)
            // {
            //     //Pone number should not contain anything but number.
            //     invalidPhone(lblPhone);
            // }
            // else
            // {
            //     //Pone number should not contain anything but number.
            //     if(phone.value[1] != 0)
            //     {
            //         lblPhone.style.color = "green";
            //         lblPhone.innerText = "Phone Number";
            //     }
            // }
        }
    }
    else
    {
        lblPhone.style.color = "red";
        lblPhone.innerText = "Phone Number Empty";
    }
}



function validate_id()
{

    

    //alert("Hit");
    //The first thing that we should do is to make sure that we trim the spaces
    var id_nr = document.getElementById("id_nr");
    var sex = document.getElementById("sex").value;
    var gender = "";
    id_nr.value  = id_nr.value.trim();

    var specialCharFormat = /[`!@#$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var numFormat = /[012345789]/;
    var alphaFormat = /[a-zA-Z]/i;
    if(alphaFormat.test(id_nr.value) || specialCharFormat.test(id_nr.value))
    {
        document.getElementById("lblId_nr").style.color = "red";
        document.getElementById("lblId_nr").innerHTML = "Invalid ID";
    }
    else
    {
        // alert(alphaFormat.test(id_nr.value));
        // alert(specialCharFormat.test(id_nr.value));
        if(id_nr.value.length != 13)//|| Number.isInteger(document.getElementById("id_nr").value))
        {
            if(checkIDString(id_nr.value))
            {
                //alert("Number");
                document.getElementById("lblId_nr").style.color = "red";
                document.getElementById("lblId_nr").innerHTML = "Invalid ID Length";
            }
            else
            {
                //alert("Bad");
                document.getElementById("lblId_nr").style.color = "red";
                document.getElementById("lblId_nr").innerHTML = "Invalid ID";
            }
            ///Set the text boarder to red
            //id_nr.style.borderColor = "red";

        }
        else if(id_nr.value.length == 13 && stringContainsNumber(id_nr.value))
        {
            if(checkIDString(id_nr.value))
            {
                id_nr.style.borderColor = "grey";
                document.getElementById("lblId_nr").style.color = "green";
                document.getElementById("lblId_nr").innerHTML = "ID Number";
                //Check if the gender and the ID match
                //subtring the ID get the gender from it.
                var gender_id = id_nr.value.substr(6, 4);
                if(gender_id > 4999 && gender_id <= 9999 )
                {
                    gender = "M";
                    //Then the person is make - then we need to 
                    if(sex == gender)
                    {
                        //alert(sex + " == " + gender)
                        document.getElementById("lblSex").style.color = "green";
                        document.getElementById("lblSex").innerHTML = "Sex";  
                        
                    }
                    else
                    {
                        //alert(sex + " != " + gender)
                        //Gender does not match - now you we need to show this to the user with the color red.
                        document.getElementById("lblSex").style.color = "red";
                        document.getElementById("lblSex").innerHTML = "Sex does not match ID";
                    }
                }
                else
                {
                    if(sex == "M")
                    {
                        document.getElementById("lblSex").style.color = "red";
                        document.getElementById("lblSex").innerHTML = "Sex does not match ID";
                    }
                    else
                    {
                        document.getElementById("lblSex").style.color = "green";
                        document.getElementById("lblSex").innerHTML = "Sex";  
                    }
        
                }
            }
        }
    }
}

function disableButton(btnID, isDisabled)
{
    document.getElementById(btnID).disabled = isDisabled;
}

function checkIDString(id_nr)
{
    
    //Make sure that its months are added
    //subtring the ID form for the months.
    //make sure that all characters are numbers.
    var isGood;
    for(var x = 0; x < id_nr.length; x++)
    {
        //Check the date and the month
        if(id_nr.length > 6)
        {
            //Check if the month is right
            var month = id_nr[2] + "" + id_nr[3];
            if(month > 12 || month < 1)
            {
                return false;
            }
            //Check for the date
            var day = id_nr[4] + id_nr[5];
            if(day > 31 || day < 1)
            {
                return false;
            }
        }
    }
    return true;
}
function stringContainsNumber(_input)
{
    let string1 = String(_input);
    for( let i = 0; i < string1.length; i++){
        if(!isNaN(string1.charAt(i)) && !(string1.charAt(i) === " ") ){
          return true;
        }
    }
    return false;
}