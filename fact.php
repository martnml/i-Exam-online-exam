<?php

include('config/db_conn.php');





if (isset($_POST['faculty']))   {             fact($conn,$_POST['faculty']);    }
if (isset($_POST['dep']))       {            depart($conn,$_POST['dep']);    }
if (isset($_POST['delete_fact']))       {    delete_fact($conn,$_POST['delete_fact']);    }
if (isset($_POST['delete_depart']))       {   delete_depart($conn,$_POST['delete_depart']);    }
if (isset($_POST['delete_spec']))       {   delete_spec($conn,$_POST['delete_spec']);    }
if (isset($_POST['getstat']))       {       getstat($conn,$_POST['getstat']);    }
if (isset($_POST['getbranches']))       {   getbranches($conn,$_POST['getbranches']);    }
if(isset($_POST['teacher_specility']))  {   get_specilities($conn);  }
if (isset($_POST['get_notif']))   {        get_notif($conn);    }
if (isset($_POST['get_count']))   {        get_count($conn);    }
if (isset($_POST['confirm']))   {          update($conn,$_POST['iduser'],$_POST['password'],$_POST['confirm'],$_POST['old_pw']);    }
if (isset($_POST['respond'])&&isset($_POST['title']))   {      send_msg($conn,$_POST['respond'],$_POST['title']);    }
if (isset($_POST['delete_notif']))   {      delete_notif($conn,$_POST['delete_notif']);    }
if (isset($_POST['insert_fact']))       {   insert_fact($conn,$_POST['insert_fact']);    }
if (isset($_POST['depart_name']))       {   insert_depart($conn, $_POST['depart_name'], $_POST['id_faculty']);    }
if (isset($_POST['spec_name']))       {   insert_spec($conn, $_POST['spec_name'], $_POST['id_depart'],$_POST['spec_opt']);    }

//---------------------------------------------------------------------------------------

function delete_fact($conn,$id_fact) {  
	         
	$sql_delete = "DELETE FROM faculty  WHERE faculty.id_faculty ='$id_fact' ";	
    $result5=mysqli_query($conn, $sql_delete);
    }

function delete_depart($conn,$id_depart) {  
	         
	$sql_delete = "DELETE FROM departement  WHERE departement.id_departement ='$id_depart' ";	
    $result5=mysqli_query($conn, $sql_delete);
    
  }  



  function delete_spec($conn,$id_spec) {  
    
  $sql="SELECT * FROM student,teacher WHERE student.id_spec1='$id_spec'
  || student.id_spec2='$id_spec' || student.id_spec3='$id_spec' || teacher.id_spec1='$id_spec'||
  teacher.id_spec2='$id_spec'
  ";
  
$result=mysqli_query($conn, $sql);
$nums= mysqli_num_rows($result);
 

  if($nums>0)
  { echo('this specility contains some suers , please delete all users to continue !');}

  else {
	  $sql_delete = "DELETE FROM specility  WHERE specility.id_specility ='$id_spec' ";	
    $result5=mysqli_query($conn, $sql_delete);
  echo('specility deleted succecfuly');
  }
  

  }

