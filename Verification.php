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
				<td>Verification Code</td>
				<td><input type="text" name="code" placeholder="Enter the Verification code"></td>
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
	$authKey = "2821AHjOf6TD3L5d338483";
	$senderId = "RunTest";

	if(isset($_POST['submit']))
	{
		$mobileNumber= $_SESSION['mobile'];
		$otp=$_POST['code'];
		$url="http://world.msg91.com/api/verifyRequestOTP.php?authkey=$authKey&mobile=$mobileNumber&otp=$otp";

		$curl = curl_init($url);

		curl_setopt_array($curl, array(
		 // CURLOPT_URL => "https://control.msg91.com/api/verifyRequestOTP.php?authkey=&mobile=&otp=",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $json= json_decode($response);

				  if($json->type=='success'){
				  	header('Location: Prescription.php');
				  }
				  if($json->type=='error'){
				  	echo 'Verification code is Wrong "'.$json->message.'"';
				  }
		}
    }
?>