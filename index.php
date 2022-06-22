<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exam system</title>
    <link rel="stylesheet" href="css/style.css">

    <!-- get links  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

</head>

<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar" style="background-color:rgb(50, 51, 53); opacity:80%;">
        <div class="max-width">
            <div class="logo"><a href="#">i-<span>exam</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="login.php" class="menu-btn">login</a></li>
                <li><a href="sign.php" class="menu-btn">Sign up</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Welcome to</div>
                <div class="text-2">i- <font style="color:#03bd8e;">Exam </font>
                </div>
                <div class="text-3">where there is <span class="typing"></span></div>
                <a href="login.php">login now</a>
            </div>
        </div>
    </section>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About Us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="img/univ.jpeg" alt="">
                </div>
                <div class="column right">
                    <div class="text">Univ Istamboli <span class="typing-2"></span></div>
                    <p>made for university of Istamboli Mascara
                        <br><br><b>my phone number:</b>+213557662824
                        <br><b>my personal email:</b>zergaouimedamine@gamil.com
                    </p>
                    <a href="mailto:fortamine5@gmail.com">more details</a>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <?php include "footer.php" ?>

    <script src="js/script.js"></script>
</body>

</html>