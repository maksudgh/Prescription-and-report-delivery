<html>
<head>	
	<title>View Prescription</title>
</head>

<body>
	<table><tr><td><form action="HomePage.php">
    <input style="background-color:gold;width:80;height:30" type="submit" value="Home" />
</form></td></tr></table>
	<p style="padding:5px 5px 10px 275px;background-color:thistle"><font size="+2">View Prescription</font></p>
	<div align= "center" style="background-color:thistle;">
	<center>
	<form action="" method="post" name="form1" >
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
				<td><input style="height:30;width:80;color:green" type="submit" name="submit" value="Submit"></td>
				<td><a href="Forget_id.php">Forget Id</a></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
    session_start();
    $num=88;
	$authKey = "2821AHjOf6TD3L5d338483";
	$senderId = "RunTest";
	
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
				echo "<a href='View_prescription.php'><center><big>Go back</big></center></a>";
			}
			else 
			{
				$query = "SELECT * FROM patient WHERE Id='$id' AND Phone='$phone'";			 
				
				$result = $con->getData($query);
				if($result==false)
				{
					echo "<center>Invalid Id or Phone.<center>";
					echo "<br/>";
					echo "<a href='View_prescription.php'><center><big>Refresh</big></center></a>";
				}
				else
				{
					header('Location: Prescription.php?id='.$id);
				/*	$mobileNumber=$num.$_POST['phone'];
					
					if(strlen($mobileNumber)==13 && $mobileNumber!=null)
					{
						
						$_SESSION['mobile']= $mobileNumber;

						$message = 'Your Verification code is ##OTP##';
						$postData = array
						(
							'authkey' => $authKey,
							'mobiles' => $mobileNumber,
							'message' => $message,
							'sender' => $senderId,
							
						);
						$url="http://world.msg91.com/api/otp.php?authkey=$authKey&mobile=$mobileNumber&message=$message&sender=senderId";
						
						$curl = curl_init($url);

					curl_setopt_array($curl, array(
					  //CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?email=&template=&otp=%24otp&otp_length=&otp_expiry=&sender=%24senderid&message=%24message&mobile=%24mobile_no&authkey=%24authkey",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => $postData,
					  CURLOPT_SSL_VERIFYHOST => 0,
					  CURLOPT_SSL_VERIFYPEER => 0,
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					 
						if ($err) 
						{
						  echo "cURL Error #:" . $err;
						}
						else
						{
						  $json= json_decode($response);

						  if($json->type=='success'){
							header('Location: Verification.php');
						  }
						  if($json->type=='error'){
							echo 'Your OTP "'.$json->message.'"';
						  }
						}
					}
					else{
						echo"Invalid Phone number";
						}	*/	
				}
    
			}
		}
?>