function get_notif($conn){

 
  
  $id_user=$_SESSION['userid'];
  $sql_msg="SELECT * FROM message,user  WHERE message.reciever_id='$id_user' AND message.sender_id=user.id ORDER BY id_msg DESC ";
  $result_msg=mysqli_query($conn, $sql_msg);
  $num_msg= mysqli_num_rows($result_msg);
  

  echo'<h2>Notifications
  <span>'. $num_msg .'</span></h2>';





    while($row_msg=mysqli_fetch_assoc($result_msg)):  

      echo(
'<a href="message.php?id_msg='.$row_msg['id_msg'].'"><div class="notifi-item" id="msg">
  <img src="../../img'. $row_msg['img_src'].'" alt="profile image" class="img">
  <div class="text">

      <h4>'. $row_msg['title']  .' </h4>
      <p>'. $row_msg['content'] .'<a href=""></a></p>

      <img src="../../img/delete_sign.png" style="width:30px; margin-left:80%;"
              
          type="button"      id="'.  $row_msg['id_msg'] .'" onclick="delete_notif(this.id)">
  </div>
</div></a>');

     endwhile; 


    //  echo json_encode ($nums);



  
}


function get_count($conn){

  $id_user=$_SESSION['userid'];
  $sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
  $result_count=mysqli_query($conn, $sql_count);
  $num_count= mysqli_num_rows($result_count);
  


echo($num_count);

}

function delete_notif($conn,$id_notif) {  
	         
	$sql_delete = "DELETE FROM message  WHERE message.id_msg ='$id_notif' ";	
  $result=mysqli_query($conn, $sql_delete);
   
    }







function send_msg($conn,$respond,$title){
  
      
      $date=date('Y/m/d H:m:i');
      $reciever=$_SESSION['sender_id'];
      $sender=$_SESSION["userid"];

      $sql_insert = "INSERT INTO message(id_msg, sender_id, reciever_id, content, title, vue, datetime) 
      values('', '$sender', '$reciever','$respond', '$title', '0','$date') ";
      $result=mysqli_query($conn, $sql_insert);
       
      
    
     
      echo json_encode ('**your message has been sended**');
     }




function insert_fact($conn,$fact){

 $sql_insert = "INSERT INTO faculty (id_faculty, name_faculty) values( '', '$fact' ) ";	
 $result=mysqli_query($conn, $sql_insert);
    

}



function insert_depart($conn,$name_depart,$id_fact){

 $sql_insert = "INSERT INTO departement (id_faculty ,id_departement, name_departement) 
    values( '$id_fact', '' , '$name_depart' ) ";	
    
 $result=mysqli_query($conn, $sql_insert);
    

}


function insert_spec($conn,$name_spec,$id_depart,$opt){

 $sql_insert = "INSERT INTO specility (id_departement ,id_specility, name_specility, option_spec) 
    values('$id_depart', '', '$name_spec', '$opt') ";	
    
 $result=mysqli_query($conn, $sql_insert);
    

}



function fact($conn,$post){

  $fact=$post;


 $sql="SELECT * FROM faculty where faculty.name_faculty='$fact' ";
 $result=mysqli_query($conn, $sql);
 $row=mysqli_fetch_assoc($result);
  $id_fact=$row['id_faculty'];


 $sql1="SELECT * FROM departement where departement.id_faculty='$id_fact' ";
 $result1=mysqli_query($conn, $sql1);

  while($row=mysqli_fetch_assoc($result1)){

   echo '<option value="'.$row['id_departement'].'">'.$row['name_departement'].'</option><br>';

  }

  }



  

function getstat($conn)
  {
  $sql1 = "SELECT id FROM student ";
   $result1 = mysqli_query($conn, $sql1);
   $num_students = mysqli_num_rows($result1);

   $sql2 = "SELECT id FROM teacher ";
  $result2 = mysqli_query($conn, $sql2);
   $num_teachers = mysqli_num_rows($result2);

  $sql3 = "SELECT id FROM exams ";
  $result3 = mysqli_query($conn, $sql3);
  $num_exams = mysqli_num_rows($result3);

  $nums=array();

  $nums[]=$num_students;
  $nums[]=$num_students;
  $nums[]=$num_teachers;
  $nums[]=$num_exams;
  $nums[]=$num_students;

  echo json_encode ($nums);



  }



function getbranches($conn)
  {
  $sql1 = "SELECT id_faculty FROM faculty ";
  $result1 = mysqli_query($conn, $sql1);
  $num_fact = mysqli_num_rows($result1);

  $sql2 = "SELECT id_departement FROM departement ";
  $result2 = mysqli_query($conn, $sql2);
  $depart = mysqli_num_rows($result2);

   $sql3 = "SELECT id_specility FROM specility ";
   $result3 = mysqli_query($conn, $sql3);
  $num_spec = mysqli_num_rows($result3);

  $nums[]=$num_fact;
  $nums[]=$num_fact;
  $nums[]=$depart;
  $nums[]=$num_spec;
   $nums[]=$num_fact;

   echo json_encode ($nums);



}



function update($conn,$id,$pw,$confirm,$old){

$sql="SELECT password FROM user WHERE user.id='$id'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
$current_pw=$row['password'];



if($current_pw!=$old){

  echo('please enter the right password');

}
else if($pw!=$confirm){

  echo('please confirm your password correctly');
}
else{

echo('yes');
// $sql="UPDATE user SET user. "


}



}


  //-------------------------------------------------------


function depart($conn,$post){


   $id_dep=$post;

   $sql1="SELECT * FROM specility where specility.id_departement='$id_dep' ";
   $result1=mysqli_query($conn, $sql1);

   while($row=mysqli_fetch_assoc($result1)){
    echo '<option value="'.$row['id_specility'].'">'.$row['name_specility'].'&nbsp;('.$row['option_spec'].')</option><br>';

  }

  }

  function get_specilities($conn){

    $id_user=$_SESSION['userid'];
  
    if($_SESSION['role']=='teacher'){
    $sql="SELECT * FROM teacher WHERE teacher.id='$id_user'";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $id_spec1=$row['id_spec1'];
    $id_spec2=$row['id_spec2'];
    
    
    
    $sql="SELECT * FROM specility WHERE (specility.id_specility='$id_spec1' OR specility.id_specility='$id_spec2') ";
    $result=mysqli_query($conn, $sql);
    
    }
    else{
      $sql="SELECT * FROM specility  ";
      $result=mysqli_query($conn, $sql);
      
  
    }
  
  
    
     while($row=mysqli_fetch_assoc($result)): 
                                           
      echo'<option value="'.$row['id_specility'].'">'.
      $row['name_specility'].'&nbsp;('.$row['option_spec'].')</option>';
     
      
  endwhile; 
  }





if(isset($_POST['spec1'])){

  $spec=$_POST['spec1'];


  $sql1="SELECT * FROM specility WHERE specility.id_specility!='$spec' AND 
  specility.id_departement=specility.id_departement ";
  $result1=mysqli_query($conn, $sql1);

  // $row = mysqli_fetch_assoc($result1);
  // $id_depart=$row['id_departement'];

  // $sql2="SELECT * FROM specility WHERE specility.id_specility!='$spec' AND specility.id_departement='$id_depart'  ";
  // $result2=mysqli_query($conn, $sql2);

   while($row=mysqli_fetch_assoc($result1)){
    echo '<option value="'.$row['id_specility'].'">'.$row['name_specility'].'&nbsp;('.$row['option_spec'].')</option><br>';

  }
  }


if(isset($_POST['spec2'])){

    $spec2=$_POST['spec2'];
    // $spec0=$_POST['spec0'];
  
    $sql1="SELECT * FROM specility WHERE specility.id_specility!='$spec2'
    --  AND specility.id_specility!='$spec0'
     AND specility.id_departement=specility.id_departement ";
    $result1=mysqli_query($conn, $sql1);
  
    // $row = mysqli_fetch_assoc($result1);
    // $id_depart=$row['id_departement'];
  
    // $sql2="SELECT * FROM specility WHERE specility.id_specility!='$spec' AND specility.id_departement='$id_depart'  ";
    // $result2=mysqli_query($conn, $sql2);
  
     while($row=mysqli_fetch_assoc($result1)){
      echo '<option value="'.$row['id_specility'].'">'.$row['name_specility'].'&nbsp;('.$row['option_spec'].')</option><br>';
  
    }
    }


  if(isset($_GET['exam_id'])){

    $_SESSION['exam']=$_GET['exam_id'];

  }





if(isset($_GET['id_fact'])){

 $id_fact=$_GET['id_fact'];
 $sqll="SELECT * FROM departement WHERE departement.id_faculty='$id_fact' ";
 $result_depart=mysqli_query($conn, $sqll);

   }



if(isset($_GET['id_depart'])){
 
 $id_depart=$_GET['id_depart'];
 $sqll="SELECT * FROM specility WHERE specility.id_departement='$id_depart' ";
 $result_spec=mysqli_query($conn, $sqll);

}
if(isset($_GET['exam_id'])){

  $exam_id=$_GET['exam_id'];
 
  $sql="SELECT * FROM exams WHERE exams.id='$exam_id' ";
  $result=mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);
  $id_spec=$row['id_specility'];
 
 
 
  $sql2="SELECT * FROM specility WHERE specility.id_specility='$id_spec' ";
  $result2=mysqli_query($conn, $sql2);
  $row_specility=mysqli_fetch_assoc($result2);
 
 
 
  $sql_enroll="SELECT * FROM exam_enroll WHERE exam_enroll.exam_id='$exam_id' ";
  $result_enroll=mysqli_query($conn, $sql_enroll);
  $row_enroll=mysqli_fetch_assoc($result_enroll);
  $id_user=$row_enroll['user_id'];
 
 
  $sql3="SELECT * FROM user WHERE user.id='$id_user' ";
  $result3=mysqli_query($conn, $sql3);
  $row_user=mysqli_fetch_assoc($result3);
 
 
 
 
 }








//--------------------------------------------------


$id_user=$_SESSION['userid'];
$sql_msg="SELECT * FROM message,user  WHERE message.reciever_id='$id_user' AND message.sender_id=user.id ORDER BY id_msg DESC ";
$result_msg=mysqli_query($conn, $sql_msg);
$num_msg= mysqli_num_rows($result_msg);

//--------------------------------------------------

$sqll="SELECT * FROM faculty ORDER BY id_faculty ASC";
$resultt=mysqli_query($conn, $sqll);









?>