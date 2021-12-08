window.addEventListener('load', loadAnimalTypeData);

function loadAnimalTypeData()
{
    console.log("Hi there");
    alert("Welcome");
    var selectAnimalType = document.getElementById("inputAnimalType");
    //Add a button
    var button = document.createElement("button");
    button.name= "myButton";
    button.value= "Add";
    document.getElementById("animalTypeDiv").appendChild(button);

}