<?php
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../class/Exam.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if (!$user->loggedIn()) {
    header("Location: login.php");
}

$exam = new Exam($db);
if (!empty($_GET['exam_id'])) {
    $exam->exam_id = $_GET['exam_id'];
}


include('../../fact.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../../inc/header.php');?>

    <title>iExam</title>

    <link rel="stylesheet" href="css/TimeCircles.css" />
    <script src="../../js/TimeCircles.js"></script>
    <script src="../../js/user_exam.js"></script>
  

</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <img src="img/logout.jpeg" style="width:30px; border-radius:18px">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>I-Exam</span></h2>
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
                    <a href="#" class="active">
                        </br>
                        <p style="font-size:15px;margin-left:40px;">
                            <?php echo $row_user['first_name'].'&nbsp;'.$row_user['last_name'];?>&nbsp; Result</p>
                    </a>

                </li>

                <li>
                    <a href="teacher_contact.php?id_user=9">
                        </br>
                        <p style="font-size:17px;">contact admin</p>
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
                <a href="../profile.php"><img src="<?php echo $_SESSION['img']; ?>" width="40px" height="40px" alt=""></a>
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


                <!-- <div class="card-single">
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
                </div> -->


            </div>
            <!--Tabla-->


            <div class="card">
                <div class="card-header">

                    <!-- 
                            <button>show all <span class="las la-arrow-right">
                            </span></button> -->
                </div>


                <br>
                <?php
                $examResult =  $exam->getExamResults();
                ?>
                <div class="card">
                    <div class="card-header">

                        <h3 style="color:#03bd8e;">
                            <?php echo $row_user['first_name'].'&nbsp;'.$row_user['last_name'];?> </h3>

                    </div>





                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr style="background-color:#ff4546;">
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
                                <td align="right"><?php echo $marksResult ?></td>
                            </tr>
                            <?php
                                
                                ?>
                        </table>
                    </div>
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