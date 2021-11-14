<?php
session_start();
include_once("classes/Connection.php");

$con = new Connection();

$id = $con->escape_string($_GET['id']);

$result = $con->delete($id, 'medicine');

if ($result) {
	header("Location:Edit_prescription_action.php?id=$_SESSION[Id]");
}
?>