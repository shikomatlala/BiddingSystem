// ----------------------------------------
//GLOBAL VARIABLES FOR THE ENTIRE PROCESS 
//========================================
class Livestock{
    constructor(){}
    setLiveStoct(sex,name,breed,age,askAmount, startDate,endDate, timeout,bio) {
        this.sex = sex;
        this.breed = breed;
        this.age = age;
        this.name = name;
        this.askAmount = askAmount;
        this.startDate = startDate;
        this.endDate = endDate;
        this.timeOut = timeout;
        this.bio = bio;
    }
    setSex(sex){
        this.sex = sex;
    }
    getSex(){
        var livestock = "";
        livestock += this.sex;
        livestock += this.breed;
        livestock += this.age;
        livestock += this.askAmount;
        livestock += this.bio
        return livestock;
    }
    setTimeout(time){
        this.timeOut = time;
    }
    getTimeout(){
        return this.timeOut;
    }
    getLiveStock(){
        //Create an array here so that we can get the livestock that we have created.
        //What is an array - and how are we going to be able to make sure that we can access this array - or rather how will php make sure that it can access this array ?
        var livestock = new Array();
        var startTime = new Date();
        var vDate = startTime.getDate();
        if(vDate < 10){
            vDate = "0" + vDate;
        }
        startTime = startTime.toJSON();
        startTime = startTime.replace("T", " ");
        startTime = startTime.replace("Z", "");
        this.startDate = startTime;

        if(this.sex == 0){
            this.sex = "M";
        }
        else{
            this.sex = "F";
        }
        livestock.push(this.sex);
        livestock.push(this.breed);
        livestock.push(this.age);
        livestock.push(this.name);
        livestock.push(this.askAmount);
        livestock.push(this.startDate);
        livestock.push(this.endDate);
        livestock.push(this.timeOut);
        livestock.push(this.bio);
        return livestock;

    }
    //I think it would be best if we can get the livestock as a form of an array return
}
var timeUnit = 0;
var timeOutValue = 0;
var defaultActive = true;
var livestock = new Livestock();
var animalTypeArr = new Array();
var varAnimalType = null;

function animalType(){
    //We need to get this directly from the database
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/dashboard/biddingsystem/users/admin/livestock/posts/postAnimalType.php', true);
    xhr.onload = function(){
        if(this.status = 200){
            varAnimalType = JSON.parse(this.responseText);
            //OUTPUT THE INFORMATION TO THE BROWSER
            for(var i in varAnimalType){
                animalTypeArr.push(varAnimalType[i].name);
                //We need to now put these values inside an array - or rather we can amke use of the livestock
            }
        }
    }
    xhr.send();
}
//On call the XMLHttpRequest and get the animal type data
window.addEventListener('load', animalType);

