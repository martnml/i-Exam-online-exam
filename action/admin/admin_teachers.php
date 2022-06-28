<?php
include "../login_header.php";

$id_user = $_SESSION['userid'];
$sql_count = "SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count = mysqli_query($conn, $sql_count);
$num_count = mysqli_num_rows($result_count);


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php  include('../../inc/header.php'); ?>
    <script src="../../js/general.js"></script>
    <script src="../../js/user.js"></script>
    <title>students</title>


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
                            <p style="font-size:17px;">students</p>
                        </span>
                    </a>
                </li>

                <li>
                    <a href="admin_teachers.php" class="active">
                        <span class="las la-user" style="font-size:17px;">Teachers</span>
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
                    <a href="admin_exams.php">
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
    <?php $_SESSION['page'] = 'teacher'; ?>
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
                <a href="../profile.php"><img src="img/setting.png" width="40px" height="40px" alt=""></a>
                <div>
                    <h4> <?php echo $_SESSION['name']; ?> </h4>
                    <small> <?php echo $_SESSION['role']; ?> </small>
                </div>
            </div>

            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="../../img/ring.png" alt="">
                <span id="msg_count"></span>

            </div>

            <div class="notifi-box" id="box">


            </div>
        </header>



        <main style="background:#e7ebf9;">
            <div class="cards">

                <div class="card-single">
                    <div>
                        <h1 id="exam"></h1>
                        <span>Total Exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
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
                        <h1 id="student"></h1>
                        <span>total students</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
            </div>
            <!--Tabla-->


            <br>
            <h4>
                Students List
            </h4>
            <br>

            <!-- <ul class="nav nav-tabs">	
		<li id="exam" class="active"><a href="admin_students.php">Exam</a></li>
		<li id="user"><a href="exam.php">Users</a></li>	
		
    </ul>			 -->

            <div>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="panel-title"></h3>
                        </div>
                        <!-- <div class="col-md-2" align="right">
                            <button type="button" name="add" id="addUser" class="btn btn-success btn-xs">Add new Student
                            </button>
                        </div> -->
                    </div>
                </div>
                <table id="userListing" class="table table-bordered table-striped">
                    <thead>
                        <tr style="background-color:#ff4546;">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>1st specility</th>
                            <th>2nd specility</th>
                            <th></th>
                            <th></th>
                            <th></th>


                        </tr>
                    </thead>
                </table>
            </div>

            <div id="userModal" class="modal fade">
                <div class="modal-dialog">
                    <form method="post" id="userForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="fa fa-plus"></i> Add new Student</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group" <label for="firstName" class="control-label">First Name*</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>
                                </div>

                                <div class="form-group" <label for="lastName" class="control-label">Last Name*</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="last name" required>
                                </div>

                                <div class="form-group" <label for="username" class="control-label">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>

                                <div class="form-group" <label for="mobile" class="control-label">Mobile*</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile" required>
                                </div>

                                <div class="form-group" <label for="address" class="control-label">Address*</label>
                                    <textarea class="form-control" id="address" name="address" placeholder="address" required></textarea>
                                </div>





                                <div class="form-group" <label for="username" class="control-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="userId" id="userId" />
                                <input type="hidden" name="action" id="action" value="" />
                                <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="userDetails" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Teachers Details</h4>
                        </div>
                        <div class="modal-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="background-color:#ff4546;">
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>adress</th>
                                        <th>created</th>

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
                                        <label class="col-md-4 text-right">Question Title <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="question_title" id="question_title" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 text-right">Option 1 <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="option_title_1" id="option_title_1" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 text-right">Option 2 <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="option_title_2" id="option_title_2" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 text-right">Option 3 <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="option_title_3" id="option_title_3" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 text-right">Option 4 <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="option_title_4" id="option_title_4" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-md-4 text-right">Answer <span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <select name="answer_option" id="answer_option" class="form-control">
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

     </div>
    </div>
  </main>
</div>
    <script src="../../js/stat.js"></script>
    <script src="../../js/js_notification.js"></script>
</body>
</html>