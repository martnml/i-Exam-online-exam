<?php 
include('../../config/db_conn.php');

$email = validate($_POST['email']); 
$first_name = validate($_POST['first_name']);
$last_name = validate($_POST['last_name']);
$pass = validate($_POST['password']);
$confirm_pass = validate($_POST['confirm_password']);
$mobile = validate($_POST['mobile']);
$adress = validate($_POST['adress']);
$spec1 = validate($_POST['spec1']);
$spec2 = validate($_POST['spec2']);


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
        $data= 'The Email is tokon  ,Please try another one';  }

   else {


         

           $sql2 = "INSERT INTO user(id, first_name, last_name, gender, email, password, mobile, address, created, role)
            VALUES ('', '$first_name', '$last_name', '', '$email' , '$pass', '$mobile', '$adress', current_timestamp(), 'teacher')";
            $result2 = mysqli_query($conn, $sql2);

           $last_id_user=mysqli_insert_id($conn);

           


            
           $sql4 = "INSERT INTO teacher(id, id_teacher, id_spec1, id_spec2)
            VALUES ('$last_id_user', '', '$spec1', '$spec2')";
            $result4 = mysqli_query($conn, $sql4);


            if(!$result ){ $data='You have Signed Up succesfuly';}
            else { $data='Unknown error occured';}
            }
}

        
echo json_encode($data);



?>