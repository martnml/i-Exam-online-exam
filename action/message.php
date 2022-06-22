<?php
include_once 'config/Database.php';
include_once 'class/User.php';

include('config/db_conn.php');
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    header("Location: login.php");
}


if(isset($_GET['id_msg'])){



    $id_msg=$_GET['id_msg'];
    
    $sql_respond="UPDATE message SET message.vue='1' WHERE MESSAGE.id_msg='$id_msg'";  
    $result=mysqli_query($conn, $sql_respond);
   
    $sql_msg="SELECT * FROM message,user WHERE message.id_msg='$id_msg' AND message.sender_id=user.id  ";
    $result_msg=mysqli_query($conn, $sql_msg);
    $row_msg=mysqli_fetch_assoc($result_msg);
    $num_msg= mysqli_num_rows($result_msg);
    
    $_SESSION['id_msg']=$_GET['id_msg'];
    $_SESSION['sender_id']=$row_msg['sender_id'];
     
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php    include('inc/header.php'); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>exams</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="css/switch.css">
</head>

<body style="background-color:#e7eaf1;">

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span></span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="admin_students.php"><span class="las la-users">

                            <p style="font-size:12px;">students</p>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="admin_teachers.php">
                        <span class="las la-user"></span>
                        </br>
                        <p style="font-size:17px;">teachers</p>

                    </a>
                </li>
                <li>
                    <a href="admin_branches.php">
                        </br>
                        <p style="font-size:17px;">branches</p>

                    </a>
                </li>
                <li>
                    <a href="admin_exams.php">
                        </br>
                        <p style="font-size:17px;">exams</p>
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
                        </br>
                        <p style="font-size:17px;">Contact</p>
                    </a>
                </li>

                <li>
                    <a href="logout.php" onclick="return confirm('Are You sure you want to logout ?');">
                        </br>
                        <p style="font-size:17px;">logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>

                <!-- <img src="img/ow.jpeg" style="width:17%; border-radius:20px;margin-bottom:-15px;"> -->
                &nbsp; I-<font style="color:#03bd8e">Exam</font>
            </h2>

            <!-- <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="SEARCH" />
            </div> -->
            <div class="user-wrapper">
                <a href="profile.php"><img src="<?php echo $_SESSION['img']; ?>" width="40px" height="40px" alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>

            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="img/ring.png" alt="">
                <span id="msg_count"></span>

            </div>

            <div class="notifi-box" id="box">


            </div>
        </header>


        <main>


            <center>
                <img src="img/tenor.gif" style="width:20%; border-radius: 20px; margin-top:-4%;">
                <section class="contact" id="contact">
                    <div class="max-width">




                        <div class="contact-content">

                            <div class="column right">

                                <div class="form">
                                    <div class="fields">
                                        <div class="field name">
                                            <input type="text" value="<?php echo $row_msg['first_name'];?>"
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


                                    <div class="field name">
                                        <input type="text" value="title :&nbsp;<?php echo $row_msg['title'];?>"
                                            disabled="disabled">
                                    </div>

                                    <div class="field textarea">
                                        <textarea cols="30" rows="10"
                                            placeholder="Content :&nbsp;<?php echo $row_msg['content'];?>"
                                            disabled="disabled"></textarea>
                                    </div>
                                    <a href="">
                                        <img src="img/delete.png" style="width:7%; margin-left:80%;"
                                            id="<?php echo $row_msg['id_msg']; ?>" onclick="delete_notif(this.id)"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </center>







            <br>
            <center>
                <section class="contact" id="contact">
                    <div class="max-width">




                        <div class="contact-content">

                            <div class="column right">




                                <div class="form">

                                    <div class="field textarea">
                                        <textarea cols="30" rows="10" placeholder="Your Respond.." required
                                            id="respond"></textarea>

                                    </div>
                                    <div class="button-area">
                                        <button onclick="send_msg()">Respond</button>
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
    <script src="js/select.js"></script>
    <script src="js/js_notification.js"></script>
</body>

</html>