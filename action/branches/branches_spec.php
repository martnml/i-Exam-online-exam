<?php
include_once 'config/Database.php';
include_once 'class/User.php';
include_once 'fact.php';


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






    ?>







<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/header.php');?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>exams</title>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="css/branches.css">

</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span></span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="admin_students.php"><span class="las la-users">

                            <p style="font-size:17px;">students</p>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="admin_teachers.php"><span class="las la-user"></span>
                        </br>
                        <p style="font-size:17px;">teachers</p></span>

                    </a>
                </li>
                <li>
                    <a href="branches_faculty.php" class="active">

                        <p style="font-size:17px;">branches</p>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="admin_exams.php">

                        <p style="font-size:17px;">exams</p>
                    </a>
                </li>


                <li>
                    <a href="logout.php" onclick="return confirm('Are You sure you want to logout ?');">

                        <p style="font-size:17px;">logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">

                </label> I-<font style="color:#2ecc71">Exam</font>
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





        <main style="background:#dfe9e6;">
            <div class="cards">




                <div class="card-single">
                    <div>
                        <h1 id="faculty"></h1>
                        <span>total faculties</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1 id="departement"></h1>
                        <span>total departement</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 id="specility"></h1>
                        <span>total specilities</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>


            </div>


            <!------------------------------------------------->





            <div class="card">
                <div class="card-image" style="background-image: url('img/speciality.png');
                                                background-size: 130%;">
                    <h2 class="card-heading" style="color:#04c273;">
                        <!-- Creat a new -->

                    </h2>
                </div>

                <div class="card-form">


                    <?php
                      while($row_spec=mysqli_fetch_assoc($result_spec)):  ?>


                    &#9658;
                    <a href="#">
                        <?php echo '('.$row_spec['option_spec'].')&nbsp'.$row_spec['name_specility']; ?>
                    </a>&nbsp;
                    <img src="img/delete_sign.png " style="width:5%;display:inline;" type="button" name="delete"
                        id="<?php echo $row_spec['id_specility'];?>" onclick="delete_spec(this.id)">


                    <br><br>
                    <?php endwhile; ?>




                    <div class="input">
                        <input class="input-field" placeholder="speciality name" id="insert_spec">
                    </div>

                    <div class="input">
                        <select class="input-field" placeholder="Level" id="insert_opt">
                            <option value="l1">L1</option>
                            <option value="l2">L2</option>
                            <option value="l3">L3</option>
                            <option value="m1">M1</option>
                            <option value="m2">M2</option>
                        </select>
                    </div>



                    <div class="action">
                        <input type="button" class="action-button" value="ADD" id="<?php echo $id_depart?>"
                            onclick="insert_spec(this.id)">
                    </div>
                </div>

            </div>




            <!-------------------------------- hta le hna  --------------------------------------------->






    </div>
    </main>

    </div>
    <script src="js/select.js"></script>
    <script src="js/stat.js"></script>
    <script src="js/js_notification.js"></script>


</body>

</html>