function createAuction(){
    //We need to be able to make sure that we can upload videos using javascript or something
    //Create a childiv and call the child Div createLiveStock 
    var inputStyle = "";
    var inputStyleDate = "";
    var inputStyleTime = "";
    var buttonInput = "";
    var activityCard = document.getElementById("activityCard");
    var createLiveStock = document.createElement('div');
    var breakElment = document.createElement('br');
    createLiveStock.id = "createLiveStock";
    createLiveStock.className = "";
    createLiveStock.innerHTML = "Create Live Stock";
    activityCard.appendChild(createLiveStock);
    breakEl(createLiveStock);
    breakEl(createLiveStock);
    //========================
    //Animal Details
    //=====================
    var animalDetailsDiv = document.createElement("div");
    animalDetailsDiv.className = "box";
    animalDetailsDiv.id = "animalDetailsDiv";
    animalDetailsDiv.innerHTML = "Animal Details Div";
    createLiveStock.appendChild(animalDetailsDiv);
    animalDetailsDivFunction(animalDetailsDiv);
    function animalDetailsDivFunction(animalDetailsDiv)
    {
            //=====================
            //Animal Type
            //======================
            breakEl(animalDetailsDiv);
            breakEl(animalDetailsDiv);
            animalDetailsDiv.appendChild(createLabel("Choose Animal Type"));//Create label for the animal type
            var v_animalType = createElement("animalType", inputStyle, "animalType", "animalType", "select", "text");//Create an animal type element
            for(index in animalTypeArr){
                v_animalType.options[v_animalType.options.length] = new Option(animalTypeArr[index], index);
                //Add animal options - The options will be comming from an array called animalTypeArr this array is retrieved by use of AJAX from our database
            }
            v_animalType.addEventListener('change', changeAnimalBreed);//Create an event to update the animal breed when the animal type is been changed. - The options of the animal breed will be coming from the AJAX POST
            breakEl(animalDetailsDiv);
            animalDetailsDiv.appendChild(v_animalType);
            breakEl(animalDetailsDiv);

            //Create input fields for stock information
            //The sex should validate on time - BUt we cannot ender the informatio so we are going to create a class since we cannot write the information directly into the database - So on exit we are going to input this information into the livestock class
            //=====================
            //Animal Breed Element
            //======================
            breakEl(animalDetailsDiv);
            animalDetailsDiv.appendChild(createLabel("Choose Animal Breed"));//By defaul animal breed should be same as the first value of the animalTypeArr --
            breakEl(animalDetailsDiv);
            var elBreed = createElement("breed", inputStyle, "breed", "breed", "select", "text");
            animalDetailsDiv.appendChild(elBreed);
            breakEl(animalDetailsDiv);//Break Elemnt
            animalBreed();
            breakEl(animalDetailsDiv);
            
            //=====================
            //Animal SEX Element
            //======================
            const sexValues = ["Male", "Female"];
            var sexElement = createElement("sex", inputStyle, "sex", "Sex", "select", "text")//Create Animal Sex Input element
            for(index in sexValues){
                sexElement.options[sexElement.options.length] = new Option(sexValues[index], index);
            }
            sexElement.addEventListener('change', testIfValue);//Add Event Lisenter - On change  TestIfValue
            animalDetailsDiv.appendChild(createLabel("Sex"));//Create the sex label
            breakEl(animalDetailsDiv);//Break line
            animalDetailsDiv.appendChild(sexElement);//Append the input sex element
            breakEl(animalDetailsDiv);
            //=====================
            //Animal Name
            //======================
            animalDetailsDiv.appendChild(createLabel("<br>Livestock Name<br>"));
            var livestockName = createElement("livestockName", inputStyle, "livestockName", "Name Your livestock", "input", "text");
            animalDetailsDiv.appendChild(livestockName);
            breakEl(animalDetailsDiv);
            


            //=====================
            //Animal Age Element
            //======================
            breakEl(animalDetailsDiv);//Break Line
            animalDetailsDiv.appendChild(createLabel("Age", "ageLebel"));//Create an age label to complement the age input element
            breakEl(animalDetailsDiv);
            var animalAge = createElement("ageInput", inputStyle, "ageInput", "Enter Age", "input", "text");
            animalAge.addEventListener('input', validateAge);
            animalDetailsDiv.appendChild(animalAge);
            var animalAgeUnit = createElement("animalAgeUnit", inputStyle, "animalAgeUnit", "Age Unit", "select", "select");
            const dateUnits =  ["Day(s)", "Weeks(s)", "Month(s)", "Year(s)"];
            for(index in dateUnits)
            {
                animalAgeUnit.options[animalAgeUnit.options.length] = new Option(dateUnits[index], index);
            }
            animalDetailsDiv.appendChild(animalAgeUnit);
            breakEl(animalDetailsDiv);
            breakEl(animalDetailsDiv);
            breakEl(animalDetailsDiv);
    }
    //===================
    // BID DETAILS
    //===================
    var bidDetailsDiv = document.createElement("div");
    bidDetailsDiv.className = "box";
    bidDetailsDiv.id = "animalDetailsDiv";
    bidDetailsDiv.innerHTML = "Animal Details Div";
    breakEl(createLiveStock);
    breakEl(createLiveStock);
    createLiveStock.appendChild(bidDetailsDiv);

            //=====================
            //Auction Ask Amount
            //------------------------
            // * This should be a decimal value or an int
            //======================
            breakEl(bidDetailsDiv);//Break Element
            breakEl(bidDetailsDiv);//Break Element
            breakEl(bidDetailsDiv);//Break Element

            var askAmountLabel = createLabel("Ask Amount");//Create lable for ask amount input element
            askAmountLabel.id = "askAmountLabel";
            bidDetailsDiv.appendChild(askAmountLabel);
            breakEl(bidDetailsDiv);
            var askAmount = createElement("askAmount", inputStyle, "askAmount", "Enter Ask Amount", "input", "text");//Append ask amount input element to bidDetailsDiv div
            askAmount.addEventListener('input', validatePrice);
            bidDetailsDiv.appendChild(askAmount);
            breakEl(bidDetailsDiv);

            
            //=====================
            //Auction end Date
            //======================
            breakEl(bidDetailsDiv);//Break element
            bidDetailsDiv.appendChild(createLabel("End Date"));//Create Label for end date
            breakEl(bidDetailsDiv);//Break Element
            var endDateInput = document.createElement("input");
            endDateInput.type = "datetime-local";
            endDateInput.id = "endDate";
            endDateInput.required = true;
            endDateInput.className = inputStyle;
            endDateInput.name = "endDate";
            var myDate = new Date()
            endDateInput.value = myDate.getDate();
            endDateInput.addEventListener('change', validateEndDate);//Add event listener when the date is changed
            bidDetailsDiv.appendChild(endDateInput);//Append the end date input element to the bidDetailsDiv div
            breakEl(bidDetailsDiv);

            //We need to create a div - what if we can create a form and then have the contents of the form be be put into another form - something similar to inheritance where when we fill up a form we can take the informaiton adn then use the  informaiton into another form
            //Timeout - This is set in minutes. As soon as an add is created I can have a timeout event - set out in minutes.
            //This will be set in minutes, hours, days - WE should also show the user the how many days before the bid is going to close upon the point that the user enters the date.
            //We are doing to have and upp and down arrow - the arrows will chagne the dates or the times - and then we are doing to have 
            //---------------------
            //Auction end Date
            //---------------------
            


            //===============================================================================
            //========================
            //Auction Time Out Elements
            //========================
            //
            //--------------------------------------
            // *Time out input element has buttons that allow the user to specify the timeout time unit -  
            // * The defult button sets the time out to the closing date of the bid
            // * Timout elements are all contained in the time out div
            //=========================================================================
            var timeOutDiv = document.createElement("div");
            timeOutDiv.name = "timeOutDiv";
            timeOutDiv.id = "timeOutDiv";
            breakEl(timeOutDiv);
            breakEl(timeOutDiv);
            timeOutDiv.appendChild(createLabel("Time Out", "timeOutLabel"));//Time out label
            breakEl(timeOutDiv);
            timeOutDiv.appendChild(createElement("timeOut", inputStyle, "timeOut", "Time Out", "input", "text"));
            //Create a label that will be on the side the lable should let us know this is days or what.
            //This lable will change based upon what the customer sets it to be - if the customer sets this to be a in hours the label should comply to that setting
            timeOutDiv.appendChild(createLabel("<br>Minutes | Set Time Unit Below<br>", "timeUnitLabel"));
            var upButton = document.createElement('button');
            upButton.addEventListener('click', changeTimeUnit);
            upButton.id = "upButton";
            upButton.className = "submit_button";
            upButton.innerHTML = "+";
            timeOutDiv.appendChild(upButton);
            //Create another button to bring the time unit down
            var downButton = document.createElement('button');
            downButton.addEventListener('click', changeTimeUnit);
            downButton.id = "downButton";
            downButton.className = "submit_button";
            downButton.innerHTML = "-";
            timeOutDiv.appendChild(downButton);
            //Make the vlue to be unset.
            var unsetTimeOut = document.createElement('button');
            unsetTimeOut.addEventListener('click', changeTimeUnit);
            unsetTimeOut.id = "unsetTimeUnit";
            unsetTimeOut.className = "update_button";
            unsetTimeOut.innerHTML = "Default";
            timeOutDiv.appendChild(unsetTimeOut);
            bidDetailsDiv.appendChild(timeOutDiv);
            breakEl(bidDetailsDiv);
            breakEl(bidDetailsDiv);



    //=====================
    //Animal Bio
    //======================
    breakEl(createLiveStock);   
    var hrElement = document.createElement("hr");
    hrElement.style.width = "40%";
    breakEl(createLiveStock);   
    createLiveStock.appendChild(hrElement);
    createLiveStock.appendChild(createLabel("<br>Give your Livestock enhanced attention <br><br> Add Discription below<br>"));
    breakEl(createLiveStock);
    var liveStockBio = createElement("bio", inputStyle, "bio", "Description of Livestock", "textarea", "");
    liveStockBio.style.width = "40%";
    liveStockBio.className = inputStyle;
    createLiveStock.appendChild(liveStockBio);

    breakEl(createLiveStock);

    //=====================
    //Upload Video Element
    //======================
    createLiveStock.appendChild(createElement("video", "", "video", "Select Video", "input", "file"));
    breakEl(createLiveStock);
    var button = document.createElement('button');
    button.addEventListener('click', insertAuction);
    button.id = "createAution";
    button.className = buttonInput;

    //=====================
    //Create Auction button
    //======================
    breakEl(createLiveStock);
    button.innerHTML = "Create Auction";
    createLiveStock.appendChild(button);

    //=====================
    //Fuctions that enable us to quickly create elements
    //Some other functions are overloaded
    //======================
    function createLabel(caption){
        var label = document.createElement('label');
        label.innerHTML = caption;
        return label;
    }
    function createLabel(caption, id){
        var label = document.createElement('label');
        label.innerHTML = caption;
        label.id = id;
        return label;
    }
    function createElement(elName, elStyle, elId, elPlaceholder, element, type, event, eventFunction){
        var elInput = document.createElement(element);
        elInput.id = elId, 
        elInput.type = type;
        elInput.required = true;
        elInput.className = elStyle
        elInput.placeholder = elPlaceholder;
        elInput.name = elName;
        elInput.addEventListener(event, eventFunction);
        return elInput;
    }
    function createElement(elName, elStyle, elId, elPlaceholder, element, type){
        var elInput = document.createElement(element);
        elInput.id = elId, 
        elInput.type = type;
        elInput.required = true;
        elInput.className = elStyle
        elInput.placeholder = elPlaceholder;
        elInput.name = elName;
        return elInput;
    }
    function breakEl(createLiveStock){
        return  createLiveStock.appendChild(document.createElement('br'));
    }
    //This function is used to get the animal breed - the animal breed should come after the animal type has been created and populated - hence we are putting this function inside our create live stock function

    function animalBreed(){
        //But I need to make sure that I get the value of the first animal in the show.
        console.log(document.getElementById("animalType").value);
        // preventDefault();
                // var name = document.getElementById('')
                var xhr = new XMLHttpRequest();
                var typeId = document.getElementById("animalType").value;
                typeId = +typeId + +1;
                var params = "typeId=" + typeId;
                xhr.open('POST', 'http://localhost/dashboard/biddingsystem/users/admin/livestock/posts/postAnimalBreedWhere.php', true);
                //Pass the information - but then again how can we get the request that we are looking for?
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function()
                {
                    //Get the main div that we are working on    
                    //What do we have here?
                    if(this.status = 200)
                    {
                        var breedArray = JSON.parse(this.responseText);

                        var eldBreed = document.getElementById("breed");
                        eldBreed.innerHTML = "";
                        for(var i in breedArray)
                        {
                            //But we need to make an extra row - and then use this extra row to show students that are not grouped.
                            eldBreed.options[eldBreed.options.length] = new Option(breedArray[i].name, i);
                        }
                    }
                }
                xhr.send(params);
        //Create a post request and get the animal that you are looking for
    }

}

