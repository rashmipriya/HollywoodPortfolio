CREATE TABLE `hollywoodportfolio`.`PRODUCTION_COMPANY` ( `PRODUCTION_COMPANY_ID` INT(10) NOT NULL , 
`PRODUCTION_COMPANY_NAME` VARCHAR(100) NOT NULL , PRIMARY KEY (`PRODUCTION_COMPANY_ID`)) ENGINE = InnoDB;

INSERT INTO `PRODUCTION_COMPANY`(`PRODUCTION_COMPANY_ID`, `PRODUCTION_COMPANY_NAME`) 
VALUES (2000,"Gulshan Kumar Production House")

INSERT INTO `PRODUCTION_COMPANY`(`PRODUCTION_COMPANY_ID`, `PRODUCTION_COMPANY_NAME`) 
VALUES (2001,"Red Chillies Entertainment")

INSERT INTO `PRODUCTION_COMPANY`(`PRODUCTION_COMPANY_ID`, `PRODUCTION_COMPANY_NAME`) 
VALUES (2002,"Being Human")
-------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`ACTOR_LIST` ( `ACTOR_ID` INT(10) NOT NULL AUTO_INCREMENT , 
`ACTOR_NAME` VARCHAR(100) NOT NULL , PRIMARY KEY (`ACTOR_ID`)) ENGINE = InnoDB;

INSERT INTO `ACTOR_LIST`(`ACTOR_ID`, `ACTOR_NAME`) 
VALUES (500,"Michael Scott")

INSERT INTO `ACTOR_LIST`(`ACTOR_ID`, `ACTOR_NAME`) 
VALUES (501,"Jim Parson")

INSERT INTO `ACTOR_LIST`(`ACTOR_ID`, `ACTOR_NAME`) 
VALUES (502,"Julia Louis Dreyfus")

INSERT INTO `ACTOR_LIST`(`ACTOR_ID`, `ACTOR_NAME`) 
VALUES (503,"Courtney Cox")
-------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`MOVIE_LIST` ( `MOVIE_ID` INT(10) NOT NULL , 
`PRODUCTION_COMPANY_ID` INT(10) NOT NULL , `MOVIE_NAME` VARCHAR(150) NOT NULL , PRIMARY KEY (`MOVIE_ID`)) ENGINE = InnoDB;

INSERT INTO `MOVIE_LIST`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`)
VALUES (100,2000,"The Office")

INSERT INTO `MOVIE_LIST`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`)
VALUES (101,2000,"Seinfeld")

INSERT INTO `MOVIE_LIST`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`)
VALUES (102,2001,"Frasier")

INSERT INTO `MOVIE_LIST`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`)
VALUES (103,2001,"Malcolm in the Middle")

INSERT INTO `MOVIE_LIST`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`)
VALUES (105,2003,"Friends")
------------------------------------------------------------------------------------------------------------------------------

--------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`REVENUE_PER_MOVIE` ( `MOVIE_ID` INT(10) NOT NULL , `PRODUCTION_COMPANY_ID` INT(10) NOT NULL , 
`MOVIE_NAME` VARCHAR(100) NOT NULL , `MOVIE_BUDGET` INT(20) NOT NULL , `MOVIE_REVENUE` INT(20) NOT NULL , PRIMARY KEY (`MOVIE_ID`)) ENGINE = InnoDB;

INSERT INTO `REVENUE_PER_MOVIE`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`) 
VALUES (100,2000,"The Office",90000,150000)

INSERT INTO `REVENUE_PER_MOVIE`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`) 
VALUES (101,2000,"Seinfeld",500000,450000)

INSERT INTO `REVENUE_PER_MOVIE`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`) 
VALUES (102,2001,"Frasier", 100000,200000)

