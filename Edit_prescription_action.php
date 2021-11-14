<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		$id = $_GET['id'];
		$result = $con->execute("SELECT * FROM patient WHERE id='$id'");
		foreach ($result as $res) 
		{
			$name = $res['Name'];
			$age = $res['Age'];
			$gender = $res['Gender'];
			$problem = $res['Problem'];
			$tests = $res['Tests'];
			$suggestion= $res['Suggestions'];
			$N_V_Date= $res['Next_Visit_Date'];
		}
		$query = "SELECT * FROM medicine where id = '$id' ";
        $result = $con->getData($query);
		if(isset($_POST['save']))
		{
			$tests = $con->escape_string($_POST['tests']);
			$other_suggestions = $con->escape_string($_POST['other_suggestions']);
			$visit_date = $con->escape_string($_POST['Next_Visit_Date']);
			$result = $con->execute("UPDATE patient SET Tests='$tests',Suggestions='$other_suggestions',Next_Visit_Date='$visit_date' WHERE id=$id");
			echo "<center>Successfully Updated<center>";
			echo "<br/>";
			echo "<center><h3><a href='Write_prescription.php'>Write Prescription</a> | <a href='Edit_prescription.php'>Edit Prescription</a> | <a href='Doctor_access.php'>Home</a> | <a href='Logout.php'>Logout</a></h3></center>";
		}
		else
		{
		
?>
<html>
	<head>	
		<title>Edit Prescription</title>
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
			</table></h3>
	
			<table width='80%' >
				<caption><h3>Medicines</h3></caption>
				<tr bgcolor='#CCCCCC'>
					<th>Medicine Name</th>
					<th>Taking time</th>
					<th>Days</th>
					
				</tr>
<?php 
	foreach ($result as $key => $res) {
	//while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td><center>".$res['M_name']."</center></td>";
		echo "<td><center>".$res['T_time']."</center></td>";
		echo "<td><center>".$res['Days']."</center></td>";	
		echo "<td><center> <a href='Edit_medicine.php?id=$res[M_id]'>Edit</a> | <a href='Delete_medicine.php?id=$res[M_id]' onClick='return confirm('Are you sure you want to delete?')'>Delete</a></center></td>";
		
	}
	?></tr>
	<tr><td> </td>
	</tr>
		<tr>
			<td></td><td></td><td></td><td><b> <a href='Add_medicine.php?id=<?php echo $id?>'>Add New Medicine</a></b> 
		</tr>
			</table><br>
			<form method="post">
			<table width="700">
					<tr>
					<td>Tests:</td>
					<td><input type="textarea" style="height:50" name="tests" value="<?php echo $tests;?>" /></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
					<td>Other_Suggestions:</td>
					<td><input type="textarea" style="height:50" name="other_suggestions" value="<?php echo $suggestion;?>"/></td>
					</tr>
					<tr>
					<td>&nbsp </td>
					</tr>
					<tr>
					<td>Next Visit Date:</td>
					<td><input type="date" name="Next_Visit_Date" value="<?php echo $N_V_Date;?>" /></td>
					</tr>
					</table><br>
				<center><td><input style="height:40;width:90"type="submit" name="save" value="Save"/></td></center>
		</form>
			<center><h3><a href='Write_prescription.php'>Write Prescription</a> | <a href='Doctor_access.php'>Home</a> | <a href='Logout.php'>Logout</a></h3></center>
			
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
