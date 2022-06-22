<?php




class User {	
   
	private $userTable = 'user';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password && $this->loginType) {			
			$sqlQuery = "
				SELECT * FROM ".$this->userTable." 
				WHERE email = ? AND password = ? AND role= ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);			
			$stmt->bind_param("sss", $this->email, $password, $this->loginType);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];
				$_SESSION["role"] = $this->loginType;
				$_SESSION["name"] = $user['first_name']." ".$user['last_name'];		
				$_SESSION["img"] = $user['img_src'];			
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}
	






	public function loggedIn (){
		if(!empty($_SESSION["userid"]) && $_SESSION["userid"]) {
			return 1;
		} else {
			return 0;
		}
	}
	




	public function listUsers(){
		
		if($_SESSION['page']=='teacher'){

				$sqlQuery = "SELECT *
			FROM user WHERE role='teacher' ";
			
				
		}

               // student query
		
	   else { 
			$sqlQuery = "SELECT *
			FROM user WHERE role='student' ";
	    }





		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		
		 else {
			$sqlQuery .= 'ORDER BY id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare($sqlQuery);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($user = $result->fetch_assoc()) { 

			$rows = array();	
			
				if($_SESSION['page']=='student'){

					  $id_user=$user['id'];

			$sql_spec1 = "SELECT * FROM  student,specility WHERE student.id='$id_user' AND 
			student.id_spec1 = specility.id_specility ";
            $result1=mysqli_query($this->conn, $sql_spec1);
            $spec1=mysqli_fetch_assoc($result1);



			$sql_spec2 =  " SELECT * FROM  student,specility WHERE student.id='$id_user' AND 
			student.id_spec2 = specility.id_specility ";
            $result2=mysqli_query($this->conn, $sql_spec2);
			$spec2=mysqli_fetch_assoc($result2);
			
           

			

			$sql_spec3 ="SELECT * FROM  student,specility WHERE student.id='$id_user' AND 
			student.id_spec3 = specility.id_specility  ";
			  $result3=mysqli_query($this->conn, $sql_spec3);
              $spec3=mysqli_fetch_assoc($result3);
             

				}
else {

	$id_user=$user['id'];

$sql_spec1 = "SELECT * FROM  teacher,specility WHERE teacher.id='$id_user' AND 
teacher.id_spec1 = specility.id_specility ";
$result1=mysqli_query($this->conn, $sql_spec1);
$spec1=mysqli_fetch_assoc($result1);



$sql_spec2 =  " SELECT * FROM  teacher,specility WHERE teacher.id='$id_user' AND 
teacher.id_spec2 = specility.id_specility ";
$result2=mysqli_query($this->conn, $sql_spec2);
$spec2=mysqli_fetch_assoc($result2);



}





			$rows[] = $user['id'];
			$rows[] = ucfirst($user['first_name']." ".$user['last_name']);
			$rows[] = $user['email'];
            $rows[] = $user['mobile'];


         
		if($_SESSION['page']=='student')  {
           
			 if(mysqli_num_rows($result1)==0){ $rows[]='<center>/</center>'; } 
                else  $rows[] = $spec1['name_specility'];

			 if(mysqli_num_rows($result2)==0){ $rows[]='<center>/</center>'; } 
                else  $rows[] = $spec2['name_specility'];
			 
             if(mysqli_num_rows($result3)==0){ $rows[]='<center>/</center>'; } 
                else  $rows[] = $spec3['name_specility'];
		                 
		                                                  } 

		else {
           
			if(mysqli_num_rows($result1)==0){ $rows[]='<center>/</center>'; } 
				 else  $rows[] = $spec1['name_specility'];
											   
			if(mysqli_num_rows($result2)==0){ $rows[]='<center>/</center>'; } 
				else  $rows[] = $spec2['name_specility'];
															
			
																		 }



			$userRole = '';
			if($user['role'] == 'admin')	{
				$userRole = '<span class="label label-danger">Admin</span>';
			} 
			else if($user['role'] == 'user') {
				$userRole = '<span class="label label-warning">Member</span>';
			}	
						
			$rows[] = '<button  type="button" name="view" id="'.$user["id"].'" class="btn btn-info btn-xs view"><span title="View Tasks">View Details</span></button>';	
			// $rows[] = '<button type="button" name="update" id="'.$user["id"].'" class="btn btn-warning btn-xs update">Edit</button>';
			$rows[] = '<button type="button" name="delete" id="'.$user["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
            $rows[] = '<a href="contact.php?id_user='.$user["id"].'" type="button" class="btn btn-warning btn-xs update">contact</a>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	










	public function getUser(){
		if($this->id) {
			$sqlQuery = "
			SELECT  id, email,mobile, address, created
			FROM ".$this->userTable."			
			WHERE id = ?";		
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$records = array();		
			while ($user = $result->fetch_assoc()) { 				
				$rows = array();			
				$rows[] = $user['id'];
				// $rows[] = ucfirst($user['first_name']." ".$user['last_name']);					
				
			    $rows[] = $user['email'];	
				$rows[] = $user['mobile'];
				$rows[] = $user['address'];
				$rows[] = $user['created'];
				// $rows[] = $user['id_specility'];
				$records[] = $rows;
			}		
			$output = array(			
				"data"	=> 	$records
			);
			echo json_encode($output);
		}
	}








	public function getUserDetails(){		
		
		if($this->userid) {		
			$sqlQuery = "
				SELECT id, first_name, last_name, email, mobile, address, role
				FROM ".$this->userTable." 
				WHERE id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->userid);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$row = $result->fetch_assoc();
			echo json_encode($row);
		}		
	}
	








	
	public function insert() {      
		if($this->email) {		              
			$this->newPassword = md5($this->newPassword);			
			$queryInsert = "
				INSERT INTO ".$this->userTable."(first_name, last_name , mobile, email , role, address, password, id_specility) 
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
           
			

								
			$stmt = $this->conn->prepare($queryInsert);

			 if($_SESSION['page']='student')
            {
	          $stmt->bind_param("ssssssss", $this->firstName, $this->lastName , $this->mobile, $this->email, 'student', $this->address, $this->newPassword, '');	
			  $stmt->execute();


            }
			 else if($_SESSION['page']='teacher')
            {
	          $stmt->bind_param("ssssssss", $this->firstName, $this->lastName , $this->mobile, $this->email, 'teacher', $this->address, $this->newPassword, '');	
			  $stmt->execute();


            }
		
			
			
            // $last_id_user=mysqli_insert_id($this->conn);
			
			// 	if($_SESSION['page']='student')
            //   {

			//     $sql4 = "INSERT INTO student(id, id_student, id_spec1, id_spec2, id_spec3 )
			//     VALUES ('$last_id_user', '', '$spec1', '', '')";
            //     $result4 = mysqli_query($conn, $sql4);
            //                 }


			// else if($_SESSION['page']='teacher')
            //   {

			//     $sql4 = "INSERT INTO teacher(id, id_teacher, id_spec1, id_spec2)
			//     VALUES ('$last_id_user', '', '$spec1', '', '')";
            //     $result4 = mysqli_query($conn, $sql4);
            //                 }



		}
	}	






	
	public function update() {      
		if($this->updateUserId && $this->email) {		              
			
			$changePassword = '';
			if($this->newPassword) {
				$this->newPassword = md5($this->newPassword);
				$changePassword = ", password = '".$this->newPassword."'";
			}
			
			$queryUpdate = "
				UPDATE ".$this->userTable." 
				SET first_name = ?, last_name = ? , mobile = ?, email = ?, role = ?, address = ? $changePassword
				WHERE id = '".$this->updateUserId."'";				
			$stmt = $this->conn->prepare($queryUpdate);
			$stmt->bind_param("ssssss", $this->firstName, $this->lastName , $this->mobile, $this->email, $this->role, $this->address);	
			$stmt->execute();			
		}
	}
	
	public function delete() {      
		if($this->deleteUserId) {		          
			$queryDelete = "
				DELETE FROM ".$this->userTable." 
				WHERE id = ?";				
			$stmt = $this->conn->prepare($queryDelete);
			$stmt->bind_param("i", $this->deleteUserId);	
			$stmt->execute();		
		}
	}
}
?>