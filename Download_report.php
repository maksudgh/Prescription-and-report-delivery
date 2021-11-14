<?php
	include_once("classes/Connection.php");
	$con = new Connection();
	$id = $con->escape_string($_GET['id']);
	$result=$con->execute("select * from reports where R_id = '$id'");
	foreach($result as $res)
	{
		$path=$res['Path'];
	}
	header('Content-Type: Application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($path).'"');
	header('Content-Length: ' . filesize($path));
	readfile($path);
?>
	