# HollywoodPortfolio

Requirements:
Language: PHP
Database: MySql

Project Description with assumptions:

The home page for the project is index.php. This page displays two tables. The first table is list of all actors in the database with their total revenue. Based on the requirement, an actor's revenue is calculated by summing the base amount with the revenue share for the movies they have done. To calculate actor's revenue, I assumed that each actor might have different base amount and different revenue share percentages for each movie (which I store in ACTOR_REVENUE_PER_MOVIE table). I also assumed that an actor gets the percentage of his revenue share only if the movie makes a profit. So, I collect MOVIE_BUDGET, MOVIE_REVENUE from REVENUE_PER_MOVIE table and apply the  
