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
<h3>Script Details</h3>
<table width="100%" style="max-width:70%;" align="center" border="1px">
    <tr>
	    <th>Movie Name</th>
        <th>Actor Name</th>
		<th>Character Name</th>
		<th>Line</th>
		<th>Number of lines of the character in the script</th>
		<th>Number of words of the character in the script</th>
    </tr>
<?php
$users= new DATAVIEWER();
$users -> showScriptInfo();
?>
<h3> </h3>
</table>
</br>
<h3>Details of Characters being referenced by other characters</h3>
<table width="100%" style="max-width:70%;" align="center" border="1px">
    <tr>
	    <th>Movie Name</th>
		<th>Character Name</th>
		<th>Number of times character's reference is made by other characters</th>
    </tr>
<?php
$users= new DATAVIEWER();
$users -> showCharacterReferenceInfo();
?>
</table>
</br>
<a href="index.php">Back to Home Page</a>
</body>
</html>