INSERT INTO `REVENUE_PER_MOVIE`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`) 
VALUES (103,2003,"Malcolm in the Middle",200000,100000)

INSERT INTO `REVENUE_PER_MOVIE`(`MOVIE_ID`, `PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`) 
VALUES (105,2002,"Friends",100000,700000)

--------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`ACTOR_REVENUE_PER_MOVIE` ( `REVENUE_ID` INT(10) NOT NULL , `ACTOR_ID` INT(10) NOT NULL , 
`MOVIE_ID` INT(10) NOT NULL , `BASE_AMOUNT` INT(20) NOT NULL , `REVENUE_SHARE` FLOAT(10) NOT NULL , PRIMARY KEY (`REVENUE_ID`)) ENGINE = InnoDB;


INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (1,500,100,100000,10.5)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (2,501,100,120000,15.5)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (3,502,101,130000,20.5)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (4,503,102,190000,10.0)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (5,500,103,160000,5.0)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (6,502,100,110000,15.0)

INSERT INTO `actor_revenue_per_movie`(`REVENUE_ID`, `ACTOR_ID`, `MOVIE_ID`, `BASE_AMOUNT`, `REVENUE_SHARE`) 
VALUES (7,503,105,100000,7.5)
-----------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`movie_list` ( `MovieId` INT(10) NOT NULL , `ProductionCompanyId` 
INT(10) NOT NULL , `MovieName` VARCHAR(300) NOT NULL , PRIMARY KEY (`MovieId`)) ENGINE = InnoDB;

INSERT INTO `movie_script`(`MovieId`, `CharacterId`, `LinesInTheMovie`)
VALUES (101,9006,"I am leaving. This is weird. Get out.")
-----------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`MOVIE_CHARACTERS` ( `CHARACTER_ID` INT(10) NOT NULL ,
`CHARACTER_NAME` VARCHAR(100) NOT NULL , `ACTOR_ID` INT(10) NOT NULL , `MOVIE_ID` INT(10) NOT NULL , PRIMARY KEY (`CHARACTER_ID`)) ENGINE = InnoDB;

INSERT INTO `MOVIE_CHARACTERS`(`CHARACTER_ID`, `CHARACTER_NAME`, `ACTOR_ID`, `MOVIE_ID`) 
VALUES (9000,"Mike",500,100)

INSERT INTO `MOVIE_CHARACTERS`(`CHARACTER_ID`, `CHARACTER_NAME`, `ACTOR_ID`, `MOVIE_ID`) 
VALUES (9001,"Jerry",502,101)

INSERT INTO `MOVIE_CHARACTERS`(`CHARACTER_ID`, `CHARACTER_NAME`, `ACTOR_ID`, `MOVIE_ID`) 
VALUES (9002,"Niles",503,102)

INSERT INTO `MOVIE_CHARACTERS`(`CHARACTER_ID`, `CHARACTER_NAME`, `ACTOR_ID`, `MOVIE_ID`) 
VALUES (9003,"Doie",500,103)
-----------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE `hollywoodportfolio`.`MOVIE_SCRIPT` ( `MOVIE_ID` INT(10) NOT NULL , 
`CHARACTER_ID` INT(10) NOT NULL , `LINES_IN_THE_MOVIE` VARCHAR(100) NOT NULL ) ENGINE = InnoDB;

INSERT INTO `MOVIE_SCRIPT`(`MOVIE_ID`, `CHARACTER_ID`, `LINES_IN_THE_MOVIE`) 
VALUES (101,9001,"Hi How are you.")

INSERT INTO `MOVIE_SCRIPT`(`MOVIE_ID`, `CHARACTER_ID`, `LINES_IN_THE_MOVIE`) 
VALUES (101,9002,"Why this is weird.")

INSERT INTO `MOVIE_SCRIPT`(`MOVIE_ID`, `CHARACTER_ID`, `LINES_IN_THE_MOVIE`) 
VALUES (101,9003,"Niles this is why.")

INSERT INTO `MOVIE_SCRIPT`(`MOVIE_ID`, `CHARACTER_ID`, `LINES_IN_THE_MOVIE`) 
VALUES (101,9004,"Niles please.")

INSERT INTO `MOVIE_SCRIPT`(`MOVIE_ID`, `CHARACTER_ID`, `LINES_IN_THE_MOVIE`) 
VALUES (102,9005,"I love you.")