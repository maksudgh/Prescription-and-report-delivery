<?php session_start(); ?>
<html>
	<head>
		<title>login</title>
	</head>

	<body>
		<table>
			<tr>
				<td>
					<form action="HomePage.php">
						<input style="background-color:gold;width:80;height:30" type="submit" value="Home" />
					</form>
				</td>
			</tr>
		</table>
<?php
	include_once("Classes/Connection.php");
	include_once("Classes/Validation.php");
	$con= new Connection();
	$validation = new Validation();
	if(isset($_POST['submit'])) 
	{
		$userName = $con->escape_string($_POST['username']);
		$pass = $con->escape_string($_POST['password']);

		$msg = $validation->check_empty($_POST, array('username', 'password'));
		
		if($msg != null) 
		{
			echo "<center>".$msg."</center>";
			echo "<a href='login.php'><center><big>Go back</big></center></a>";
		}
		else 
		{
			$query = "SELECT * FROM users WHERE Username='$userName' AND Password='$pass'";			 
			
			$result = $con->getData($query);
			if($result==false)
			{
				echo "<center>Invalid username or password.<center>";
				echo "<br/>";
				echo "<a href='login.php'><center><big>Go Back</big></center></a>";
			}
			else
			{
				foreach ($result as $res) 
				{
					//$rows = $row->fetch_assoc();
			
					if(is_array($result) && !empty($result)) 
					{
						$validuser = $res['Username'];
						$status = $res['Status'];
						$_SESSION['status'] = $status;
						$_SESSION['valid'] = $validuser;
						$_SESSION['name'] = $res['Name'];
					}
					else 
					{
						echo "Invalid username or password.";
						echo "<br/>";
						echo "<a href='login.php'>Refresh</a>";
					}
					
					if(isset($_SESSION['valid'])) 
					{
						if($_SESSION['status']=='Doctor')
							header('Location: Doctor_access.php?id=$res[Username]');
						else if	($_SESSION['status']=='Counter_Stuff')
							header('Location: Patient_registration.php?id=$res[Username]');
						else if ($_SESSION['status']=='Lab_Stuff')
							header('Location: Upload_report.php?id=$res[Username]');
						else
						{
							echo "<script>alert('Invalid Username and Password');<?phpheader ('Location: Login1.php');?></script>";
							
						}	
					}
				}
			}
		}
    }
 else 
	{
?>
		<p style="padding:5px 5px 10px 250px;background-color:aquamarine">
			<font size="+2">Login </font>
		</p>
		<div align= "center" style="background-color:aquamarine;">
			<center>
				<form method="post" action="">
					<table width="75%" height="200" border="0">
						<tr> 
							<td width="15%"><b>Username</b></td>
							<td><input type="text" name="username"/></td>
						</tr>
						<tr> 
							<td><b>Password</b></td>
							<td><input type="password" name="password"/></td>
						</tr>
						<tr> 
							<td>&nbsp;</td>
							<td><input style="width:80;height:25" type="submit" name="submit" value="Login"></td>
						</tr>
					</table>
				</form>
			</center>
<?php	
	}
?>		
		</div>
	</body>
</html>