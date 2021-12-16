

l79fIrV%@18E

DROP DATABASE biddingsystem;

CREATE DATABASE biddingsystem;

USE biddingsystem;

CREATE TABLE `user`
(   
    `userId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `fName` VARCHAR(20) NOT NULL,
    `lName` VARCHAR(20) NOT NULL,
    `idNumber` CHAR(13) NOT NULL UNIQUE,
    `phone` CHAR(10) NOT NULL UNIQUE,
    `email` VARCHAR(70) NOT NULL UNIQUE,
    `password` VARCHAR(15) NOT NULL,
    `cAddress` VARCHAR(300) NOT NULL
);


CREATE TABLE `seller`
(
    `sellerId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `userId` INT(11) NOT NULL, 
    -- A seller may have reviews and other things of that kind and if that is the case then we need to put this information as such there might be come imformation that is specific to the seller that we might want to know about he seller
    FOREIGN KEY (`userId`)  REFERENCES `user` (`userId`)
);


-- We might need to have some information about buyer - but we are not in need of that information now for now we want to make sure that a buyer can just buy the information that they have to buy
CREATE TABLE `buyer`
(
    `buyerId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `userId` INT(11) NOT NULL, 
    `status` CHAR(1) NOT NULL, 
    FOREIGN KEY (`userId`)  REFERENCES `user` (`userId`)
);


CREATE TABLE `animalType`
(
    `typeId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL
);

INSERT INTO `animalType` (`typeId`,`name`) VALUES (1,'Sheep');
INSERT INTO `animalType` (`typeId`,`name`) VALUES (2,'Cattle');
INSERT INTO `animalType` (`typeId`,`name`) VALUES (3,'Chicken');
INSERT INTO `animalType` (`typeId`,`name`) VALUES (4,'Pig');
INSERT INTO `animalType` (`typeId`,`name`) VALUES (5,'Goat');


CREATE TABLE `breed`
(
    `breedId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL,
    `typeId` INT(11) NOT NULL,
    FOREIGN KEY (`typeId`) REFERENCES `animalType` (`typeId`)
);

INSERT INTO `breed` (`name`, `typeId`) VALUES ('Dorper',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Merino',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Suffolk Sheep',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Valais Blacknose',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Priangan Sheep',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Cameroon Sheep',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Taxel Sheep',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Ouessant Sheep',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Awassi',1);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Racka',1);


INSERT INTO `breed` (`name`, `typeId`) VALUES ('American Brahman',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Aberdeen Angus',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Hereford cattle',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Simmental cattle',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Belted Galloway',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Beefalo',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Red Angus',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Braford',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Aubrac',2);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Senepol',2);


INSERT INTO `breed` (`name`, `typeId`) VALUES ('Silkie',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Leghorn chicken',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Brahma chicken',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Sussex chicken',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Rhode Island red',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Polish chicken',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Shamo chickens',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Ayam Cemani',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Australorp',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Lohmann',3);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Indian Giant',3);


INSERT INTO `breed` (`name`, `typeId`) VALUES ('Duroc pig',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Mini pig',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Large White pig',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Tamworth pig',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Mangalica',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Large Black pig',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Vietnamess Pot-bellied',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Kunekune',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('American Yorkshire',4);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Oxford Sandy and Black',4);

INSERT INTO `breed` (`name`, `typeId`) VALUES ('Boer goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('American Pygmy',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Saarien goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Nigerian Dwarf goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Beetal',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Toggenburg goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Golden Guernsy',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Verata goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Oberhasli goat',5);
INSERT INTO `breed` (`name`, `typeId`) VALUES ('Peacock goat',5);

CREATE TABLE `livestockAge`
(
    `ageId` INT(3) PRIMARY KEY AUTO_INCREMENT,
    `ageName` VARCHAR(40) NOT NULL
);

INSERT INTO `livestockAge`  (`ageName`) VALUE ("Day(s)");
INSERT INTO `livestockAge`  (`ageName`) VALUE ("Week(s)");
INSERT INTO `livestockAge`  (`ageName`) VALUE ("Month(s)");
INSERT INTO `livestockAge`  (`ageName`) VALUE ("Year(s)");

CREATE TABLE `livestock`
(
    `stockId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `sex` CHAR(1) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `breedId` INT(11) NOT NULL, 
    `ageId` INT(3) NOT NULL,
    `age` INT(3) NOT NULL, 
    `sellerId` INT(11) NOT NULL,
    `askamount` DECIMAL(11,2) NOT NULL,
    `startdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `enddate` DATETIME NOT NULL,
    `bio` VARCHAR(4000),
    FOREIGN KEY (`ageId`) REFERENCES `livestockAge` (`ageId`),
    FOREIGN KEY (`sellerId`)  REFERENCES `seller` (`sellerId`),
    FOREIGN KEY (`breedId`) REFERENCES `breed` (`breedId`)
);

-- The end date is very important becuase if the end date does not exist it means that abid can exist forever and not close, the issue with that is that the livestock could even die without being bought.
-- So I think that it is important to have an end date so that a bid can come to an end.but what if duration is greater than the end-date, I tell you that I want the bid to end at 10:00pm but then I instruct the system to drop a bid after a long time after the bid has been created? - Well at this point here it should not matter it would meant that the bid needs to end no matter what.
-- 

CREATE TABLE `livestockvideo`
(
    `videoId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `locationString` VARCHAR(4000) NOT NULL,
    `stockId` INT(11) NOT NULL,
    FOREIGN KEY (`stockId`) REFERENCES `livestock` (`stockId`)
);

-- Add Day to the current time.

CREATE TABLE `bid`
(
    `bidId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `bidTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `amount` DECIMAL(11, 2) NOT NULL, 
    `buyerId` INT(11) NOT NULL, 
    `stockId` INT(11) NOT NULL,
    FOREIGN KEY (`buyerId`)  REFERENCES `buyer` (`buyerId`),
    FOREIGN KEY (`stockId`)  REFERENCES `livestock` (`stockId`)
);

-- We need to know the time that an individual sent in the bid.