<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		if(isset($_POST['submit'])) 
		{		
			
			$name = $con->escape_string($_POST['name']);
			$phone = $con->escape_string($_POST['phone']);
			$age = $con->escape_string($_POST['age']);
			$gender = $con->escape_string($_POST['gender']);
			$problem = $con->escape_string($_POST['problem']);
			$msg = $validation->check_empty($_POST, array('name', 'phone', 'age', 'gender', 'problem'));
			$check_phone = $validation->is_phone_valid($_POST['phone']);
			// checking empty fields
			if($msg != null) 
			{ 
				echo '<center>.$msg.</center>';		
				echo "<br/><center><a href='javascript:self.history.back();'><big>Go Back To Registration Page</big></a></center>";
			} 
			elseif (!$check_phone) 
			{
				echo '<center>Please provide a valid phone.</center>';
				echo "<br/><center><a href='javascript:self.history.back();'><big>Go Back To Registration Page</big></a></center>";
			}	
			
			else 
			{
				$result = $con->execute("INSERT INTO patient(Name,Phone,Age,Gender,Problem) VALUES('$name','$phone','$age','$gender','$problem')");
				echo "<center><font color='green'>Data added successfully.</center>";
				header("Location:added_patient.php");
				echo "<br/><center><a href='Patient_registration.php'><big>Create Another One<big></a> | <a href='Logout.php'><big>Logout<big></a></center>";
			}
		}
		else 
		{
			
?>		
<html>
<head>	
	<title>Patient Registration</title>
</head>

<body>
	<table>
		<tr>
			<td><form action="Logout.php">
				<input style="background-color:gold;width:80;height:30" type="submit" value="Logout" /></form>
			</td>
		</tr>
</table>
	<p style="padding:5px 5px 10px 275px;background-color:lightblue"><font size="+2">Patient Registration</font></p>
	<div align= "center" style="background-color:lightblue;">
	<center>
	<form method="post" action="Patient_registration.php">
		<table width="65%" height = "350" border="0">
			<tr> 
				<td>Patient's Name:</td>
				<td><input type="text" name="name" placeholder="Enter Patient's Name"></td>
			</tr>
			<tr> 
				<td>Phone:</td>
				<td><input type="phone" name="phone" placeholder="Enter Mobile No"></td>
			</tr>
			<tr> 
				<td>Age:</td>
				<td><input type="text" name="age" placeholder="Enter Age"></td>
			</tr>
			<tr> 
				<td>Geder:</td>
				<td>
					<input type="radio" name="gender" value="Male">Male
					<input type="radio" name="gender" value="Male">Female
				</td>
			</tr>
			<tr> 
				<td>problems:</td>
				<td><input style="height:50" type="text" name="problem"></td>
			</tr>	
			<tr> 
				<td align="right"><form><input style="height:30;width:80;color:green" name="submit" type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>
	</center>
	</div>
<?php 	
		}
	}	
	else
	{	
		echo "<center><font color='red'>You must be logged in to view this page.<br/><br/></center>";
		echo "<center><a href='HomePage.php'><big>Home</big></a> | <a href='Login.php'><big>Login</big></a></center>";		
	}
	
?>
</body>
</html>