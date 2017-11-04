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
<h3>You can add a new actor here</h3>
<form action="addactor.php" method="post">

Actor's Name: <input type="text" align="centre" name="actorname" /><br/> <br/>
<input type='submit' value="Submit"> <br/> <br/>

</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['actorname'])){
   echo 'You need to enter Actor\'s name. <br/>';
}
else{	
$actor_name = $_POST['actorname'];
$users= new DAL();
$users -> addactor($actor_name);
}
}
?>
</table><br/><br/>
<a href="index.php">Back to Home Page</a>
</body>
</html>