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

Movie Name: <input type="text" align="centre" name="moviename" /><br/><br/>
Production Company Id: <input type="number" align="centre" name="productioncompanyId" /><br/><br/>
Movie Budget: <input type="number" align="centre" name="moviebudget" /><br/><br/>
Movie Revenue: <input type="number" align="centre" name="movierevenue" /><br/><br/> 
<input type='submit' value="Submit"> <br/> <br/>

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