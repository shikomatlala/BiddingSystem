var date = new Date();
date.getFullYear();
date.getMonth();
date.getDate();
date.getHours();
date.getMinutes();
date.getSeconds();
date.getMinutes();
date.getMilliseconds();
date.getTime();
date.getDate();
Date.now();

dateFormat(date, "dddd, mmmm dS, yyyy, h:MMss TT");


function selectOption()
{
    var selectOption = document.createElement("option");
    var optionArray = ["Yes", "No"];
    selectOption[options.length] = new Option("input1", "Yes");
    // var optionText = document.createTextNode("Yes");
    // selectOption.setAttribute("option", "Yes");
    // selectOption.setAttribute("option", "No");
    // selectOption.appendChild(optionText);
    return selectOption;
    // selectOption.value = "Yes";
    // selectOption.value = 
}