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




    $id_user=$_SESSION['userid'];
    $sql_user="SELECT * FROM user WHERE user.id='$id_user'  ";
    $result=mysqli_query($conn, $sql_user);
    $row=mysqli_fetch_assoc($result);



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
    <!-- <script src="js/update.js"></script> -->
</head>

<body style="background-color:#e7eaf1;">

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span></span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <?php include('links.php')?>


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

            <center>
                <br><br>
                <img src="img/profile_setting.svg" style="width:40%; border-radius: 20px; margin-top:-4%;">
                <section class="contact" id="contact">
                    <div class="max-width">

                        <form>
                            <div class="contact-content">

                                <div class="column right">

                                    <div class="form">
                                        <div class="fields">
                                            <div class="field name">
                                                <input type="text" value="<?php echo $row['first_name'];?>" required>
                                            </div>

                                            <div class="field name">
                                                <input type="text" value="<?php echo $row['last_name'];?>" required>
                                            </div>

                                        </div>

                                        <div class="field name">
                                            <input type="text" value="<?php echo $row['email'];?>" required>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

            </center>




            <center>
                <section class="contact" id="contact">
                    <div class="max-width">

                        <form method="POST" action="update.php">
                            <div class="contact-content">

                                <div class="column right">

                                    <div class="form">

                                        <input type="hidden" name="iduser" id="iduser" value="<?php echo $row['id'];?>">
                                        <div class="field name">

                                            <input type="text" placeholder="new password" name="password" id="password"
                                                required>
                                        </div>
                                        <div class="field name">
                                            <input type="text" placeholder="confirm password" id="confirm_password"
                                                name="confirm_password" required>
                                        </div>
                                        <div class="field name">
                                            <input type="text" placeholder="old password" id="old_password"
                                                name="old_password" required>
                                        </div>


                                        <div class="button-area">
                                            <button type="submit" name="update" id="update">update</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </from>
                    </div>
                </section>
            </center>


    </div>
    </main>
    <script>
    //---------------------------------------------------------------------

    // $(document).ready(function() {
    //     $("form").submit(function(event) {
    //         var formData = {
    //             iduser: $("#iduser").val(),
    //             password: $("#password").val(),
    //             confirm_password: $("#confirm_password").val(),
    //             old_password: $("#old_password").val()
    //         };

    //         $.ajax({
    //             type: "POST",
    //             url: "update.php",
    //             data: formData,
    //             dataType: "json",
    //             encode: true,
    //             success: function(data) {
    //                 alert(data);
    //             },

    //             error: function(data) {
    //                 alert("error ocuured , profile page not working !");
    //             },
    //         });
    //         event.preventDefault();


    //     });
    // });
    </script>

    </div>
    <script src="js/select.js"></script>
    <script src="js/stat.js"></script>
    <script src="js/js_notification.js"></script>
</body>

</html>