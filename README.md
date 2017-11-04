# HollywoodPortfolio

Requirements:
Part I: design an application that can store three hollywood movie production companies, each produces 5-10 movies a year, 10% of the movies fail financially, actors are paid base amount plus rev share. Assume 4 core actors per movie. Produce a display that shows actors, actor revenue, movie production companies revenue, losses for each and a form that allows a user to enter an actor and map to movie and base pay . Actual $ numbers up to candidate

Part II: Produce a display that shows a) the number of lines and words in each movie script for each Actor, and,  b) the number of times the Actor's character will be mentioned in each script by other Actors (for instance, Actor plays "Mad Max", this is a count of how many times a reference to "Max" or "Mad Max" by another character is made in the script)

Language: PHP

Database: MySql

Tables Created: 

1.PRODUCTION_COMPANY(PRODUCTION_COMPANY_ID, PRODUCTION_COMPANY_NAME)
2.ACTOR_LIST(ACTOR_ID,ACTOR_NAME)
3.REVENUE_PER_MOVIE(MOVIE_ID,PRODUCTION_COMPANY_ID,MOVIE_NAME,MOVIE_BUDGET,MOVIE_REVENUE)
4.ACTOR_REVENUE_PER_MOVIE(REVENUE_ID,ACTOR_ID,MOVIE_ID,BASE_AMOUNT,REVENUE_SHARE)
5.MOVIE_CHARACTERS(CHARACTER_ID,CHARACTER_NAME,ACTOR_ID,MOVIE_ID)
6.MOVIE_SCRIPT(CHARACTER_ID,MOVIE_ID,LINES_IN_THE_SCRIPT)

PHP files used:
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

Project Description with assumptions:

The home page for the project is index.php. This page displays two tables. The first table is list of all actors in the database with their total revenue. Based on the requirement, an actor's revenue is calculated by summing the base amount with the revenue share of the movies they were part of. To calculate actor's revenue, I assumed that each actor might have different base amount and different revenue share percentages for each movie (which I stored in ACTOR_REVENUE_PER_MOVIE table). I also assumed that an actor gets the percentages of her/his revenue share only if the movie makes a profit. So, I collect MOVIE_BUDGET and MOVIE_REVENUE from REVENUE_PER_MOVIE table and calculate the percentage share if there was a profit else revenue share is considered to be 0 and it adds up to the base amount to get total actor revenue.
The second table displays the Movie Production Company's revenue and losses. The production company id and names are picked from PRODUCTION_COMPANY table and joined with REVENUE_PER_MOVIE to get the sum of revenues of all movies under each production and profit or losses depends on the difference of sum of MOVIE_REVENUE and sum of MOVIE_BUDGET for each.

scriptdetails.php: To see Script Details based on Part II requirement.

actormoviemap.php : That searches for the entered actor name and displays the actor's movies and corresponding base amounts.

addactor.php : To add a new Actor.

addmovies.php :To add a new movie.

addcharactertomovie.php :To add 4 actors, corresponding character names, base amount and revenue share to a movie.
