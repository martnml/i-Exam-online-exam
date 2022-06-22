<?php


	
	 $host  = 'localhost';
     $user  = 'root';
     $password   = "";
     $database  = "exam_system"; 
    
 		
		$conn = new mysqli($host, $user, $password, $database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);}
	





        
//---------------------------------------------------------------------------------------
     
                    $sqlll = "SELECT * FROM user WHERE user.role='teacher' ";
                      $result77 = mysqli_query($conn, $sqlll);




                                    ?>