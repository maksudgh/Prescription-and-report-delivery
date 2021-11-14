<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		$id = $con->escape_string($_GET['id']);
		$result = $con->execute("SELECT * FROM patient WHERE id='$id'");
		$result2 = $con->getData("SELECT count(*) as count FROM medicine where id='$id'");
		foreach ($result2 as $res)
		{
			$count = $res['count'];
		}
		if($count==0)
		{	echo "<center>Id is not Prescribed Yet<center>";
			echo "<br/>";
			echo "<a href='Edit_prescription.php'><center><big>Go Back</big></center></a>";
		}
		else
		{		
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
			$result1 = $con->getData($query);		
?>
<html>
	<head>	
		<title>Prescription</title>
	</head>

	<body>
	<div id="prescription">
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
			</table></h3><br>
	
			<table width='60%' border=0>
				<caption><h3>Medicines</h3></caption>
				<tr bgcolor='#CCCCCC'>
					<th>Medicine Name</th>
					<th>Eating Time</th>
					<th>Days</th>
				</tr>
			<?php 
			foreach ($result1 as $key => $res) {
			//while($res = mysqli_fetch_array($result)) { 		
				echo "<tr>";
				echo "<td><center>".$res['M_name']."</center></td>";
				echo "<td><center>".$res['T_time']."</center></td>";
				echo "<td><center>".$res['Days']."</center></td>";	
				
			}
			?></tr>
			</table><br><br>
			<table width='40%' border=0>
				<tr bgcolor='#CCCCCC'>
					<th>Tests</th>
					<th>Suggestions</th>
				</tr>
				<tr>
					<td><center><?php echo $tests;?></center></td>
					<td><center><?php echo $suggestion;?></center></td>
				</tr>	
			</table><br><br>
			
					<b><td>Next Visit Date:</td><b>
					<td><?php echo $N_V_Date;?></td>
					
		</div>
	<center><a href="#" onclick="HTMLtoPDF()"><big>Download PDF</big></a></center><br><br>

	<!-- these js files are used for making PDF -->
	<script src="jspdf.js"></script>
	<script src="jquery-2.1.3.js"></script>
	<script src="pdfFromHTML.js"></script>
		<center><h3><a href='Report_collect.php'>Collect Report</a> | <a href='HomePage.php'>Home</a></h3></center>

	</body>
<?php
}
		}
	else
		{		
		echo "<center><font color='red'>You must be logged in to view this page.<br/><br/></center>";
		echo "<center><a href='HomePage.php'><big>Home</big></a> | <a href='Login.php'><big>Login</big></a></center>";		
	}
?>
</html>

