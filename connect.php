<?php 
	$connection = new mysqli('localhost', 'root','','dbfloretaf3');
	
	if (!$connection){
		die (mysqli_error($mysqli));
	}
		
?>