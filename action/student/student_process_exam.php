<?php
include_once '../../config/Database.php';
include_once '../class/User.php';
include_once '../../class/Exam.php';
include_once '../../fact.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if (!$user->loggedIn()) {
    header("Location: login.php");
}


$id_exam=$_GET['exam_id'];
$sql1 = "SELECT * FROM  exams WHERE exams.id='$id_exam' ";
$result1 = mysqli_query($db, $sql1);
$row=mysqli_fetch_assoc($result1);
$exam_name = $row['exam_title'];



$exam = new Exam($db);
if (!empty($_GET['exam_id'])) {
    $exam->exam_id = $_GET['exam_id'];

    $examDetails = $exam->getExamInfo();
}

$exam->examProcessUpdate();
$examProcessDetails = $exam->getExamProcessDetails();

$remainingMinutes = '';
$examDateTime = $examProcessDetails['start_time'];
$duration = $examDetails['duration'] . ' minute';
$examEndTime = strtotime($examDateTime . '+' . $duration);
$examEndTime = date('Y-m-d H:i:s', $examEndTime);
$remainingMinutes = strtotime($examEndTime) - time();
$currentTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));



$id_user=$_SESSION['userid'];
$sql_count="SELECT * FROM message  WHERE (message.reciever_id='$id_user' AND message.vue='0' )";
$result_count=mysqli_query($conn, $sql_count);
$num_count= mysqli_num_rows($result_count);

$_SESSION['the_user']=$_SESSION['userid'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../../inc/header.php');?>
    <script src="../../js/TimeCircles.js"></script>
    <script src="../../js/user_exam.js"></script>
  

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
                    <a href="student_enroll_exam.php">
                        <p style="font-size:17px;">Exams</p>

                    </a>
                </li>
                <br>
                <li>
                    <a href="student_view_exam.php">
                        <p style="font-size:17px;">Check Exams</p>
                    </a>
                </li>
                <br>

                <li>
                    <a href="#" class="active">
                        <p style="font-size:17px;">Passing Exam & check result</p>
                    </a>
                </li>
                <br>
                <li>
                    <a href="contact.php?id_user=9">

                        <p style="font-size:17px;">contact admin</p>
                    </a>
                </li>
                <br>
                <li>
                    <a href="logout.php">
                        <p style="font-size:17px;">Logout</p>
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

        <main>

            <!--Tabla-->

            <br>
            <div id="processExamId" data-exam_id="<?php echo $examDetails['id']; ?>">
                <?php
                if ($currentTime < $examEndTime) {
                ?>




                <div class="col-md-4">
                    <br />
                    <div align="center">
                        <div id="examTimer" data-timer="<?php echo $remainingMinutes; ?>"
                            style="max-width:400px; width: 100%; height: 200px;"></div>
                    </div>
                    <br />
                    <div id="user_details_area"></div>
                </div>



                <div class="col-md-8" style="width:80%;color:grey;">
                    <div class="card" style=" background-color:#f1f5f9;">
                        <div class="card-body">
                            <div id="single_question_area"></div>
                        </div>
                    </div>
                    <br />
                    <div id="question_navigation_area"></div>
                </div>

                <?php } ?>

                <?php
                if ($currentTime >= $examEndTime) {
                    $examResult =  $exam->getExamResults();
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8"><b><?php echo $exam_name;?></b> &nbsp;result:</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tr style="background-color:#0dd19f;">
                                    <th>Question</th>
                                    <th>Option 1</th>
                                    <th>Option 2</th>
                                    <th>Option 3</th>
                                    <th>Option 4</th>
                                    <th>Your Answer</th>
                                    <th>Answer</th>
                                    <th>Result</th>
                                    <th>Marks</th>
                                </tr>
                                <?php
                                    foreach ($examResult as $results) {
                                        $examResults  = $exam->getQuestopnOptions($results["question_id"]);
                                        $userAnswer = '';
                                        $orignalAnswer = '';
                                        $questionResult = '';
                                        if ($results['marks'] == '0') {
                                            $questionResult = '<h4 class="badge badge-dark">Not Attend</h4>';
                                        }
                                        if ($results['marks'] > '0') {
                                            $questionResult = '<h4 class="badge badge-success">Right</h4>';
                                        }
                                        if ($results['marks'] < '0') {
                                            $questionResult = '<h4 class="badge badge-danger">Wrong</h4>';
                                        }
                                        echo '
						<tr>
							<td>' . $results['question'] . '</td>';

                                        foreach ($examResults as $questionOption) {
                                            echo '<td>' . $questionOption["title"] . '</td>';
                                            if ($questionOption["option"] == $results['user_answer_option']) {
                                                $userAnswer = $questionOption['title'];
                                            }
                                            if ($questionOption['option'] == $results['answer']) {
                                                $orignalAnswer = $questionOption['title'];
                                            }
                                        }
                                        echo '
						<td>' . $userAnswer . '</td>
						<td>' . $orignalAnswer . '</td>
						<td>' . $questionResult . '</td>
						<td>' . $results["marks"] . '</td>
					</tr>';
                                    }
                                    $marksResult = $exam->getExamTotalMarks();
                                    
                                    ?>
                                <tr>
                                    <td colspan="8" align="right">Total Marks</td>
                                    <td align="right"><?php echo $marksResult; ?></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>




        </main>

        <script src="js/stat.js"></script>
        <script src="js/js_notification.js"></script>
</body>

</html>