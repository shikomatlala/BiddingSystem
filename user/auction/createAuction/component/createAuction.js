window.addEventListener('load', main);

function main()
{
    createAuctionInterface();
}

var selectElClass = "";
var actionButtonClass = "";
var txtInputClass = "";

function createAuctionInterface()
{

    var animalTypeArr = new Array();
    var varAnimalType;
    //=====================
    //Animal Type
    //======================
    //Variables and AJAX requests
    var animalTypeDiv = document.getElementById("animalTypeDiv");
    var inputAnimalType = createElement("inputAnimalType", selectElClass, "inputAnimalType", "", "select", "text");//Create an animal type element  
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/dashboard/biddingsystem/user/auction/createAuction/component/api/getAnimalType.php', true);
    xhr.onload = function(){
        if(this.status = 200){
            varAnimalType = JSON.parse(this.responseText);
            //OUTPUT THE INFORMATION TO THE BROWSER
            for(var i in varAnimalType){
                animalTypeArr.push(varAnimalType[i].name);
                console.log(varAnimalType[i].name);
                inputAnimalType.options[inputAnimalType.options.length] = new Option(varAnimalType[i].name, i);
                //We need to now put these values inside an array - or rather we can amke use of the livestock
            }
        }
    }
    xhr.send();
    inputAnimalType.addEventListener('click', changeAnimalBreed);//Create an event to update the animal breed when the animal type is been changed. - The options of the animal breed will be coming from the AJAX POST
    animalTypeDiv.appendChild(inputAnimalType);
}


function changeAnimalBreed()
{
    console.log(document.getElementById("inputAnimalType").text);
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