function testIfValue(){
    alert(this.value);
}

function validateEndTime()
{

}


function changeAnimalBreed(e)
{

    console.log(document.getElementById("animalType").value);
    e.preventDefault();
            // var name = document.getElementById('')
            var xhr = new XMLHttpRequest();
            var typeId = this.value;
            typeId = +typeId + +1;
            var params = "typeId=" + typeId;
            xhr.open('POST', 'http://localhost/dashboard/biddingsystem/users/admin/livestock/posts/postAnimalBreedWhere.php', true);
            //Pass the information - but then again how can we get the request that we are looking for?
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function()
            {
                //Get the main div that we are working on    
                //What do we have here?
                if(this.status = 200)
                {
                    var breedArray = JSON.parse(this.responseText);

                    var eldBreed = document.getElementById("breed");
                    eldBreed.innerHTML = "";
                    for(var i in breedArray)
                    {
                        //But we need to make an extra row - and then use this extra row to show students that are not grouped.
                        eldBreed.options[eldBreed.options.length] = new Option(breedArray[i].name, i);
                    }
                }
            }
            xhr.send(params);
    //Create a post request and get the animal that you are looking for

}

var timeOutElement =  document.getElementById("timeOut");

function validateEndDate()
{
    var consoleValue = "Good";
    var endDate = new Date(document.getElementById("endDate").value);
    var today  = new Date();
    var startYear = today.getFullYear();
    var startMonth = today.getMonth() + +1;
    var startDay = today.getDate();
    var endDateMonth = endDate.getMonth() + +1;
    if(startDay < 10){
        startDay = "0" + startDay;
    }
    var strToday = startYear + "-" + startMonth + "-" + startDay;
    if(endDate.getFullYear() < startYear){
        consoleValue = "Invalid Year";
        document.getElementById("endDate").value = strToday;
        
    }
    else
    {
        if(endDateMonth < startMonth && endDate.getFullYear() == startYear)
        {
            consoleValue = "Invalid Month";
            document.getElementById("endDate").value = strToday;
        }
        else
        {
            if(endDate.getDate() < startDay && endDateMonth == startMonth)
            {
                consoleValue = "Invalid Day";
                document.getElementById("endDate").value = strToday;
            }
        }
    }    
    console.log(consoleValue);
}

