<?php 
if($_SESSION['role']=='teacher')
echo'
<li>
                    <a href="teachers_exam.php" >
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
                    <a href="#">
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
                    <a href="#" class="active">
                        <p style="font-size:17px;">Contact admin</p>
                    </a>
                </li>';

else if($_SESSION['role']=='student')  
  echo' <ul>
      <li>
          <a href="student_enroll_exam.php" >
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
          <a href="#">
              <p style="font-size:15px;">Passing Exam & check result</p>
          </a>
      </li>
      <br>
      <li>
         <a href="#" class="active">
                        <p style="font-size:17px;">Contact admin</p>
     </li>';      

else echo
'<li>
<a href="admin_students.php" ><span class="las la-users">
        <p style="font-size:17px;">students</p>
    </span>
</a>
</li>

<li>
<a href="admin_teachers.php">
    <span class="las la-user"></span>
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
</li>';


?>