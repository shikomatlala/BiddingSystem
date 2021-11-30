<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Auction</title>
</head>
<body>
    <ul>
        <li><a href="../updateuser/updateuser.php">My Account</a><br></li>
        <li><a href="../createauction/createauction.php">Create Auction</a><br></li>
        <li><a href="../userdashboard.php">Dashboard</a><br></li>
    </ul>
    <h1>Creation an Auction</h1>
    <p>Enter the following information to create an auction</p>
    <br>
    <h3>Livestock Details</h3>
    <label for="inputName" id="lblName">Enter Name</label><br>
    <input id="inputName" name="inputName" placeholder="Name"><button type="button" class=""><br>
    <div name="animalTypeDiv" id="animalTypeDiv" class="">
        <label for="inputLivestock" id="lblLivestock">Choose Animal</label><br>
        <select name="inputLivestock" id="inputLivestock">
            <option value="Cow">Cow</option>
            <option value="Chicken">Chicken</option>
            <option value="Sheep">Sheep</option>
        </select><br>
    </div>
    <label for="inputBreed" id="lblBreed">Choose Breed</label><br>
    <select name="inputBreed" id="inputBreed">
        <option value="volvo">Brahman</option>
        <option value="saab">Beef Master</option>
        <option value="mercedes">Piedmontese</option>
        <option value="audi">Herefordshire</option>
    </select><br>
    <label for="inputAge" id="lblIAge">Enter Age</label><br>
    <input id="inputAge" name="inputAge" placeholder="Age"><br>

    <label for="sex" id="lblSex">Sex</label><br>
    <select name="sex" id="sex">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>
    <label for="ageType" id="lblAgeType">Choose Age Type</label><br>
    <select name="ageType" id="ageType">
        <option value="volvo">Month</option>
        <option value="saab">Week</option>
        <option value="mercedes">Day</option>
        <option value="audi">Year</option>
    </select><br>
    <label for="inputWeight" id="lblWeight">Weight</label><br>
    <input id="inputWeight" name="inputWeight" placeholder="Weight"><br>
    <label for="bio" id="lblBio">Livestock Bio</label><br>
    <textarea id="bio" name="bio" placeholder="Livestock Bio" rows="4" cols="50"></textarea>
    <hr>
    <h3>Auction Details</h3>
    <label for="askAmount" id="lblAskAmount">Ask Amount</label><br>
    <input id="askAmount" name="askAmount" placeholder="Ask Amount"><br>

    <label for="startTime" id="lblAuctionStartDate">Auction Start Date</label><br>
    <input type="datetime-local" id="startTime" name="startDateTime"><br>

    <label for="endTime" id="lblAuctionEndDate">Auction End Date</label><br>
    <input type="datetime-local" id="endTime" name="endDateTime"><br><br>

    <label for="createAuction" name="lblCreateAuction" id="lblCreateAuction">Click To Create Auction</label><br>
    <button type="button" name="createAuction" id="createAuction">Creat Auction</button>

</body>
</html>