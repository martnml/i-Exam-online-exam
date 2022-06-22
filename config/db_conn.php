<?php 
	include_once 'Database.php';
	 $host  = 'localhost';
     $user  = 'root';
     $password   = "";
     $database  = "exam_system"; 
    
 		
		$conn = new mysqli($host, $user, $password, $database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);}
	

?>