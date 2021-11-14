<html>
	<head>	
		<title>Forget Id</title>
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
		
		<p>
			<font size="+10">This page is under construction because of some OTP issues</font>
		</p>
		
		<p><big>
		<?php echo "<a href='View_prescription.php'><center><big>Go back</big></center></a>";?>
		</p></big>
		
		<p style="padding:5px 5px 10px 275px;background-color:thistle">
			<font size="+2">Forget Id</font>
		</p>
		
		<div align= "center" style="background-color:thistle;">
			<center>
				<form method="post" name="form1" >
				<p style="color:red;">*Provide your lost account's information</p>
					<table width="75%" height = "200" border="0">
						<tr> 
							<td>Name</td>
							<td><input type="text" name="name" placeholder="Enter Your Name"></td>
						</tr>
						<tr> 
							<td>Phone</td>
							<td><input type="text" name="phone" placeholder="Enter Your Mobile No"></td>
						</tr>
						<tr> 
							<td>Age</td>
							<td><input type="text" name="age" placeholder="Enter Your Age"></td>
						</tr>
			
						<tr> 
							<td><input style="height:30;width:80;color:green" type="button" Id="submit" value="Submit" onclick ="msg();"></td>
						</tr>
					</table>
				</form>
			</center>
		</div>	
	</body>
</html>

<script>
	
	document.getElementById("submit").onclick=msg;
	
		function msg()
			{
				alert("Id has sent to your phone number");
			}
</script>