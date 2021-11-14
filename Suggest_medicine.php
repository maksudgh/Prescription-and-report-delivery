<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		$id = $con->escape_string($_GET['id']);
		$_SESSION['id']=$id;
		$result1 = $con->getData("SELECT count(*) as count FROM medicine where id='$id'");
		foreach ($result1 as $res)
		{
			$count = $res['count'];
		}
		$result = $con->execute("SELECT * FROM patient WHERE id='$id'");
		foreach ($result as $res) 
		{
			$name = $res['Name'];
			$age = $res['Age'];
			$gender = $res['Gender'];
			$problem = $res['Problem'];
		}
		if(isset($_POST['save']))
		{
			$tests = $con->escape_string($_POST['tests']);
			$other_suggestions = $con->escape_string($_POST['other_suggestions']);
			$visit_date = $con->escape_string($_POST['Next_Visit_Date']);
			$msg = $validation->check_empty($_POST, array('Next_Visit_Date'));
			if($msg != null || $count==0) 
			{ 
				echo "<center>$msg' Or No Medicine Added'.</center>";		
				echo "<br/><center><a href='javascript:self.history.back();'><big>Go Back</big></a></center>";
			} 
			else
			{
				$result = $con->execute("UPDATE patient SET Tests='$tests',Suggestions='$other_suggestions',Next_Visit_Date='$visit_date' WHERE id=$id");
				header('Location: Edit_prescription_action.php?id='.$id);
			}
		}
        else
		{		
			if(isset($_POST['add']))
			{
				$medicine_name = $con->escape_string($_POST['medicine_name']);
				$taking_time = $con->escape_string(implode(",",$_POST['taking_time']));
				$days = $con->escape_string($_POST['days']);
				$msg = $validation->check_empty($_POST, array('medicine_name','taking_time','days'));
				if($msg != null) 
				{ 
					echo "<center>$msg</center>";		
					echo "<br/><center><a href='javascript:self.history.back();'><big>Go Back</big></a></center>";
				} 
				else 
				{
					$result = $con->execute("insert into medicine values ('','$medicine_name','$taking_time','$days','$id')");
					header('Location: Suggest_medicine.php?id='.$_SESSION['id']);
				}	
			}
			else
			{ 
?>
<html>
	<head>	
		<title>Prescription</title>
		
		
	</head>

	<body  style="background-color:lightblue">
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
		<div id="medicine">
		<center><h4><p>Medicine Added: <?php echo $count;?></p></h4></center>
			<form method="post">
			<table>
					<tr>
						<td>Medicine Name:</td>
						<td><input type="text" name="medicine_name" placeholder="Enter Medicine Name"/></td><td>&nbsp&nbsp</td>
						<td>Taking time:</td>
						<td>
							<input type="checkbox" name="taking_time[]" value="morning" checked />Morning
							<input type="checkbox" name="taking_time[]" value="Noon" checked />Noon
							<input type="checkbox" name="taking_time[]" value="Night" checked />Night &nbsp&nbsp&nbsp&nbsp
							<input type="radio" name="taking_time[]" value="Before eating" />Before Eating
							<input type="radio" name="taking_time[]" value="After eating" checked />After Eating
						</td>
						<td>&nbsp&nbsp&nbsp&nbspDays:</td>
						<td><input style="width:80" type="number" name="days" /></td><td>&nbsp&nbsp</td>
						<td><input type="submit" id="add1"  name="add" value="Add"/></td></td><td>&nbsp&nbsp</td>
					</tr>
			</table>
			</form><br><br>
		<form method="post">
			<table width="700">
				<tr><td colspan="2"><center><h3>Tests<h3></center></td></tr>
					<tr>
					<td>Tests Name:</td>
					<td><input type="text" style="height:50" name="tests" /></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
					<td>Other_Suggestions:</td>
					<td><input type="text" style="height:50" name="other_suggestions" /></td>
					</tr>
					<tr>
					<td>&nbsp </td>
					</tr>
					<tr>
					<td>Next Visit Date:</td>
					<td><input type="date" name="Next_Visit_Date" /></td>
					</tr>
					</table><br>
				<center><td><input style="height:40;width:90"type="submit" name="save" value="Save"/></td></center>
		</form>
	</body>
<?php
			}
		}
	}
	else
	{	
		echo "<center><font color='red'>You must be logged in to view this page.<br/><br/></center>";
		echo "<center><a href='HomePage.php'><big>Home</big></a> | <a href='Login.php'><big>Login</big></a></center>";		
	}
?>
</html>
