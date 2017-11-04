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
</br>
<h3>Search an Actor's Movies and Base Amount</h3>
<form action="actormoviemap.php" method="post">

Actor's Name: <input type="text" align="centre" name="actorname" /><br/> <br/>
<input type='submit' value="Submit"> <br/> <br/>

</form>
<table width="100%" style="max-width:50%;" align="center" border="1px">
    <tr>
	    <th>Actor Name</th>
        <th>Movie Name</th>
		<th>Base Amount</th>
    </tr>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['actorname'])){
   echo 'You need to enter Actor\'s name ';
}
else{	
$actor_name = $_POST['actorname'];
$users= new DATAVIEWER();
$users -> showActorInfo($actor_name);
}
}
?>
</table>
<a href="index.php">Back to Home Page</a>
</body>
</html>