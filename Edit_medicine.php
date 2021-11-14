<?php session_start();
	include_once("classes/Connection.php");
	include_once("classes/Validation.php");

	$con = new Connection();
	$validation = new Validation();
	if(isset($_SESSION['valid'])) 
	{	
		$id1 = $_SESSION['Id'];
		echo $id1;
		$id = $con->escape_string($_GET['id']);
		$query = "SELECT * FROM medicine where M_id = '$id' ";
		$result1 = $con->getData($query);	
		foreach ($result1 as $res) 
		{					
		$name = $res['M_name'];
		$day = $res['Days'];
		}		
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
					$result = $con->execute("UPDATE medicine set M_name='$medicine_name',T_time='$taking_time',Days='$days' where M_id='$id'");
					header('Location: Edit_prescription_action.php?id='.$id1);
				}	
			}
			else
			{
?>				
<html>
	<head>
		<title>Edit Medicine</title>
	</head>
	<body>
		<br><br><form style="background-color:lightblue" method="post">
			<table height="20%">
				<caption><center><h3>Edit Medicine<h3></center></caption>
					<tr>
						<td>Medicine Name:</td>
						<td><input type="text" name="medicine_name" placeholder="Enter Medicine Name" value= "<?php echo $name;?> "/></td><td>&nbsp&nbsp</td>
						<td>Taking time:</td>
						<td>
							<input type="checkbox" name="taking_time[]" value="morning" checked />Morning
							<input type="checkbox" name="taking_time[]" value="Noon" checked />Noon
							<input type="checkbox" name="taking_time[]" value="Night" checked />Night &nbsp&nbsp&nbsp&nbsp
							<input type="radio" name="taking_time[]" value="Before eating" />Before Eating
							<input type="radio" name="taking_time[]" value="After eating" checked />After Eating
						</td>
						<td>&nbsp&nbsp&nbsp&nbspDays:</td>
						<td><input style="width:80" type="number" name="days" value= "<?php echo $day;?>"/></td><td>&nbsp&nbsp</td>
						<td><input type="submit" id="add1"  name="add" value="Update"/></td></td><td>&nbsp&nbsp</td>
					</tr>
			</table>
		</form>
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