CREATE DATABASE biddingsystem;

USE biddingsystem;

CREATE TABLE `user`
(   
    `userId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `fName` VARCHAR(20) NOT NULL,
    `lName` VARCHAR(20) NOT NULL,
    `idNumber` CHAR(13) NOT NULL,
    `phone` CHAR(10) NOT NULL UNIQUE,
    `email` VARCHAR(70) NOT NULL UNIQUE,
    `password` VARCHAR(15) NOT NULL,
    `cAddress` VARCHAR(300) NOT NULL
);


INSERT INTO `user`( `fName`, `lName`, `idNumber`, `phone`, `email`,`password`, `cAddress`) VALUES ("Shiko","Matlala","9511275418082", "0765870538","shikomatlala@gmail.com", "Shiko", "South Africa");
INSERT INTO `user`( `fName`, `lName`, `idNumber`, `phone`, `email`,`password`, `cAddress`) VALUES ("Wisani","Cuma","9511275418081", "0765870531","wisanicuma@gmail.com","Wisani", "South Africa");



CREATE TABLE `seller`
(
    `sellerId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `userId` INT(11) NOT NULL, 
    -- A seller may have reviews and other things of that kind and if that is the case then we need to put this information as such there might be come imformation that is specific to the seller that we might want to know about he seller
    FOREIGN KEY (`userId`)  REFERENCES `user` (`userId`)
);

INSERT INTO `seller` (`userId`) VALUES (1);
INSERT INTO `seller` (`userId`) VALUES (2);


-- We might need to have some information about buyer - but we are not in need of that information now for now we want to make sure that a buyer can just buy the information that they have to buy
CREATE TABLE `buyer`
(
    `buyerId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `userId` INT(11) NOT NULL, 
    `status` CHAR(1) NOT NULL, 
    FOREIGN KEY (`userId`)  REFERENCES `user` (`userId`)
);

INSERT INTO `buyer` (`userId`, `status`) VALUES (1, 'G');
INSERT INTO `buyer` (`userId`, `status`) VALUES (2, 'G');

CREATE TABLE `livestock`
(
    `stockId` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `sex` CHAR(1) NOT NULL,
    `breed` VARCHAR(100), 
    `age` INT(3) NOT NULL, 
    `sellerId` INT(11) NOT NULL,
    `askamount` DECIMAL(11,2) NOT NULL,
    `startdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `enddate` DATETIME NOT NULL,
    `timeout` DATETIME NOT NULL, 
    `bio` VARCHAR(4000),
    FOREIGN KEY (`sellerId`)  REFERENCES `seller` (`sellerId`)  
);

-- The end date is very important becuase if the end date does not exist it means that abid can exist forever and not close, the issue with that is that the livestock could even die without being bought.
-- So I think that it is important to have an end date so that a bid can come to an end.but what if duration is greater than the end-date, I tell you that I want the bid to end at 10:00pm but then I instruct the system to drop a bid after a long time after the bid has been created? - Well at this point here it should not matter it would meant that the bid needs to end no matter what.
-- 

INSERT INTO `livestock` (`sex`, `breed`, `age`, `sellerId`, `askamount`, `enddate`, `timeout`) VALUES ('F', 'Bull', 5, 1, 3987, "2021-11-27 00:00:00", "2021-10-28 00:00:00" );
INSERT INTO `livestock` (`sex`, `breed`, `age`, `sellerId`, `askamount`, `enddate`, `timeout`) VALUES ('F', 'Bull', 5, 1, 3987, "2021-11-01 00:00:00", "2021-10-28 00:00:00" );

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