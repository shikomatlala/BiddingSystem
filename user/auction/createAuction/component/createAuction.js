window.addEventListener('load', animalType);
// window.addEventListener('load', loadAnimalTypeData);


var animalTypeArr = new Array();
var varAnimalType = null;
function animalType(){
    //We need to get this directly from the database
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/dashboard/biddingsystem/user/auction/createAuction/component/api/getAnimalType.php', true);
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
    loadAnimalTypeData(varAnimalType);
}


function loadAnimalTypeData(varAnimalType)
{
    console.log("Hi there");
    alert("Welcome");
    var selectAnimalType = document.getElementById("inputAnimalType");
    console.log(selectAnimalType);
    console.log(varAnimalType);
    for(var index in varAnimalType){
        selectAnimalType.options[selectAnimalType.options.length] = new Option(varAnimalType[index++], index);
    }

}