<?php
include_once '../../login_header.php';

$id_user=$_SESSION['userid'];
$sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count=mysqli_query($conn, $sql_count);
$num_count= mysqli_num_rows($result_count);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../../inc/header.php');?>
    <title>teachers</title>
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
                    <a href="teachers_exam.php">
                        </br>
                        <p style="font-size:17px;">exams</p>
                    </a>
                </li>

                <li>
                    <a href="#">
                        </br>
                        <p style="font-size:15px;margin-left:25px;">exam questions</p>
                    </a>

                </li>
                <li>
                    <a href="#" class="active">
                        </br>
                        <p style="font-size:15px;margin-left:25px;">students results</p>
                    </a>

                </li>

                <li>
                    <a href="#">
                        </br>
                        <p style="font-size:15px;margin-left:40px;">his\her result</p>
                    </a>

                </li>

                <li>
                    <a href="contact.php?id_user=9">
                        </br>
                        <p style="font-size:17px;">contact admin</p>
                    </a>
                </li>
                <li>
                    <a href="../../logout.php" onclick="return confirm('Are You sure you want to logout ?');">
                        </br>
                        <p style="font-size:15px;">logout</p>
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








        <main style="background:#e7ebf9;">
            <div class="cards">

                <!-- 
                <div class="card-single">
                    <div>
                        <h1></h1>
                        <span>your total students</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1></h1>
                        <span>present student</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1></h1>
                        <span>absent student</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1></h1>
                        <span> your total exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div> -->

            </div>
            <!--Tabla-->

            <div class="projects">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color:#03bd8e;"><?php echo $row_specility['name_specility'];  ?> Exam</h3>
                        <!-- 
                            <button>show all <span class="las la-arrow-right">
                            </span></button> -->
                    </div>


                    <br>
                    <h4>Students who passed</h4>
                    <br>
                    <div>

                        <table id="examEnrollListing" data-exam-id="<?php echo $_GET['exam_id']; ?>"
                            class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color:#ff4546;">
                                    <th>Id</th>
                                    <th>first Name</th>
                                    <th>last Name</th>
                                    <th>Email</th>

                                    <th>Mobile</th>
                                    <th>Result</th>
                                    <th></th>
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
                                                <th>full Name</th>
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

                    <?php include('inc/footer.php'); ?>




        </main>

    </div>
    <script src="js/stat.js"></script>
    <script src="js/js_notification.js"></script>
</body>

</html>