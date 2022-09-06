<?php

include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../fact.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    header("Location: ../../login.php");
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

<?php include_once '../../inc/header.php' ?>;

<title>iExam</title>
</head>


<body >
 <input type="checkbox" id="nav-toggle">
 <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>I-Exam</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="teachers_exam.php" >
                        </br>
                        <p style="font-size:17px;">exams</p>
                    </a>
                </li>

                <li>
                    <a href="teacher_contact.php?id_user=9" class="active">
                        </br>
                        <p style="font-size:17px;">contact admin</p>
                    </a>
                </li>
                <li>
                    <a href="../../logout.php" onclick="return confirm('Are You sure you want to logout ?');">
                        </br>
                        <p style="font-size:16px;">logout</p>
                    </a>

                </li>

            </ul>
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
                <a href="admin_profile.html"><img src="../../<?php echo $_SESSION['img']; ?>" width="40px" height="40px"
                        alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>

            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="../../img/ring.png" alt="">
                <span id="msg_count"></span>

            </div>

            <div class="notifi-box" id="box">


            </div>
        </header>

        <center>

        <main style="background-color:#e7eaf1;">

           
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
            


    </div>
    </main>
    </center>
    </div>

    <?php  include_once "../../inc/footer.php"; ?>
    <script src="../../js/stat.js"></script> 
    <script src="../../js/js_notification.js"></script>
</body>

</html>