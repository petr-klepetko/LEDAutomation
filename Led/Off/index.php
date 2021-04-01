<?php 
	header('Content-type: application/json');
	$result = shell_exec('sudo -u root python3 off.py');
	echo 	"{\"command_result\": \"$result\",";
	echo 	"\"status\": \"led is turning off\",";
	echo 	"\"page\": \"Off\"}";
?>

