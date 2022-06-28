<?php 
 
include "../../config/db_conn.php";




	$email = validate($_POST['email']); 
	$first_name = validate($_POST['first_name']);
	$last_name = validate($_POST['last_name']);
	$pass = validate($_POST['password']);
	$confirm_pass = validate($_POST['confirm_password']);
	$mobile = validate($_POST['mobile']);
	$adress = validate($_POST['adress']);
	$spec1 = validate($_POST['spec1']);
	$spec2 = validate($_POST['spec2']);
	$spec3 = validate($_POST['spec3']);


	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

$compil = "/^([a-zA-Z]{3,10}(\ )?)+$/";




if(strlen($last_name)<5 || strlen($first_name)<5){

	$data="first name and last name should be longer than 5";
 }	
 
 else if(!preg_match($compil,$first_name)){
		$data='enter first name correctly "only alphabetics" ';}
		

else  if(!preg_match($compil,$last_name)){
		     $data='enter last name correctly  "only alphabetics"  ';
		    }

		
		
	else if ($pass!=$confirm_pass){

				$data='password and confirmation should be identical ';
				}   		

else {

         $sql = "SELECT * FROM user WHERE user.email='$email' ";
		 $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {
			$data= 'The Email is already tokon ! Please try another one';  }

       else {


             

	           $sql2 = "INSERT INTO user(id, first_name, last_name, gender, email, password, mobile, address, created, role)
			    VALUES ('', '$first_name', '$last_name', '', '$email' , '$pass', '$mobile', '$adress', current_timestamp(), 'student')";
                $result2 = mysqli_query($conn, $sql2);

               $last_id_user=mysqli_insert_id($conn);

               


				
	           $sql4 = "INSERT INTO student(id, id_student, id_spec1, id_spec2, id_spec3 )
			    VALUES ('$last_id_user', '', '$spec1', '$spec2', '$spec3')";
                $result4 = mysqli_query($conn, $sql4);
 

                if($result2 &&$result4){ $data='** You have Signed Up succesfuly **';}
                else { $data='Unknown error occured';}
                }
}

			
echo json_encode($data);




//-------------------------------- teacher sign up ---------------------//



// else {

// 	$email = validate($_POST['email2']); 
// 	$first_name = validate($_POST['first_name2']);
// 	$last_name = validate($_POST['last_name2']);
// 	$pass = validate($_POST['password2']);
// 	$confirm_pass = validate($_POST['confirm_password2']);
// 	$mobile = validate($_POST['mobile2']);
// 	$adress = validate($_POST['adress2']);
// 	$spec1 = validate($_POST['spec_1_1']);
// 	$spec2 = validate($_POST['spec_2_2']);
	


// 	function validate($data){
//        $data = trim($data);
// 	   $data = stripslashes($data);
// 	   $data = htmlspecialchars($data);
// 	   return $data;
// 	}

// $compil = "/^([a-zA-Z]{3,10}(\ )?)+$/";


 
// if(!preg_match($compil,$first_name)){
// 		$data='enter first name correctly "only alphabetics" ';}
		

// else  if(!preg_match($compil,$last_name)){
// 		     $data='enter last name correctly  "only alphabetics"  ';
// 		    }
		
		

// else {

//          $sql = "SELECT * FROM user WHERE user.email='$email' ";
// 		 $result = mysqli_query($conn, $sql);

// 	    if (mysqli_num_rows($result) > 0) {
// 			$data= 'The Email is tokon  ,Please try another one';  }

//        else {


             

// 	           $sql2 = "INSERT INTO user(id, first_name, last_name, gender, email, password, mobile, address, created, role, id_specility)
// 			    VALUES ('', '$first_name', '$last_name', '', '$email' , '$pass', '$mobile', '$adress', current_timestamp(), 'student', '')";
//                 $result2 = mysqli_query($conn, $sql2);

//                $last_id_user=mysqli_insert_id($conn);

               


				
// 	           $sql4 = "INSERT INTO teacher(id, id_teacher, id_spec1, id_spec2)
// 			    VALUES ('$last_id_user', '', '$spec1', '$spec2')";
//                 $result4 = mysqli_query($conn, $sql4);
 

//                 if($result2 &&$result4){ $data='You have Signed Up succesfuly';}
//                 else { $data='Unknown error occured';}
//                 }
// }

			
// echo json_encode($data);



