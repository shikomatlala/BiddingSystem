        <script src="component/createAuction.js"></script>
        <div id="createAuctionDiv" class="">
            <div id="animalTypeDiv" class="">
                <lablel for="selectAnimalType" class="" name="lblAnimalType" id="lblAnimalType">Choose Animal Type</label><br>
            </div>
            <div id="animalBreedDiv" class="">
                <lablel for="selectAnimalBreed" class="" name="lblAnimalBreed" id="lblAnimalBreed">Choose Animal Breed</label><br> 
            </div>

            <div id="animalSexDiv" class="">
                <lablel for="selectAnimalSex" class="" name="lblAnimalSex" id="lblAnimalSex">Choose Animal Sex</label><br> 
                <select id="selectAnimalSex" required="" class="" name="selectAnimalSex">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>

            <div id="animalNameDiv" class="">
                <lablel for="inputAnimalName" class="" name="lblAnimalName" id="lblAnimalName">Enter Animal Name</label><br> 
                <input class="" type="text" id="inputAnimalName" name="inputAnimalName" placeholder="Livestock Name" required="">
            </div>

            <div id="animalAgeDiv" class="">
                <lablel for="inputAnimalAge" class="" name="lblAnimalAge" id="lblAnimalAge">Enter Animal </label><br> 
                <input class="" type="text" id="inputAnimalAge" name="inputAnimalAge" placeholder="Age" required="">
                <select id="selectAnimalAge" required="" class="" name="selectAnimalAge">
                    <option value="1">Day(s)</option>
                    <option value="2">Week(s)</option>
                    <option value="3">Month(s)</option>
                    <option value="4">Year(s)</option>
                </select>
            </div>

            <div id="animalWeightDiv" class="">
                <lablel for="inputAnimalWeight" class="" name="lblAnimalWeight" id="lblAnimalWeight">Enter Animal Weight | Measured in kg.</label><br> 
                <input class="" type="text" id="inputAnimalWeight" name="inputAnimalWeight" placeholder="eg. 2.4" required="">
            </div>

            <div id="animalBioDiv" class="">
                <lablel for="inputAnimalBio" class="" name="lblAnimalBio" id="lblAnimalBio">Animal Bio</label><br> 
                <textarea id="inputAnimalBio" class="" name="inputAnimalBio" row="4" cols="50" placeholder="Animal Bio"></textarea>
            </div>

            <div id="askAmountDiv" class="">
                <lablel for="askAmount" class="" name="lblAskAmount" id="lblAskAmount">Enter Ask Amount</label><br> 
            </div>

            <div id="startDateDiv" class="">
                <lablel for="startDate" class="" name="lblStartDate" id="lblStartDate">Choose Start Date</label><br> 
            </div>

            <div id="endDateDiv" class="">
                <lablel for="endDate" class="" name="lblEndDate" id="lblEndDate">Choose End Date</label><br> 
            </div>
        <div>
        