function changeTimeUnit()
{
    //----------------
    // Variables Here
    //----------------
    //If the add button get clicked change the time unit into something else.
    //Now we need incrememnt the time.

    var timeUnitCaption = ["<br>Minutes<br>", "<br>Hours<br>", "<br>Days<br>", "<br>Weeks<br>"];//If someone enters more days than a week we need to mke
    var timeUnitMultimple = [1, 60, 1440, 10080];
    var timeUnitLabel = document.getElementById("timeUnitLabel");
    // var timeOutValue =  document.getElementById("timeOut").value;
    timeOutValue =  document.getElementById("timeOut").value;
    timeUnitLabel.innerHTML = timeUnitCaption[timeUnit];
    // livestock.setTimeout(timeOutValue);

    if(this.id == "unsetTimeUnit" && defaultActive){
        //Disable all the other elements - that are within this space.
        document.getElementById("upButton").disabled = true;
        document.getElementById("upButton").className = "back_button";
        document.getElementById("downButton").disabled = true;
        document.getElementById("downButton").className = "back_button";
        //Everything to default.
        timeUnitLabel.innerHTML = "<br>Default<br>";
        defaultActive = false;
        
    }
    else if(this.id == "unsetTimeUnit" && !defaultActive){
        //Disable all the other elements - that are within this space.
        document.getElementById("upButton").disabled = false;
        document.getElementById("upButton").className = "submit_button";
        document.getElementById("downButton").disabled = false;
        document.getElementById("downButton").className = "submit_button";
        //Everything to default.
        timeUnitLabel.innerHTML = timeUnitCaption[timeUnit];
        defaultActive = true;
    }

    if(this.id == "upButton"){
        if(timeUnit < 3)
        {
            timeUnit++;
            //Now we need to make sure that we can then move on to displaying the information as we need to have it be.
            timeUnitLabel.innerHTML = timeUnitCaption[timeUnit];
            timeOutValue *= timeUnitMultimple[timeUnit];
        }
        else{
            timeOutValue *= timeUnitMultimple[timeUnit];
        }
        console.log(timeOutValue + " " + timeUnitCaption[timeUnit] + " | Time Unit = " + timeUnit);
    }

    if(this.id == "downButton"){
        if(timeUnit > 0){
            timeUnit--;
            timeOutValue *= timeUnitMultimple[timeUnit];
            timeUnitLabel.innerHTML = timeUnitCaption[timeUnit];
        }
        else{
            timeOutValue *= timeUnitMultimple[timeUnit];
        }
        console.log(timeOutValue + " " + timeUnitCaption[timeUnit] + " | Time Unit = " + timeUnit);
    }

    if(timeUnit == 0 && document.getElementById("timeOut").value <= 3){
        //Make sure that you set the time to atleast 5 Minutes
        document.getElementById("timeOut").value = 5;
        document.getElementById("timeOutLabel").innerHTML = "Time Out set to default 5 minutes";
    }
    else{
        document.getElementById("timeOutLabel").innerHTML = "Time Out";
    }
    // livestock.setTimeout(timeOutValue);
}   

