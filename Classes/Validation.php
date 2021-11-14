<?php
class Validation 
{
	public function check_empty($data, $fields)
	{
		$msg = null;
		foreach ($fields as $value) {
			if (empty($data[$value])) {
				$msg .= "$value field empty<br>";
			}
		} 
		return $msg;
	}
	
	public function is_phone_valid($phone)
	{
		//if (is_numeric($age)) {
		if (preg_match("/^[0]{1}[1]{1}[1-9]{1}[0-9]{8}+$/", $phone)) {	//"reg ex" diye different type er jinish validate kora jay
			return true;
		} 
		return false;
	}
	
	
}
?>