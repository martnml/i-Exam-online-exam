<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once '../../fact.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    header("Location: login.php");
}

$id_user=$_SESSION['userid'];
$sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count=mysqli_query($conn, $sql_count);
$num_count= mysqli_num_rows($result_count);
$_SESSION['the_user']=$_SESSION['userid'];

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../../inc/header.php');?>
    <title>students</title>
    <script src="../../js/user_exam.js"></script>
    <script src="../../js/general.js"></script>


</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="student_enroll_exam.php">
                        <p style="font-size:17px;">Exams</p>

                    </a>
                </li>
                <br>
                <li>
                    <a href="student_view_exam.php" class="active">
                        <p style="font-size:17px;">Check Exams</p>
                    </a>
                </li>
                <br>

                <li>
                    <a href="#">
                        <p style="font-size:17px;">Passing Exam & check result</p>
                    </a>
                </li>
                <br>
                <li>
                    <a href="contact.php?id_user=9">

                        <p style="font-size:17px;">contact admin</p>
                    </a>
                </li>
                <br>
                <li>
                    <a href="logout.php">
                        <p style="font-size:17px;">Logout</p>
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
            <div class="cards">

                <!-- 
                <div class="card-single">
                    <div>
                        <h1>5</h1>
                        <span>full exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1>5</h1>
                        <span>Your presence</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div> -->



            </div>
            <!--Tabla-->
            <div class="container" style="background-color:#f4f3ef;">
                <h2>My exams</h2>

                <br>

                <div>

                    <table id="userExamListing" class="table table-bordered table-striped">
                        <thead>
                            <tr style="background-color:#ff4546;">
                                <th>Id</th>
                                <th>Exam Title</th>
                                <th>Duration</th>
                                <th>Total Question</th>
                                <th>R/Q Mark</th>
                                <th>W/Q Mark</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>


    </div>
    </main>

    <script src="js/stat.js"></script>
    <script src="js/js_notification.js"></script>
</body>

</html>