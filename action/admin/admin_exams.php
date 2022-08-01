<?php

include "../login_header.php";
$id_user=$_SESSION['userid'];
$sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count=mysqli_query($conn, $sql_count);
$num_count= mysqli_num_rows($result_count);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "../../inc/header.php" ?>
<title>exams</title>
<script src="../../js/exam.js"></script>
</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>i-exam</span></h2>
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
                    <a href="../branches/branches_faculty.php">
                        </br>
                        <p style="font-size:17px;">branches</p>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="admin_exams.php" class="active">
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

                </label> I-<font style="color:#ff4546;">Exam</font>
            </h2>

            <!-- <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="SEARCH" />
            </div> -->
            <div class="user-wrapper">
                <a href="../profile.php"><img src="../../img/admin_avatar.svg" width="40px" height="40px" alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>

            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="../../img/ring.png" alt="">
                <?php  if($num_count != 0)  echo '<span>'. $num_msg .'</span>'; ?>

            </div>
            <div class="notifi-box" id="box">
                <h2>Notifications
                    <span>
                        <?php   echo $num_msg; ?>
                    </span>
                </h2>




                <?php
                      while($row_msg=mysqli_fetch_assoc($result_msg)):  ?>


                <div class="notifi-item" id="msg">
                    <img src="<?php echo $row_msg['img_src'];?>" alt="profile image" class="img">
                    <div class="text">

                        <h4>
                            <?php echo $row_msg['title']; ?>

                        </h4>
                        <p>
                            <?php echo $row_msg['content']; ?>
                            <a href=""></a>

                        </p>
                        <img src="img/delete_sign.png" style="width:30px; margin-left:80%;" type="button"
                            name="delete_notif" id="<?php echo $row_msg['id_msg']; ?>" onclick="delete_notif(this.id)">
                    </div>
                </div>
                <?php endwhile; ?>

            </div>
        </header>

        <main style="background:#e7ebf9;">
            <div class="cards">


                <div class="card-single">
                    <div>
                        <h1 id="student"></h1>
                        <span>total students</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>


                <div class="card-single">
                    <div>
                        <h1 id="teacher"></h1>
                        <span>totals teachers</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1 id="exam"></h1>
                        <span>Total Exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>


            </div>

            <!---------------------------Table------------------------------------------->



            <br>
            <h4>All exams list</h4>
            <br>


            <div>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="panel-title"></h3>
                        </div>
                        <!-- <div class="col-md-2" align="right">
                            <button type="button" id="addExam" class="btn btn-info" title="Add Exam">
                                <span class="glyphicon glyphicon-plus"></span></button>
                        </div> -->
                    </div>
                </div>
                <table id="examListing" class="table table-bordered table-striped">
                    <thead>
                        <tr style="background-color:#ff4546;">
                            <th>Id</th>
                            <th>Exam Title</th>
                            <td>Exam Domain</td>

                            <th>Duration (Minute)</th>
                            <td>Expiring date</td>
                            <th>Total Question</th>
                            <th>R/Q Mark</th>
                            <th>W/Q Mark</th>
                            <th>Status</th>
                            <!-- <th>Update</th> -->
                            <th>Delete</th>


                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td>Exam Title</td>
                            <td>Duration (Minute)</td>
                            <td>Total Question</td>
                            <td>R/Q Mark</td>
                            <td>W/Q Mark</td>
                            <td>Status</td>

                            <!-- '.$exam["id"].'
                            exam_id='.$exam["id"].' -->
                            <td> <button type="button" name="delete" id="" class="btn btn-danger btn-xs delete">
                                    <span class="glyphicon glyphicon-remove" title="Delete"></span></button>
                            </td>

                            <td> <a type="button" name="update" href="teachers_enroll.php?"
                                    class="btn btn-primary btn-xs enroll"><span class="glyphicon glyphicon-user"
                                        title="Enroll Users"></span></a></td>
                        </tr>
                    </tbody>
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
                                <div class="form-group" <label for="project" class="control-label">Examm Title</label>
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
                                    Epiring DateTime</label>
                                    <input type="datetime-local" class="form-control" id="endtime" name="endtime"
                                        placeholder=" Select Date Time" required>
                                </div>






                                <div class="form-group" <label for="project" class="control-label">Duration</label>
                                    <select name="exam_duration" id="exam_duration" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">1 Minute</option>
                                        <option value="2">2 Minute</option>
                                        <option value="3">3 Minute</option>
                                        <option value="4">4 Minute</option>
                                        <option value="5">5 Minute</option>
                                        <option value="30">30 Minute</option>
                                        <option value="60">1 Hour</option>
                                        <option value="120">2 Hour</option>
                                        <option value="180">3 Hour</option>
                                    </select>
                                </div>

                                <div class="form-group" <label for="project" class="control-label">Total
                                    Question</label>
                                    <select name="total_question" id="total_question" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">1 Question</option>
                                        <option value="2">2 Question</option>
                                        <option value="3">3 Question</option>
                                        <option value="4">4 Question</option>
                                        <option value="5">5 Question</option>
                                        <option value="10">10 Question</option>
                                        <option value="25">25 Question</option>
                                        <option value="50">50 Question</option>
                                        <option value="100">100 Question</option>
                                        <option value="200">200 Question</option>
                                        <option value="300">300 Question</option>
                                    </select>
                                </div>

                                <div class="form-group" <label for="project" class="control-label">Marks For Right
                                    Answer</label>
                                    <select name="marks_right_answer" id="marks_right_answer" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">+1 Mark</option>
                                        <option value="2">+2 Mark</option>
                                        <option value="3">+3 Mark</option>
                                        <option value="4">+4 Mark</option>
                                        <option value="5">+5 Mark</option>
                                    </select>
                                </div>

                                <div class="form-group" <label for="project" class="control-label">Marks For Wrong
                                    Answer</label>
                                    <select name="marks_wrong_answer" id="marks_wrong_answer" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">-1 Mark</option>
                                        <option value="1.25">-1.25 Mark</option>
                                        <option value="1.50">-1.50 Mark</option>
                                        <option value="2">-2 Mark</option>
                                    </select>
                                </div>

                                <div class="form-group" <label for="status" class="control-label">Status</label>
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




    </div>
    </main>

    </div>

    <script>
    $(document).ready(function() {
        var teacher_specility = "";
        $.post("../../../fact.php", {
                teacher_specility: teacher_specility
            },
            function(data) {
                $("#id_specility").html(data);

            });
    })
    </script>

    <script src="../../js/select.js"></script>
    <script src="../../js/js_notification.js"></script>
</body>

</html>