// }







// if (isset($_POST['email']) && isset($_POST['password'])
//     && isset($_POST['first_name'])&& isset($_POST['last_name']) && isset($_POST['adress'])
// 	&& isset($_POST['mobile']) && isset($_POST['confirm_password'])) {

// 	function validate($data){
//        $data = trim($data);
// 	   $data = stripslashes($data);
// 	   $data = htmlspecialchars($data);
// 	   return $data;
// 	}



// 	$email = validate($_POST['email']); 
// 	$pass = validate($_POST['pw']);
// 	$re_pass = validate($_POST['confirm_pw']);
// 	$name = validate($_POST['name']);
// 	$mobile = validate($_POST['mobile']);
// 	$adress = validate($_POST['adress']);
// 	$genre =validate($_POST['blood']);



// 	$user_data = 'email='. $email. '&name='. $name;
	
//       $compil = "/^([a-zA-Z]{3,10}(\ )?)+$/";



// 	if(!preg_match($compil,$name)){
// 		header("Location: sign.php?error=Enter name correctly: alphabetics only &$user_data");
// 		exit();}
	
// 		else  if (!ctype_digit($mobile)) {
// 			header("Location: sign.php?error=Enter phone correctly&$user_data");
// 			exit();}




// // verify if inputs length
//    else if(strlen($name) < 7){
// 	header("Location: sign.php?error=Enter your Full Name: longer than 7 &$user_data");
// 	exit();}

// 	else  if (strlen($email)< 4) {
// 		header("Location: sign.php?error=Email should be longer than 4&$user_data");
// 	    exit();}

// 	else if(strlen($adress)< 10){
// 			header("Location: sign.php?error=adress should be longer than 10&$user_data");
// 			exit();}

// 	else if(strlen($mobile)!= 10){
// 			header("Location: sign.php?error=phone number should be 10 digits&$user_data");
// 			exit();}

// 	else if(strlen($pass) < 5){
//         header("Location: sign.php?error=Password should be 5 or longer &$user_data");
// 	    exit();}
	
// 	else if(strlen($re_pass) < 5){
//         header("Location: sign.php?error=Confirm Password should be 5 or longer &$user_data");
// 	    exit();}
	


// // verify if password is equal confirm password

// else  if(strcmp($pass,$re_pass)!= 0){
// 			header("Location: sign.php?error=Password and Confim password are not equal &$user_data");
// 			exit();}



// 	//verify if inputs are empty
// 	else if (empty($email)) {
// 		header("Location: sign.php?error=Email is required&$user_data");
// 	    exit();
// 	}else if(empty($pass)){
//         header("Location: sign.php?error=Password is required&$user_data");
// 	    exit();}
	
// 	else if(empty($re_pass)){
//         header("Location: sign.php?error=Confirm Password is required&$user_data");
// 	    exit();}
	

// 	else if(empty($name)){
//         header("Location: sign.php?error=Name is required&$user_data");
// 	    exit();}

// 	else if (empty($adress)) {
// 			header("Location: sign.php?error=Adress is required&$user_data");
// 			exit();
// 		}
// 	else if (empty($mobile)) {
// 			header("Location: sign.php?error=Phone number is required&$user_data");
// 			exit();
// 		}



// 	else{

// 		 // hashing the password
//          $pass = md5($pass);

// 	     $sql = "SELECT * FROM user WHERE email='$email' ";
// 		 $result = mysqli_query($conn, $sql);
		
// 		 if (mysqli_num_rows($result) > 0) {
// 			header("Location: sign.php?error=The Email is takon try another one&$user_data");
// 	        exit();}
		
// 		 else {


		    
//            $sql2 = "INSERT INTO user(email, password, name, adress, mobile,
// 		   /////////) 
// 	                   VALUES('$email', '$pass', '$name', '$adress', '$mobile','$id_blood',0,0)";
//            $result2 = mysqli_query($conn, $sql2);

		   
           
// 		   if ($result2) {
//            	 header("Location: sign.php?success=Your have sign up successfully");
// 	         exit();}
           
// 		   else {
// 	           	header("Location: sign.php?error=unknown error occurred&$user_data");
// 		        exit();}
           
// 		       }
// 	}
	
// }

// else{
// 	header("Location: sign.php");
// 	exit();
// }



?>