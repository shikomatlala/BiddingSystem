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
    var selectAnimalType = createElement("selectAnimalType", selectElClass, "selectAnimalType", "", "select", "text");//Create an animal type element  
    var xhr = new XMLHttpRequest();
    // xhr.open('GET', 'http://biddingsystem.bitnamiapp.com/user/my-auctions/create/component/api/getAnimalType.php', true);
    xhr.open('GET', 'http://biddingsystem.bitnamiapp.com/user/my-auctions/create/component/api/getAnimalType.php', true);

    xhr.onload = function(){
        if(this.status = 200){
            varAnimalType = JSON.parse(this.responseText);
            //OUTPUT THE INFORMATION TO THE BROWSER
            for(var i in varAnimalType){
                animalTypeArr.push(varAnimalType[i].name);
                console.log(varAnimalType[i].name);
                selectAnimalType.options[selectAnimalType.options.length] = new Option(varAnimalType[i].name, varAnimalType[i].typeId);
                //We need to now put these values inside an array - or rather we can amke use of the livestock
            }
        }
    }
    xhr.send();
    selectAnimalType.addEventListener('change', changeAnimalBreed);//Create an event to update the animal breed when the animal type is been changed. - The options of the animal breed will be coming from the AJAX POST
    animalTypeDiv.appendChild(selectAnimalType);
    //=======================
    //Animal breed
    //===============
    var animalBreedDiv = document.getElementById("animalBreedDiv");
    var selectAnimalBreed = createElement("selectAnimalBreed", selectElClass, "selectAnimalBreed", "", "select", "text");
    selectAnimalBreed.options[selectAnimalBreed.options.length] = new Option("Brahman", "1");
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '')
    animalBreedDiv.appendChild(selectAnimalBreed);
    console.log(selectAnimalBreed);
}

function changeAnimalBreed(e)
{

    console.log(document.getElementById("selectAnimalType").value);
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    var typeId = this.value;
    var params = "typeId=" + typeId;
    // xhr.open('POST', 'http://localhost/dashboard/biddingsystem/user/auction/createAuction/component/api/getAnimalBreed.php', true);
    xhr.open('POST', 'http://biddingsystem.bitnamiapp.com/user/my-auctions/create/component/api/getAnimalBreed.php', true);

    //Pass the information - but then again how can we get the request that we are looking for?
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function()
    {
        //Get the main div that we are working on    
        //What do we have here?
        if(this.status = 200)
        {
            var breedArray = JSON.parse(this.responseText);

            var selectAnimalBreed = document.getElementById("selectAnimalBreed");
            selectAnimalBreed.innerHTML = "";
            for(var i in breedArray)
            {
                //But we need to make an extra row - and then use this extra row to show students that are not grouped.
                selectAnimalBreed.options[selectAnimalBreed.options.length] = new Option(breedArray[i].name, breedArray[i].breedId);
            }
        }
    }
    xhr.send(params);
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