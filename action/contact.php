<?php

include_once '../config/Database.php';
include_once '../class/User.php';
include_once '../fact.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    header("Location: ../login.php");
}



//add
if(isset($_GET['id_user'])){
$id_user=$_GET['id_user'];
$sql_user="SELECT * FROM user WHERE user.id='$id_user'  ";
$result_msg=mysqli_query($conn, $sql_user);
$row_msg=mysqli_fetch_assoc($result_msg);
}

$_SESSION['sender_id']=$_GET['id_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  




<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/notification.css">
<link rel="stylesheet" href="../css/switch.css">
<link rel="stylesheet" href="../css/tag.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
 <!-- <script src="../js/stat.js"></script> -->
<script src="../js/js_notification.js"></script>








<title>iExam</title>
</head>

<body >
<?php if($_SESSION['role']=="stduent")

    {?> <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span></span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                
            <li>
          <a href="student/student_enroll_exam.php" >
              <p style="font-size:17px;">Exams</p>
          </a>
      </li>
      <br>
      <li>
          <a href="student/student_view_exam.php">
              <p style="font-size:17px;">Check Exams</p>
          </a>
      </li>
      <br>
      <li>
          <a href="#">
              <p style="font-size:15px;">Passing Exam & check result</p>
          </a>
      </li>
      <br>
      <li>
         <a href="#" class="active">
                        <p style="font-size:17px;">Contact admin</p>
     </li>

            

                <li>
                    <a href="../logout.php" onclick="return confirm('Are You sure you want to logout ?');">
                        </br>
                        <p style="font-size:17px;">logout</p>
                    </a>
                </li>


            </ul> <?php } ?>
        
        
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">

                </label> I-<font style="color:#ff4546;">Exam</font>
            </h2>

            
            
            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="SEARCH" />
            </div> 


            <div class="user-wrapper">
                <a href="admin_profile.html"><img src="../<?php echo $_SESSION['img']; ?>" width="40px" height="40px"
                        alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>

            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="../img/ring.png" alt="">
                <span id="msg_count"></span>

            </div>

            <div class="notifi-box" id="box">


            </div>
        </header>


        <main style="background-color:#e7eaf1;">

            <center>
                <br><br>
                <img src="../img/tenor.gif" style="width:25%; border-radius: 20px; margin-top:-4%;">
                <section class="contact" id="contact">
                    <div class="max-width">


                        <div class="contact-content">

                            <div class="column right">

                                <div class="form">
                                    <div class="fields">
                                        <div class="field name">
                                            <input type="text" value="<?php  echo $row_msg['first_name']; ?>"
                                                disabled="disabled">
                                        </div>

                                        <div class="field name">
                                            <input type="text" value="<?php echo $row_msg['last_name'];?>"
                                                disabled="disabled">
                                        </div>

                                    </div>

                                    <div class="field name">
                                        <input type="text" value="<?php echo $row_msg['email'];?>" disabled="disabled">
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </center>




            <center>
                <!-- <img src="img/tenor.gif" style="width:25%; border-radius: 20px; margin-top:-4%;"> -->
                <section class="contact" id="contact">
                    <div class="max-width">




                        <div class="contact-content">

                            <div class="column right">

                                <div class="form">


                                    <div class="field name">
                                        <input type="text" placeholder="Title" id="title" required>
                                    </div>


                                    <div class="field textarea">

                                        <textarea cols="30" rows="10" id="respond" placeholder="Type Your Message.."
                                            required></textarea>

                                    </div>
                                    <div class="button-area">
                                        <button id="send">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </center>


    </div>
    </main>
    </div>

    <?php  include "../inc/footer.php"; ?>
    
    <!-- <script src="../js/select.js"></script> -->
    <script src="../js/js_notification.js"></script>
</body>

</html>