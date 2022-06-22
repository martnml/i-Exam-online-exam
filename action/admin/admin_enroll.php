<?php include "../login_header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
 <?php include('../../inc/header.php'); ?>
 <script src="../../js/enroll.js"></script>
 <script src="../../js/general.js"></script>


</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <img src="img/logout.jpeg" style="width:30px; border-radius:18px">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>I-exam</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="admin_students.php"><span class="las la-users">
                            </br>
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
                    <a href="branches_faculty.php">
                        </br>
                        <p style="font-size:17px;">branches</p>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="active">
                        </br>
                        <p style="font-size:15px;">exams</p>
                    </a>
                </li>


                <li>
                    <a href="../../logout.php" onclick="return confirm('Are You sure you want to logout ?');">
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

                </label> I-<font style="color:#2ecc71">Exam</font>
            </h2>

            <!-- <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="SEARCH" />
            </div> -->
            <div class="user-wrapper">
                <a href="profile.php"><img src="img/setting.png" width="40px" height="40px" alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>


            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="img/bell.png" alt="">
                <span> 0
                    <!-- number of notifications -->
                </span>

            </div>
            <div class="notifi-box" id="box">
                <h2>Notifications
                    <span> 0
                        <!-- number of notifications -->
                    </span>
                </h2>

                <div class="notifi-item" id="msg">
                    <img src="" alt="profile image" class="img">
                    <div class="text">

                        <h4>
                            <!-- username sender -->
                        </h4>
                        <p>
                            <!-- notif text -->
                            <a href="" onclick="return confirm('Are You sure you want to delete this notification ?');">
                                <img src="img/delete.png" style="width:20px; margin-right:5%;margin-top:95%"></a>
                        </p>
                    </div>
                </div>

            </div>







        </header>

        <main>
            <div class="cards">


                <div class="card-single">
                    <div>
                        <h1>25</h1>
                        <span>your total students</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1>12</h1>
                        <span>present student</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1>12</h1>
                        <span>absent student</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1>5</h1>
                        <span> your total exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>

            </div>
            <!--Tabla-->

            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h3>"specility" Exam</h3>
                        <!-- 
                            <button>show all <span class="las la-arrow-right">
                            </span></button> -->
                    </div>


                    <br>
                    <h4>Student who passed it :</h4>
                    <br>
                    <div>

                        <table id="examEnrollListing" data-exam-id="<?php echo $_GET['exam_id']; ?>"
                            class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color:#0dd19f;">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>

                                    <th>Mobile</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div id="userDetails" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> User Details</h4>
                                </div>
                                <div class="modal-body">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>

                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Created</th>
                                            </tr>
                                        </thead>
                                        <tbody id="userList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="questionsModal" class="modal fade">
                        <div class="modal-dialog">
                            <form method="post" id="questionsForm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-plus"></i> Edit questions</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Question Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="question_title" id="question_title"
                                                        autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Option 1 <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="option_title_1" id="option_title_1"
                                                        autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Option 2 <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="option_title_2" id="option_title_2"
                                                        autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Option 3 <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="option_title_3" id="option_title_3"
                                                        autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Option 4 <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" name="option_title_4" id="option_title_4"
                                                        autocomplete="off" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-md-4 text-right">Answer <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-md-8">
                                                    <select name="answer_option" id="answer_option"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="1">1 Option</option>
                                                        <option value="2">2 Option</option>
                                                        <option value="3">3 Option</option>
                                                        <option value="4">4 Option</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" id="id" />
                                        <input type="hidden" name="exam_id" id="exam_id" />
                                        <input type="hidden" name="action" id="action" value="" />
                                        <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php include('../../inc/footer.php'); ?>




        </main>

    </div>
    <script src="../../js/js_notification.js"></script>
</body>

</html>