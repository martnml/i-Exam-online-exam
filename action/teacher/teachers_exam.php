<?php
include_once '../login_header.php';

$id_user=$_SESSION['userid'];
$sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count=mysqli_query($conn, $sql_count);
$num_count= mysqli_num_rows($result_count);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../../inc/header.php'); ?>
    <title>teachers</title>
    <script src="../../js/exam.js"></script>

</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <img src="img/logout.jpeg" style="width:30px; border-radius:18px">
    <div class="sidebar" style="width:14%;">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>I-Exam</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="teachers_exam.php" class="active">
                        </br>
                        <p style="font-size:17px;">exams</p>
                    </a>
                </li>


                <li>
                    <a href="#">
                        </br>
                        <p style="font-size:17px;margin-left:25px;">
                            exam questions</p>
                    </a>

                </li>
                <li>
                    <a href="#">
                        </br>
                        <p style="font-size:17px;margin-left:25px;">students results</p>
                    </a>

                </li>

                <li>
                    <a href="#">
                        </br>
                        <p style="font-size:17px;margin-left:40px;">his\her result</p>
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
                        <p style="font-size:16px;">logout</p>
                    </a>

                </li>

            </ul>
        </div>
    </div>

    <div class="main-content" style="margin-left:14%;">
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


                <!-- <div class="card-single">
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

            <div class="card">
                <div class="card-header">
                    <h3>MY Created Exams</h3>
                    <!-- 
                            <button>show all <span class="las la-arrow-right">
                            </span></button> -->
                </div>


                <div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="col-md-2" align="right">
                                <button type="button" id="addExam" class="btn btn-info" title="Add Exam"><span
                                        class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                    <table id="examListing" class="table table-bordered table-striped">
                        <thead>
                            <tr style="background-color:#ff4546;">
                                <th>Id</th>
                                <th>Exam Title</th>
                                <th>Specility</th>
                                <th>Duration </th>
                                <th>Expiring Date</th>
                                <th>Total Qst</th>
                                <th>R/Q Mark</th>
                                <th>W/Q Mark</th>
                                <th>Status</th>


                                <th></th>
                                <th></th>
                                <th>edit</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div id="examModal" class="modal fade">
                    <div class="modal-dialog">
                        <form method="post" id="examForm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> Edit Exam</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group" <label for="project" class="control-label">Exam
                                        Title</label>
                                        <input type="text" class="form-control" id="exam_title" name="exam_title"
                                            placeholder="Exam title" required>
                                    </div>



                                    <div class="form-group" <label for="project" class="control-label">
                                        Specility
                                        </label>
                                        <select name="id_specility" id="id_specility" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>


                                    <div class="form-group" <label for="project" class="control-label">
                                        Duration</label>
                                        <select name="exam_duration" id="exam_duration" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">1 Minute</option>
                                            <option value="2">2 Minute</option>
                                            <option value="5">5 Minute</option>
                                            <option value="10">10 Minute</option>
                                            <option value="15">15 Minute</option>
                                            <option value="20">20 Minute</option>
                                            <option value="30">30 Minute</option>
                                            <option value="45">45 Minute</option>
                                            <option value="60">1 Hour</option>
                                            <option value="90">1 Hour 30 Min</option>
                                            <option value="120">2 Hour</option>

                                        </select>
                                    </div>



                                    </br>
                                    <div class="form-group" <label for="project" class="control-label">
                                        Epiring DateTime</label>
                                        <input type="datetime-local" class="form-control" id="endtime" name="endtime"
                                            placeholder=" Select Date Time" required>
                                    </div>

                                    <!-- <div class="form-group" <label for="project" class="control-label"> -->
                                    </label>
                                    <select style="opacity:0;" name="total_question" id="total_question"
                                        class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">1 Question</option>
                                        <option value="2">2 Question</option>
                                        <option value="3">3 Question</option>
                                        <option value="4">4 Question</option>
                                        <option value="5">5 Question</option>
                                        <option value="6">6 Question</option>
                                        <option value="7">7 Question</option>
                                        <option value="8">8 Question</option>
                                        <option value="9">9 Question</option>
                                        <option value="10">10 Question</option>
                                        <option value="15">15 Question</option>
                                        <option value="20">20 Question</option>
                                        <option value="25">25 Question</option>
                                        <option value="30">30 Question</option>
                                    </select>
                                    <!-- </div> -->

                                    <div class="form-group" <label for="project" class="control-label">
                                        Marks
                                        For Right Answer</label>
                                        <select name="marks_right_answer" id="marks_right_answer" class="form-control">
                                            <option value="">Select</option>
                                            <option value="0.25">+0.25 Mark</option>
                                            <option value="0.5">+0.5 Mark</option>
                                            <option value="1">+1 Mark</option>
                                            <option value="1.5">+1.5 Mark</option>
                                            <option value="2">+2 Mark</option>
                                            <option value="2">+2 Mark</option>
                                            <option value="3">+3 Mark</option>
                                            <option value="4">+4 Mark</option>
                                            <option value="5">+5 Mark</option>
                                        </select>
                                    </div>

                                    <div class="form-group" <label for="project" class="control-label">
                                        Marks
                                        For Wrong Answer</label>
                                        <select name="marks_wrong_answer" id="marks_wrong_answer" class="form-control">
                                            <option value="">Select</option>
                                            <option value="0.25">-0.25 Mark</option>
                                            <option value="0.5">-0.5 Mark</option>
                                            <option value="1">-1 Mark</option>
                                            <option value="1.25">-1.25 Mark</option>
                                            <option value="1.50">-1.50 Mark</option>
                                            <option value="2">-2 Mark</option>
                                        </select>
                                    </div>

                                    <div class="form-group" <label for="status" class="control-label">
                                        Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Created">Created</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Started">Started</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" id="id" />
                                    <input type="hidden" name="action" id="action" value="" />
                                    <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- <div class="customers"> -->


        </main>

        <script src="js/stat.js"></script>
        <script src="js/js_notification.js"></script>


        <script>
        $(document).ready(function() {
            var teacher_specility = "";
            $.post("../../fact.php", {
                    teacher_specility: teacher_specility
                },
                function(data) {
                    $("#id_specility").html(data);

                });
        })
        </script>
</body>

</html>