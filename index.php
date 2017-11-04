<?php 
include 'DBCONNECT.php';
include 'DAL.php';
include 'DATAVIEWER.php';
?>
<html>
<head>
<title>Hollywood Portfolio</title>
</head>
<body>
<h1 align="center"> Welcome to Hollywood Portal </h1>

<h3> The below table gives the details of actors and their total revenue </h3>
<table width="100%" style="max-width:50%;" align="center" border="1px">
    <tr>
	    <th>Actor Name</th>
        <th>Actor Revenue</th>
    </tr>
<?php
$users= new DATAVIEWER();
$users -> showAllActorRevenue();
?>	
</table>
<br></br>
<h3> The below table gives the details of Production Companies, their total revenue and profit/loss</h3>
<table width="100%" style="max-width:50%;" align="center" border="1px">
    <tr>
	    <th>Movie Production Company</th>
        <th>Revenue</th>
		<th>Gain(+)/Loss(-)</th>
    </tr>
<?php
$users= new DATAVIEWER();
$users -> showProductionCompanyRevenue();
?>
</table></br>	
<a href="actor_movie_map.php">Click here to search an Actor's Movies and Base Amount </a></br></br>
<a href="scriptdetails.php">Click here for Movie Script Details</a></br></br>
<a href="addactor.php">Click here to a new Actor</a></br></br>
<a href="addmovies.php">Click here to Add Movies</a></br></br>
<a href="addcharactertomovie.php"> Click here to add movie details</a>
</body>
</html>