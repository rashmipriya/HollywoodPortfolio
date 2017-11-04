# HollywoodPortfolio

**Requirements:
Part I: design an application that can store three hollywood movie production companies, each produces 5-10 movies a year, 10% of the movies fail financially, actors are paid base amount plus rev share. Assume 4 core actors per movie. Produce a display that shows actors, actor revenue, movie production companies revenue, losses for each and a form that allows a user to enter an actor and map to movie and base pay . Actual $ numbers up to candidate

Part II: Produce a display that shows a) the number of lines and words in each movie script for each Actor, and,  b) the number of times the Actor's character will be mentioned in each script by other Actors (for instance, Actor plays "Mad Max", this is a count of how many times a reference to "Max" or "Mad Max" by another character is made in the script)

Language: PHP

Database: MySql

**Tables Created: 

1.PRODUCTION_COMPANY ( PRODUCTION_COMPANY_ID , PRODUCTION_COMPANY_NAME)
2.ACTOR_LIST ( ACTOR_ID, ACTOR_NAME)
3.REVENUE_PER_MOVIE ( MOVIE_ID, PRODUCTION_COMPANY_ID, MOVIE_NAME, MOVIE_BUDGET, MOVIE_REVENUE)
4.ACTOR_REVENUE_PER_MOVIE ( REVENUE_ID, ACTOR_ID, MOVIE_ID, BASE_AMOUNT, REVENUE_SHARE)
5.MOVIE_CHARACTERS( CHARACTER_ID, CHARACTER_NAME, ACTOR_ID, MOVIE_ID)
6.MOVIE_SCRIPT( CHARACTER_ID, MOVIE_ID, LINES_IN_THE_SCRIPT)

**PHP files used:

1.index.php : Home Page that displays Part I requirements and gives navigation to the rest of the links.

2.actormoviemap.php : That searches for the entered actor name and displays the actor's movies and corresponding base amounts.

3.scriptdetails.php: To see Script Details based on Part II requirement.

4.addactor.php : To add a new Actor.

5.addmovies.php :To add a new movie.

6.addcharactertomovie.php :To add 4 actors, corresponding character names, base amount and revenue share to a movie.

7.DBCONNECT.php: Contains database connection details.

8.DAL.php: The data access layer that performs reads and writes to the database.

9.DATAVIEWER.php: This php helps in displaying the data back to the corresponding pages.

10.MySQL_Queries: With all table definitions.

**Project Description with assumptions:

Please note:For the simplicity of this project, I have added only few validations on each page.

**index.php

This page displays two tables. The first table is list of all actors in the database with their total revenue. Based on the requirement, an actor's revenue is calculated by summing the base amount with the revenue share of the movies they were part of. To calculate actor's revenue, I assumed that each actor might have different base amount and different revenue share percentages for each movie (which I stored in ACTOR_REVENUE_PER_MOVIE table). I also assumed that an actor gets the percentages of her/his revenue share only if the movie makes a profit. So, I collect MOVIE_BUDGET and MOVIE_REVENUE from REVENUE_PER_MOVIE table and calculate the percentage share if there was a profit else revenue share is considered to be 0 and it adds up to the base amount to get total actor revenue.

The second table displays the Movie Production Company's revenue and losses. The production company id and names are picked from PRODUCTION_COMPANY table and joined with REVENUE_PER_MOVIE to get the sum of revenues of all movies under each production and profit or losses depends on the difference of sum of MOVIE_REVENUE and sum of MOVIE_BUDGET for each.

**actormoviemap.php 

This UI allows searching for the entered actor name and displays the actor's movies and corresponding base amounts for each movie on the same page. I have added two validations here. One is that actor's name must be entered and the name must be available in the database.

**scriptdetails.php

This page displays script details.I have created two tables for this requirement. MOVIE_CHARACTERS table that has details of CHARACTER_NAME, ACTOR_ID and MOVIE_ID and MOVIE_SCRIPT table that CHARACTER_ID,MOVIE_ID and LINES_IN_THE_MOVIE. I have assumed that the data is given to us in such a way that we can store lines of each character in a movie in the column LINES_IN_THE_MOVIE. For simplicity, I have also assumed that each word is separated by spaces and each sentence ends in a period. Based on this I calculate number of lines of a character in the script and number of words of a character in the script. 

To fulfill the second requirement that was to count number of occurences of a Actor's character name in each script by other Actors, for simplicity I assumed that the CHARACTER_NAME is stored as either firstname (example "Jerry") or firstname lastname(eg: "Jerry Seinfeld") and valid call to a character is made when the character is either called by the full name("Jerry Seinfeld) or by the last name("Seinfeld"). The search is case-sensitive. I count by either searching the full name of the character being referenced by other characters or by just last name.  

**addactor.php

This UI allows adding a new actor in the database. I have added two validations here. One is the field should not be empty and the same name must not be available in the database.

**addmovies.php

This UI allows adding a new movie to the database. To add a new movie, a user must enter the production company it is associated with and the budget and revenue. I have added following validations here. One is all fields must be entered, same movie name should not exist in the database, production company Id must match with anyone production company Id in the database (for the project as we have considered only three production companies, the user can enter any one among three and if entered wrong, a menu of production companies is displayed) and the movie budget and revenue must be numbers.

**addcharactertomovie.php 

This UI allows to enter 4 actors, corresponding character names, base amount and revenue share to a movie. As the requirement says there are 4 core actors, I have assumed in the project that there must be 4 actors to be added.
I have added some validations here. All fields must be entered. The movie for which the data is entered should already exist in the database. The actors entered must also be available in the database and for the successfull entry in the database, for simplicity, I have assumed that "all" actors name should be available in the database.I have also restricted the addition of same chracters to movies more than once by making ACTOR_ID and MOVIE_ID as the composite key for ACTOR_REVENUE_PER_MOVIE. So, if a user tries to enter same data again, even though the front end tells data entry successfully, the data is not added in the backend.
