<?php 
include 'DBCONNECT.php';
include 'DAL.php';
?>
<html>
<head>
<title>Hollywood Portfolio</title>
</head>
<body>
<h1 align="center"> Welcome to Hollywood Portal </h1>
</br>
<h3>You can add a new movie here</h3>
<form action="addmovies.php" method="post">
<table>
<tr><td> Movie Name: </td><td><input type="text" align="centre" name="moviename" /><br/><br/></td></tr>
<tr><td>Production Company Id: </td><td><input type="number" align="centre" name="productioncompanyId" /><br/><br/></td></tr>
<tr><td>Movie Budget: </td><td><input type="number" align="centre" name="moviebudget" /><br/><br/></td></tr>
<tr><td>Movie Revenue: </td><td><input type="number" align="centre" name="movierevenue" /><br/><br/> </td></tr>
<tr><td><input type='submit' value="Submit"> <br/> <br/></td></tr>
</table>
</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['moviename'])|| empty($_POST['productioncompanyId']) || empty($_POST['moviebudget']) || empty($_POST['movierevenue']) ){
    echo("<script>alert('All fields are required.!')</script>");
} 
else{
$movie_name = $_POST['moviename'];
$production_company_Id = $_POST['productioncompanyId'];
$movie_budget=$_POST['moviebudget'];
$movie_revenue=$_POST['movierevenue'];
$users= new DAL();
$users -> addmovies($movie_name, $production_company_Id,$movie_budget,$movie_revenue);
}
}
?>
</table>
<a href="index.php">Back to Home Page</a>
</body>
</html>