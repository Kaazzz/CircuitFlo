<?php 
	$connection = new mysqli('localhost', 'root','','dbdayagrof3');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>