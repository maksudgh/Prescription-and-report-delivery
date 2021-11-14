<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		if(isset($_POST['submit'])) 
		{
			$id = $con->escape_string($_POST['id']);
			$result1 = $con->getData("SELECT count(*) as count FROM medicine where id='$id'");
			foreach ($result1 as $res)
			{
				$count = $res['count'];
			}
			$msg = $validation->check_empty($_POST, array('id'));
			if($msg != null) 
			{ 
				echo "<center>$msg</center>";		
				echo "<br/><center><a href='javascript:self.history.back();'><big>Go Back</big></a></center>";
			} 
			else 
			{
				if($count==0)
				{
					$result = $con->execute("SELECT * FROM patient WHERE Id='$id'");
					if($result==false)
					{
						echo "<center>Invalid Id.<center>";
						echo "<br/>";
						echo "<a href='Write_prescription.php'><center><big>Go Back</big></center></a>";
					}
					else
					{
						foreach ($result as $res) 
						{
							$id= $res['Id'];
							header('Location: Suggest_medicine.php?id='.$id);
							
						}
					}
				}
				else
					{
						echo "<center>Id already prescribed<center>";
						echo "<br/>";
						echo "<a href='Write_prescription.php'><center><big>Go Back</big></center></a>";
					}
			}
		}
		else
		{
		?>
<html>
	<head>	
		<title>Write Prescription</title>
	</head>

	<body>
		<table>
		<tr>
			<td>
				<form action="Doctor_access.php">
					<input style="background-color:gold;width:80;height:30" type="submit" value="Home" />
				</form>
			</td>
			<td>
				<form action="Logout.php">
					<input style="background-color:gold;width:80;height:30" type="submit" value="Logout" />
				</form>
			</td>
		</tr>
	</table>
	<p style="padding:5px 5px 10px 275px;background-color:lightblue">
		<font size="+2">Write Prescription</font>
	</p>
	<div align= "center" style="background-color:lightblue;">
		<center>
			<form method="post">
				<table width="65%" height = "250" border="0">
					<tr> 
						<td>Patient's Id:</td>
						<td><input type="text" name="id" placeholder="Enter Patient's Id"></td>
					</tr>	
			<tr> 
				<td align="right"><input style="height:30;width:80;color:green" type="submit" name="submit" value="Submit" /></td>
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