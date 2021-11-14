<html>
<head>	
	<title>Collect Report</title>
</head>

<body>
	<table><tr><td><form action="HomePage.php">
    <input style="background-color:gold;width:80;height:30" type="submit" value="Home" />
</form></td></tr></table>
	<p style="padding:5px 5px 10px 275px;background-color:lightblue"><font size="+2">Collect Report</font></p>
	<div align= "center" style="background-color:lightblue;">
	<center>
	<form method="post">
		<table width="75%" height = "200" border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id" placeholder="Enter Your Id"></td>
			</tr>
			<tr> 
				<td>Phone</td>
				<td><input type="text" name="phone" placeholder="Enter Your Mobile No"></td>
			</tr>
			<tr> 
				<td align="right"><input style="height:30;width:80;color:green" name="submit" type="submit" value="Submit" /></td>
			</tr>
		</table>
	</form>
	</center>
	</div>
</body>
</html>
<?php
	session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
		if(isset($_POST['submit'])) 
		{
			$id = $con->escape_string($_POST['id']);
			$phone = $con->escape_string($_POST['phone']);
			$_SESSION['valid']=$phone;
			$msg = $validation->check_empty($_POST, array('id', 'phone'));
			
			if($msg != null) 
			{
				echo "<center>".$msg."</center>";
				echo "<a href='Report_collect.php'><center><big>Go back</big></center></a>";
			}
			else 
			{
				$query = "SELECT * FROM patient WHERE Id='$id' AND Phone='$phone'";			 
				
				$result = $con->getData($query);
				if($result==false)
				{
					echo "<center>Invalid Id or Phone.<center>";
					echo "<br/>";
					echo "<a href='Report_collect.php'><center><big>Refresh</big></center></a>";
				}
				else
				{
					header('Location: All_reports.php?id='.$id);
				}
			}
		}
?>		