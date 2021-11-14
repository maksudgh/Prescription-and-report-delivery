<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		if(isset($_POST['submit']))
		{
			$msg = $validation->check_empty($_POST, array('id', 'test_name','Upload_date','report'));
			if($msg != null) 
			{
				echo "<center>".$msg."</center>";
				echo "<a href='Report_collect.php'><center><big>Go back</big></center></a>";
			}
			else
			{
			$id = $con->escape_string($_POST['id']);
			$date = $con->escape_string($_POST['Upload_date']);
			$test_name = $con->escape_string($_POST['test_name']);
			$name = $_FILES['report']['name'];
			$tmp_name = $_FILES['report']['tmp_name'];
			if($name){
				$location = "document/$name";
				move_uploaded_file($tmp_name,$location);
				$result=$con->execute("insert into reports values('','$date','$location','$id','$test_name')");
				echo "<center><font color='green'>Report Uploaded successfully.</center>";
				echo "<br/><center><a href='Upload_report.php'><big>Upload Another One</big></a> | <a href='Logout.php'><big>Logout</big></a></center>";
			}
			}
		}
		
?>	
<html>
<head>	
	<title>Upload Report</title>
</head>

<body>
	<table><tr><td><form action="HomePage.php">
    <input style="background-color:gold;width:80;height:30" type="submit" value="Home" />
</form></td></tr></table>
	<p style="padding:5px 5px 10px 275px;background-color:lightblue"><font size="+2">Upload Report</font></p>
	<div align= "center" style="background-color:lightblue;">
	<center>
	<form action="Upload_report.php" method="post" enctype="multipart/form-data">
		<table width="65%" height = "300" border="0">
			<tr> 
				<td>Patient's Id:</td>
				<td><input type="text" name="id" placeholder="Enter Patient's Id"></td>
			</tr>
			<tr> 
				<td>Test Name:</td>
				<td><input type="text" name="test_name" placeholder="Enter Test's Name"></td>
			</tr>
			<tr> 
				<td>Upload Date:</td>
				<td>
					<input type="date" name="Upload_date" placeholder="">
				</td>
			</tr>
			<tr> 
				<td>Report</td>
				<td><input type="file" name="report"></td>
			</tr>		
			<tr> 
				<td align="right"><form><input style="height:30;width:80;color:green" name= "submit" type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>
	</center>
	</div>
	<?php
	}
	else
	{
	echo "<center><font color='red'>You must be logged in to view this page.<br/><br/></center>";
	echo "<center><a href='HomePage.php'><big>Home</big></a> | <a href='Login.php'><big>Login</big></a></center>";		
	}
?>	
</body>
</html>
