<?php               
$host  = 'localhost';
$user  = 'root';
$password   = "";
 $database  = "exam_system"; 
                   
                        
 $conn = new mysqli($host, $user, $password, $database);

$sql_faculty=" SELECT * FROM faculty ";
$result=mysqli_query($conn,$sql_faculty);



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="js/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="js/sign.js"></script>
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="sign_up.php" method="POST" class="sign-in-form">
                    <h2 class="title">Sign As teacher</h2>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="family name" name="first_name2" id="first_name2" required />
                    </div>

                   

                    <div class="input-field">
                        <i class=""></i>
                        <input type="text" placeholder="adress" name="adress2" id="adress2" required />
                    </div>

                    <div class="input-field">
                        <i class=""></i>
                        <input type="tel" placeholder="mobile" name="mobile2" id="mobile2" />
                    </div>

                    <select class="input-field" name="faculty" id="faculty2" onchange="get_fact_2(this.value)">
                        <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; faculty</option>
                        <?php while($row_faculty=mysqli_fetch_assoc($result)):

                           echo '<option value="'.$row_faculty['name_faculty'].'">'.$row_faculty['name_faculty'].'</option>';

                          endwhile; ?>
                    </select>


                    <select class="input-field" name="departement" id="dep_2" onchange="get_depart_2(this.value)"
                        required>
                        <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Departement</option>

                    </select>


                    <select class="input-field" name="spec_1" id="spec_1_1" onchange="get_spec_2(this.value)" required>
                        <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1st Specility</option>

                    </select>

                    <select class="input-field" name="spec_2" id="spec_2_2">
                        <option value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2nd Specility "optional"</option>

                    </select>



                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password2" id="password2" required />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="confirm_password2"
                            id="confirm_password2" required />
                    </div>

                    <button type="submit" id="submit2" class="btn ">Submit </button>

                    <p class="social-text">
                        <a href="login.php">already have account</a>
                    </p>
                     <!-- <div class="social-media">
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
            </div> -->
                </form>


                <!--------------------------------   Student sign -------------------------------->





                <form method="POST" action="signup-check.php" class="sign-up-form">

                    <h2 class="title">Sign as Student</h2>


                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="first_name" name="first_name1" id="first_name1" required />
                    </div>
                  

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="email" name="email1" id="email1" required />
                    </div>



                    <div class="input-field">
                        <i class=""></i>
                        <input type="tel" placeholder="mobile" name="mobile1" id="mobile1" required />
                    </div>


                  



     <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password1" id="password1" required />
                    </div>



                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="confirm_password1"
                            id="confirm_password1" required />
                    </div>



                    <button type="submit" id="submit" name="submit" class="btn ">Submit </button>


                    <p class="social-text"><a href="login.php">already have account</a></p>

                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>login policy ?</h3>
                    <p>
                        this page is made to sign up teachers , there are two specilities only
                        one is obligated , the two others are optianal .
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        AS a Student !
                    </button>
                </div>
                <img src="img/teacher.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>login pilicy ?</h3>
                    <p>
                        this page is made to sign up Students , there are three levels "specilities" only
                        one is obligated , the two others are optianal .
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        AS a teacher !
                    </button>
                </div>
                <img src="img/my_app.svg" class="image" alt="" />
            </div>
        </div>
    </div>




    <script src="js/app.js"></script>
</body>

</html>