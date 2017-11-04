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
<h3>You can add characters to a movie here</h3>
<form action="addcharactertomovie.php" method="post">
<table>
<tr>
<td>Movie Name: </td>
<td> <input type="text" align="centre" name="moviename" /></td><br/>
</tr>
<tr><td>Enter First Actor Name : </td>
<td><input type="text" align="centre" name="firstactorname" /><br/></td></tr>
<tr><td>First Character Name   : </td><td><input type="text" align="centre" name="firstcharactername" /><br/></td></tr>
<tr><td>Enter Base Amount      : </td><td><input type="number" align="centre" name="firstbaseamount" /><br/></td></tr>
<tr><td>Enter Revenue Share    : </td><td><input type="number" align="centre" name="firstrevenueshare" /><br/></td></tr>

<tr><td>Enter Second Actor Name: </td><td><input type="text" align="centre" name="secondactorname" /><br/></td></tr>
<tr><td>Second Character Name  : </td><td><input type="text" align="centre" name="secondcharactername" /><br/></td></tr>
<tr><td>Enter Base Amount      : </td><td><input type="number" align="centre" name="secondbaseamount" /><br/></td></tr>
<tr><td>Enter Revenue Share    : </td><td><input type="number" align="centre" name="secondrevenueshare" /><br/></td></tr>

<tr><td>Enter Third Actor Name :</td><td> <input type="text" align="centre" name="thirdactorname" /><br/></td></tr>
<tr><td>Enter Character Name: </td><td><input type="text" align="centre" name="thirdcharactername" /><br/></td></tr>
<tr><td>Enter Base Amount: </td><td><input type="number" align="centre" name="thirdbaseamount" /><br/></td></tr>
<tr><td>Enter Revenue Share: </td><td><input type="number" align="centre" name="thirdrevenueshare" /><br/></td></tr>

<tr><td>Enter Fourth Actor Name: </td><td><input type="text" align="centre" name="fourthactorname" /><br/></td></tr>
<tr><td>Enter Character Name: </td><td><input type="text" align="centre" name="fourthcharactername" /><br/></td></tr>
<tr><td>Enter Base Amount: </td><td><input type="number" align="centre" name="fourthbaseamount" /><br/></td></tr>
<tr><td>Enter Revenue Share: </td><td><input type="number" align="centre" name="fourthrevenueshare" /><br/></td></tr>

<tr><td><input type='submit' value="Submit"> <br/> <br/></td></tr>
</table>
</form>
<h4>Entered data is below: </h4>
<table width="100%" style="max-width:50%;" align="center" border="1px">
    <tr>
	    <th>Movie Name</th>
	    <th>Actor Name</th>
        <th>Character Name</th>
		<th>Base Amount</th>
		<th>Revenue Share</th>
    </tr>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
$movie_name = $_POST['moviename'];

$firstactorname = $_POST['firstactorname'];
$firstcharactername = $_POST['firstcharactername'];
$firstbaseamount= $_POST['firstbaseamount'];
$firstrevenueshare= $_POST['firstrevenueshare'];

$secondactorname = $_POST['secondactorname'];
$secondcharactername= $_POST['secondcharactername'];
$secondbaseamount= $_POST['secondbaseamount'];
$secondrevenueshare= $_POST['secondrevenueshare'];

$thirdactorname = $_POST['thirdactorname'];
$thirdcharactername= $_POST['thirdcharactername'];
$thirdbaseamount= $_POST['thirdbaseamount'];
$thirdrevenueshare= $_POST['thirdrevenueshare'];

$fourthactorname = $_POST['fourthactorname'];
$fourthcharactername= $_POST['fourthcharactername'];
$fourthbaseamount= $_POST['fourthbaseamount'];
$fourthrevenueshare= $_POST['fourthrevenueshare'];
$required = array('moviename','firstactorname','firstcharactername','firstbaseamount','firstrevenueshare','secondactorname','secondcharactername','secondbaseamount',
                  'secondrevenueshare','thirdactorname','thirdcharactername','thirdbaseamount','thirdrevenueshare','fourthactorname',
				  'fourthcharactername','fourthbaseamount','fourthrevenueshare');
// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if ($error) {
  echo("<script>alert('All fields are required.!')</script>");
}else{
$actors = array($firstactorname,$secondactorname,$thirdactorname,$fourthactorname);
$characters= array($firstcharactername,$secondcharactername,$thirdcharactername,$fourthcharactername);
$baseamounts = array($firstbaseamount,$secondbaseamount,$thirdbaseamount,$fourthbaseamount);
$revenues = array($firstrevenueshare,$secondrevenueshare,$thirdrevenueshare,$fourthrevenueshare);
$users= new DAL();
$users -> addmoviedetails($movie_name,$actors,$characters,$baseamounts,$revenues);
}
}
?>
</table>
<a href="index.php">Back to Home Page</a>
</body>
</html>