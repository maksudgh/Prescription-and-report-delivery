<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		$id =$con->escape_string($_GET['id']);
		$result = $con->execute("SELECT * FROM patient WHERE id='$id'");
		foreach ($result as $res) 
		{
			$name = $res['Name'];
			$age = $res['Age'];
			$gender = $res['Gender'];
			$problem = $res['Problem'];
		}
		$query = "SELECT * FROM reports where id = '$id' ";
		$result1 = $con->getData($query);
?>	
<html>
	<head>	
		<title>Reports</title>
	</head>

	<body>
			<p style="padding:5px 5px 10px 275px;background-color:white">
				<font size="+2">Patient's Information</font>
			</p>
			<h3><table width='40%' height="100">
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
	
			<table width='80%' border=0>
				<caption><h3>Reports</h3></caption>
				<tr bgcolor='#CCCCCC'>
					<th>Report Id</th>
					<th>Test Name</th>
					<th>Published Date</th>
					<th> </th>
				</tr>
				<?php 
			foreach ($result1 as $key => $res) {
			//while($res = mysqli_fetch_array($result)) { 		
				echo "<tr>";
				echo "<td><center>".$res['R_id']."</center></td>";
				echo "<td><center>".$res['Test_name']."</center></td>";
				echo "<td><center>".$res['U_date']."</center></td>";
				echo "<td><center> <a href='Download_report.php?id=$res[R_id]'>Download</a>";
				
			}?>
			</tr>
			</table><br><br>
			<center><a href='Doctor_access.php'><big>Home</big></a> | <a href='Logout.php'><big>Logout</big></a></center>
<?php
	}
?>			
	</body>
</html>
