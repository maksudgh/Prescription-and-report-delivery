<?php session_start();
	include_once("classes/Connection.php");

	$con = new Connection();
	if(isset($_SESSION['valid'])) 
	{	
		$result = $con->execute("SELECT * FROM patient");
		foreach ($result as $res) 
		{
			$id=$res['Id'];
			$name = $res['Name'];
			$age = $res['Age'];
			$gender = $res['Gender'];
			$problem = $res['Problem'];
		}
?>	
<html>
	<head>	
		<title></title>
	</head>

	<body>
			<p style="padding:5px 5px 10px 275px;background-color:white">
				<font size="+2">Patient's Information</font>
			</p>
			<h3><table width='40%' height="100">
			
				<tr>
					<td>Patient's Id:</td><td><?php echo $id; ?></td> 
				</tr>
				<tr>
					<td>Patient's Name:</td><td><?php echo $name; ?></td> 
				</tr>
				<tr>
					<td>Patient's Age:</td><td><?php echo $age; ?></td>
				</tr>
				<tr>
					<td>Gender:</td><td><?php echo $gender; ?></td>
				</tr>
				<tr>
					<td>Problems:</td><td><?php echo $problem; ?></td>
				</tr>
			</table></h3><br><br><br>
	
			<center><h3> <a href='Patient_registration.php'>Go back</a></h3></center>
<?php
	}
?>			
	</body>
</html>
