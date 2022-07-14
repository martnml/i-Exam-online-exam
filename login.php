<?php
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);





if ($user->loggedIn()) {
  if (!empty($_SESSION["role"]) && $_SESSION["role"] == 'teacher') {
    header("Location: action/teacher/teachers_exam.php");
  } else if (!empty($_SESSION["role"]) && $_SESSION["role"] == 'admin') {
    header("Location: action/admin/admin_students.php");
  } else if (!empty($_SESSION["role"]) && $_SESSION["role"] == 'student') {
    header("Location: action/student/student_view_exam.php");
  }
}






$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["loginType"]) && $_POST["loginType"]) {
  $user->email = $_POST["email"];
  $user->password = $_POST["password"];
  $user->loginType = $_POST["loginType"];

  if ($user->login()) {
    if ($_SESSION["role"] == 'teacher') {
      header("Location: action/teacher/teachers_exam.php");
    } else if ($_SESSION["role"] == 'student') {
      header("Location: action/student/student_view_exam.php");
    } else if ($_SESSION["role"] == 'admin') {
      header("Location: action/admin/admin_students.php");
    }
  } else {
    $loginMessage = 'Invalid login! Please try again.';
  }
} else if (empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["loginType"])) {
  $loginMessage = 'Enter one of emails :<br>&nbsp; admin@yahoo.com 
  <br>&nbsp;   teacher@yahoo.com
  <br>&nbsp;   student@yahoo.com 
  <br>Password :&nbsp;&nbsp;123';
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/tag.css" />
    <title>Login</title>
</head>

<body>


    <div class="container sign-up-mode">

    <nav class="navbar" style="background-color:rgb(50, 51, 53); opacity:80%;">
        <div class="max-width">
            <div class="logo"><a href="#">i-<span>exam</span></a></div>
            <ul class="menu">
                <li><a href="index.php" class="menu-btn">Home</a></li>
                <li><a href="index.php#about" class="menu-btn">About</a></li>
                <li><a href="login.php" class="menu-btn">login</a></li>
                <li><a href="sign.php" class="menu-btn">Sign up</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>


        <div class="forms-container">
            <div class="signin-signup">



                <form action="" method="POST" class="sign-up-form" style="justify-content: center;">


                    <?php if ($loginMessage != '') { ?>
                    <b id="login-alert" class="alert_msg"><?php echo $loginMessage; ?></b>
                    <?php } ?>

                    <h2 class="title">Login</h2>

                    <div class="input-field">
                        <i class=""></i>
                        <input type="email" name="email" placeholder="email" value="<?php if (!empty($_POST["email"])) {
                                                                          echo $_POST["email"];
                                                                        } ?>" required />
                    </div>

                    <div class="input-field">
                        <i class=""></i>
                        <input type="password" id="password" name="password" value="<?php if (!empty($_POST["password"])) {
                                                                          echo $_POST["password"];
                                                                        } ?>" placeholder="password" required />
                    </div>
                    <br>
                    <label class="radio-inline">
                        <input type="radio" name="loginType" value="admin">admin
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="loginType" value="teacher">teacher
                    </label>


                    <label class="radio-inline">
                        <input type="radio" name="loginType" value="student">Student
                    </label>




                    <input type="submit" name="login" class="btn" value="LOGIN" />


                    <p class="social-text"><a href="sign.php">create new account</a></p>
                </form>

               


                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        this page is made to sign up teachers , there are two departement only
                        one is obligated , the two others are optianal
                    </p>

                </div>
                <img src="img/safe.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us </h3>
                    <p>
                        this page is made to sign up Students , there are three levels only
                        one is obligated , the two others are optianal
                    </p>

                </div>
                <img src="img/safe.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>

    
</body>

</html>