function insertAuction()
{

    //our params here should be our information - Now this information here is livestock we need all this information about our livestock
    alert(document.getElementById("bio").value);
    //Now we can get all the values of the items taht we desire to get.
    livestock.setLiveStoct(document.getElementById("sex").value, document.getElementById("livestockName").value,  document.getElementById("breed").value, document.getElementById("age").value, document.getElementById("askAmount").value, document.getElementById("startDate").value, document.getElementById("endDate").value, timeOutValue, document.getElementById("bio").value);
    var xhr = new XMLHttpRequest();
    var livestockArray = livestock.getLiveStock();
    // var params = "livestock=" + JSON.stringify(livestockArray);
    var params = "livestock=" + JSON.stringify(livestockArray);
    xhr.open('POST', 'http://localhost/dashboard/biddingsystem/users/admin/livestock/insert.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    //Get this information and then you need to take this information and insert the information to the database
    //WE will be making use of AJAX for this part
}

function passwordStrength()
{
    //Check if characters are greater >= 8
    //Get element values
    if(pword1El.value === pword2El.value)
    {
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
        var specialCharFormat = /[`!@$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
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
    var specialCharFormat = /[`!@$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var numFormat = /[012345789]/;
    // var alphaFormat = /[a-zA-Z]/i;
    if(specialCharFormat.test(fname.value) || numFormat.test(fname.value))   
    {
        lblName.style.color = "red";
        lblName.innerHTML = "Invalid Name"
    }
    else
    {
        // lblPassword.style.color= "red";
        // lblPassword.innerHTML = "Invalid Password";
        // returnValue = 0;
        lblName.style.color = "green";
        lblName.innerHTML = "Name";
    }
}
//1 Get the two gender elements
//2 Make sure that the genders do actually match - So then we can call this function throughout.
// Hi there how are you

function validateAge()
{
    var ageLabel = document.getElementById("ageLebel");
    var specialCharFormat = /[`!@$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var alphaFormat = /[a-zA-Z]/i;
    var ageInput = document.getElementById("ageInput");
    if(alphaFormat.test(ageInput.value) || specialCharFormat.test(ageInput.value)){
        //Tell the user that the vaues intered are not valid
        ageLabel.className = "labelInvalidInput";
        ageLabel.innerText = "Invalid Age"
    }
    else
    {
        ageLabel.className = "label";
        ageLabel.innerText = "Age "
    }
}

function validatePrice()
{

    var askAmountLabel = document.getElementById("askAmountLabel");
    var specialCharFormat = /[`!@$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var alphaFormat = /[a-zA-Z]/i;
    var askAmount = document.getElementById("askAmount");
    console.log(askAmount.value);
    if(alphaFormat.test(askAmount.value) || specialCharFormat.test(askAmount.value)){
        //Tell the user that the vaues intered are not valid
        askAmountLabel.className = "labelInvalidInput";
        askAmountLabel.innerText = "Invalid Price"
    }
    else
    {
        askAmountLabel.className = "label";
        askAmountLabel.innerText = "Ask Amount"
    }

}


function validate_id()
{
    //The first thing that we should do is to make sure that we trim the spaces
    var id_nr = document.getElementById("id_nr");
    var sex = document.getElementById("sex").value;
    var gender = "";
    id_nr.value  = id_nr.value.trim();
    var specialCharFormat = /[`!@$%^&* ()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var numFormat = /[012345789]/;
    var alphaFormat = /[a-zA-Z]/i;
    if(alphaFormat.test(id_nr.value) || specialCharFormat.test(id_nr.value))
    {
        document.getElementById("lblId_nr").style.color = "red";
        document.getElementById("lblId_nr").innerHTML = "Invalid ID";
    }
    else{
        if(id_nr.value.length != 13){//|| Number.isInteger(document.getElementById("id_nr").value))
            if(checkIDString(id_nr.value)){
                document.getElementById("lblId_nr").style.color = "red";
                document.getElementById("lblId_nr").innerHTML = "Invalid ID Length";
            }
            else{
                document.getElementById("lblId_nr").style.color = "red";
                document.getElementById("lblId_nr").innerHTML = "Invalid ID";
            }
        }
        else if(id_nr.value.length == 13 && stringContainsNumber(id_nr.value)){
            if(checkIDString(id_nr.value)){
                id_nr.style.borderColor = "grey";
                document.getElementById("lblId_nr").style.color = "green";
                document.getElementById("lblId_nr").innerHTML = "ID Number";
                //Check if the gender and the ID match
                //subtring the ID get the gender from it.
                var gender_id = id_nr.value.substr(6, 4);
                if(gender_id > 4999 && gender_id <= 9999 ){
                    gender = "M";
                    //Then the person is make - then we need to 
                    if(sex == gender){
                        document.getElementById("lblSex").style.color = "green";
                        document.getElementById("lblSex").innerHTML = "Sex";  
                    }
                    else{
                        //Gender does not match - now you we need to show this to the user with the color red.
                        document.getElementById("lblSex").style.color = "red";
                        document.getElementById("lblSex").innerHTML = "Sex does not match ID";
                    }
                }
                else{
                    if(sex == "M"){
                        document.getElementById("lblSex").style.color = "red";
                        document.getElementById("lblSex").innerHTML = "Sex does not match ID";
                    }
                    else{
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

