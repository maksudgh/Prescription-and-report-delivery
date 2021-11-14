<?php session_start();
	if(isset($_SESSION['valid'])) 
	{
?>
<html>
	<head>
		<title>Doctor access</title>
	</head>
	<body>
			<div style="background-color:lightblue;">
				<center>
					<table height="300">
						<tr>
						<td>
						<form action="Write_prescription.php"></td>
							</tr>
							<tr>
								<td><input style="color:red;width:200;height:40" type="submit" value="Write Prescription" /></td>						</form >
						</form>
								<td>&nbsp;&nbsp;&nbsp; </td>
								<td><form action="Edit_prescription.php"></td>
							</tr>
							<tr>
								<td><input style="color:red;width:200;height:40" type="submit" value="Edit Prescription" /></td>
						</form >
								<td>&nbsp;&nbsp;&nbsp; </td>
								<td><form action="View_report.php"></td>
							</tr>
							<tr>
								<td><input style="color:red;width:200;height:40" type="submit" value="View Report" /></td>
						</form >
								<td>&nbsp;&nbsp;&nbsp; </td>
								<td><form action="Logout.php"></td>
							</tr>
							<tr>
								<td><input style="color:red;width:200;height:40" type="submit" value="Logout" /></td>
						</form >
					</table><br><br>
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