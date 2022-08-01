<?php
class Exam {	
   
	private $examTable = 'exams';
	private $enrollTable = 'exam_enroll';
	private $userTable = 'user';
	private $questionTable = 'exam_question';
	private $questionAnswerTable = 'exam_question_answer';
	private $optionTable = 'exam_option';
	private $processTable = 'exam_process';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listExam(){			
		
		
		if($_SESSION['role']=='admin')
		{
			$sqlQuery = "
			SELECT id, exam_title, duration, endtime, id_specility, total_question, marks_per_right_answer, marks_per_wrong_answer, status
			FROM ".$this->examTable." ";
		}
           else {$sqlQuery = "
			SELECT id, exam_title, duration, endtime, id_specility, total_question, marks_per_right_answer, marks_per_wrong_answer, status
			FROM ".$this->examTable." 
			WHERE user_id = '".$_SESSION["userid"]."' ";
		}


		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' AND (name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
			
			$sqlQuery .= ' OR mobile LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR address LIKE "%'.$_POST["search"]["value"].'%" ';				
			$sqlQuery .= ' OR age LIKE "%'.$_POST["search"]["value"].'%") ';							
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id ASC  ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->examTable." WHERE id = '".$_SESSION["userid"]."'");
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	

	

		while ($exam = $result->fetch_assoc()) { 				
			$rows = array();			
			
			
			$rows[] = $exam['id'];
			$rows[] = $exam['exam_title'];
			
			$id=$exam['id_specility'];
		    $sqlSpec="SELECT * FROM specility WHERE specility.id_specility='$id' ";	

	        $result_spec =mysqli_query($this->conn,$sqlSpec);
            $spec = mysqli_fetch_assoc($result_spec);

            $rows[] = '('.$spec['option_spec'].')&nbsp;'.$spec['name_specility'];
			
		    $exam_duration = $exam["duration"].'&nbsp;Minutes';

		    if($exam["duration"]>=60) 
			{
					   $exam_hours=$exam["duration"];
					   $exam_duration=(int)($exam_hours/60) .'&nbsp; Hours &nbsp;'.$exam["duration"]%60 .'&nbsp; Minutes';}
			
		    $rows[] = $exam_duration;
			$rows[] = $exam['endtime'];
			$rows[] = $exam['total_question'];
			$rows[] = $exam['marks_per_right_answer'];	
			$rows[] = $exam['marks_per_wrong_answer'];			
			$rows[] = $exam['status'];


			
			if($_SESSION['role']=='admin'){ 
            //    $rows[] = '<button type="button" name="update" id="'.$exam["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';			
			   $rows[] = '<button type="button" name="delete" id="'.$exam["id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';		
			} 
			
			else {
			$rows[] = '<a type="button" name="view" href="teachers_questions.php?exam_id='.$exam["id"].'" class="btn btn-info btn-xs add_question"><span class="glyphicon" title="Add Question">Questions</span></a>';				
		    $rows[] = '<a type="button" name="update" href="teachers_enroll.php?exam_id='.$exam["id"].'" class="btn btn-primary btn-xs enroll"><span class="glyphicon glyphicon-user" title="Enroll Users"></span></a>';		
			$rows[] = '<button type="button" name="update" id="'.$exam["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';			
			$rows[] = '<button type="button" name="delete" id="'.$exam["id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';		

		
		
		}
		   

			
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	








	
	public function getExam(){
		if($this->id) {
			$sqlQuery = "
				SELECT id, exam_title,id_specility, duration, endtime, total_question, marks_per_right_answer, marks_per_wrong_answer, status 
				FROM ".$this->examTable." 
				WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
	

	

	public function insert(){
		
		if($this->exam_title) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->examTable."(`user_id`, `exam_title`, `endtime`, `id_specility`, `duration` , `total_question`, `marks_per_right_answer`,`marks_per_wrong_answer`,`status`)
			VALUES(?,?,?,?,?,?,?,?,?)");
		
			$this->exam_title = htmlspecialchars(strip_tags($this->exam_title));
			// $this->endtime = htmlspecialchars(strip_tags($this->endtime));			
			$this->duration = htmlspecialchars(strip_tags($this->duration));
			$this->total_question = '0';
			$this->marks_per_right_answer = htmlspecialchars(strip_tags($this->marks_per_right_answer));
			$this->marks_per_wrong_answer = htmlspecialchars(strip_tags($this->marks_per_wrong_answer));
			$this->status = htmlspecialchars(strip_tags($this->status));			
			$specility=htmlspecialchars(strip_tags($this->id_specility));

			$stmt->bind_param("issisisss", $_SESSION["userid"], $this->exam_title, $this->endtime, $specility, $this->duration,  $this->total_question, $this->marks_per_right_answer, $this->marks_per_wrong_answer, $this->status);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	







	public function update(){
		
		if($this->id && $_SESSION["userid"]) {	

			$specility=$this->id_specility;
			$stmt = $this->conn->prepare("
			UPDATE ".$this->examTable." 
			SET exam_title= ?, endtime = ?, id_specility = '$specility', duration = ?, total_question = ?, marks_per_right_answer = ?, marks_per_wrong_answer = ?, status = ?
			WHERE id = ? AND user_id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->exam_title = htmlspecialchars(strip_tags($this->exam_title));	
			$this->endtime = htmlspecialchars(strip_tags($this->endtime));		
			$this->duration = htmlspecialchars(strip_tags($this->duration));
			$this->total_question = htmlspecialchars(strip_tags($this->total_question));
			$this->marks_per_right_answer = htmlspecialchars(strip_tags($this->marks_per_right_answer));
			$this->marks_per_wrong_answer = htmlspecialchars(strip_tags($this->marks_per_wrong_answer));
			$this->status = htmlspecialchars(strip_tags($this->status));
			// $this->id_specility = htmlspecialchars(strip_tags($this->id_specility));			
			
			$stmt->bind_param("sssisssii", $this->exam_title, $this->endtime, $this->duration, $this->total_question, $this->marks_per_right_answer, $this->marks_per_wrong_answer, $this->status, $this->id, $_SESSION["userid"]);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}	
	







	public function delete(){

		$exam_id=$this->id;

		$sql = "UPDATE exams SET total_question=total_question-1;
		WHERE id='$exam_id' ";
		$result = mysqli_query($this->conn,$sql);

    if($_SESSION['role']=='admin')
		{


            $stmt = $this->conn->prepare("
				DELETE FROM ".$this->examTable." 
				WHERE id = ? ");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
  

		}

		if($this->id && $_SESSION["userid"]) {	
			
			
           

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->examTable." 
				WHERE id = ? AND user_id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("ii", $this->id, $_SESSION["userid"]);

			if($stmt->execute()){
				return true;
			}



		}




	



	}
	






	public function getExamEnroll(){			
		$sqlQuery = "
			SELECT enroll.id, exam.id AS exam_id, exam.duration,user.id AS theuserid, user.first_name, user.last_name, user.email, user.mobile, process.start_time
			FROM ".$this->enrollTable." AS enroll
			LEFT JOIN ".$this->examTable." AS exam ON enroll.exam_id = exam.id
			LEFT JOIN ".$this->userTable." AS user ON enroll.user_id = user.id
			LEFT JOIN ".$this->processTable." AS process ON enroll.user_id = process.userid
			WHERE exam.id = '".$this->exam_id."' ";
				
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY enroll.id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare($sqlQuery);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($enroll = $result->fetch_assoc()) { 				
			$rows = array();		

			$examDateTime = $enroll['start_time'];
			$duration = $enroll['duration'] . ' minute';
			$examEndTime = strtotime($examDateTime . '+' . $duration);
			$examEndTime = date('Y-m-d H:i:s', $examEndTime);
			$currentTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));
			$examMessage = '';
			if($examDateTime && $currentTime > $examEndTime) {				
				$examMessage = '<a  type="button" href="teachers_view_result.php?exam_id='.$enroll["exam_id"].'"  name="view" class="btn btn-info btn-xs"><span title="View Result">View Result</span></a>';
			} else if($examDateTime && $currentTime < $examEndTime) {				
				$examMessage = "In process";
			} else {				
				$examMessage = "Pending";
			}
			$_SESSION['the_user']=$enroll['theuserid'];
			$rows[] = $enroll['id']; 
			// $rows[] = ucfirst($enroll['first_name']." ".$enroll['last_name']);
			$rows[] = $enroll['first_name'];
			$rows[] = $enroll['last_name'];
			$rows[] = $enroll['email'];
			
			$rows[] = $enroll['mobile'];								
			$rows[] = $examMessage;	
			$rows[] = '<a href="../contact.php?id_user='.$enroll["theuserid"].'" type="button" class="btn btn-warning btn-xs update">contact</a>';		
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	






	public function getExamList(){
		$date =date("Y-m-d H:i:s");
		$id=$_SESSION['userid'];

        $sql1="SELECT * FROM student WHERE student.id='$id' "; 
		$sq = $this->conn->prepare($sql1);
		$sq->execute();
		$result = $sq->get_result();
        $row= mysqli_fetch_assoc($result);
		
        $id_spec1 =$row['id_spec1'];
        $id_spec2 =$row['id_spec2'];
        $id_spec3 =$row['id_spec3'];   



		$sqlQuery = "SELECT * FROM exams
		 WHERE( (exams.id_specility ='$id_spec1') 
		|| (exams.id_specility ='$id_spec2')   || (exams.id_specility ='$id_spec3') )
		   AND (exams.status !='pending') AND (exams.total_question!=0)
		    ";
			
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		$output = '';
		while ($exam = $result->fetch_assoc()) {
			$output .= '<option value="'.$exam["id"].'">'.$exam["exam_title"].'</option>';
		}
		return 	$output;	
	}
	





	public function getExamDetails() {
		if($this->exam_id) {
			$sqlQuery = "
				SELECT id, exam_title, endtime, duration, total_question, marks_per_right_answer, marks_per_wrong_answer, status
				FROM exams
				WHERE id = ?";
				
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();	
			$output = '
			<div class="card">
				<div class="card-header">Exam Details</div>
				<div class="card-body">
					<table class="table table-striped table-hover table-bordered">
			';



	
			while ($exam = $result->fetch_assoc()) {


			  $date = date("Y-m-d H:i:s");
			  $end= $exam['endtime'];
			       $style='';
			       if ($date > $end ){ $style='#fd7a51';}



				   $exam_duration = $exam["duration"].'&nbsp;Minutes';
				   
				   if($exam["duration"]>=60) {
					   $exam_hours=$exam["duration"];
					   $exam_duration=(int)($exam_hours/60) .'&nbsp; Hours &nbsp;'.$exam["duration"]%60 .'&nbsp; Minutes';}

				$output .= '
				<tr>
					<td><b>Exam Title</b></td>
					<td>'.$exam["exam_title"].'</td>
				</tr>				
				<tr>
					<td><b>Exam Duration</b></td>
					<td>'.$exam_duration.'</td>
				</tr>
				<tr>
					<td><b>Expiring Time</b></td>
					<td style="color:'.$style.'">'.$exam["endtime"].' </td>
				</tr>
				<tr>
					<td><b>Exam Total Questions</b></td>
					<td>'.$exam["total_question"].' </td>
				</tr>
				<tr>
					<td><b>Marks Per Right Answer</b></td>
					<td>'.$exam["marks_per_right_answer"].' Mark</td>
				</tr>
				<tr>
					<td><b>Marks Per Wrong Answer</b></td>
					<td>-'.$exam["marks_per_wrong_answer"].' Mark</td>
				</tr>';
			}
                  
		   $exam_id = $this->exam_id;

           $sqlQuery = " SELECT  endtime FROM exams WHERE id ='$exam_id' ";
		   $result=mysqli_query($this->conn, $sqlQuery);
           $exam=mysqli_fetch_assoc($result);
		   
			$date = date("Y-m-d H:i:s");
		    $end= $exam['endtime'];
			
			if ($date>$end){
				$enrollHtml = '
					<tr>
						<td colspan="2" align="center" style="color: #fd7a51;">
							<b>This exam is Expired ! </b>
						</td>
						
					</tr>';
			}

			else  if($this->isAlreadyEnrolled($this->exam_id)) {
				$enrollHtml = '
					<tr>
						<td colspan="2" align="center">
							<button type="button" name="enroll_button" class="btn btn-info">You Already Enrolled to this exam</button>
						</td>
					</tr>';
			} else {
				$enrollHtml = '
					<tr>
						<td colspan="2" align="center">
							<button type="button" name="enroll_button" id="enrollExam" class="btn btn-warning" data-exam_id="'.$this->exam_id.'">Enroll to this exam</button>
						</td>
					</tr>';
			}
			$output .= $enrollHtml;
			$output .= '</table>';
			echo $output;
		}		
	}
	








	public function isAlreadyEnrolled($exam_id) {
		if($_SESSION["userid"] && $exam_id) {
			$sqlQuery = "
				SELECT *
				FROM ".$this->enrollTable." 			
				WHERE user_id = ? AND exam_id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("ii", $_SESSION["userid"], $exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				return true;
			}
		}
		return false;
	}
	





	public function enrollToExam(){
		
		if($this->exam_id) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->enrollTable."(`user_id`, `exam_id`)
			VALUES(?,?)");
		
			$this->exam_id = htmlspecialchars(strip_tags($this->exam_id));
									
			$stmt->bind_param("ii", $_SESSION["userid"], $this->exam_id);

			$stmt->execute();
			
		}
	}






	public function listUserExam(){			
		$sqlQuery = "
			SELECT exam.id, exam.exam_title, exam.duration, exam.total_question, exam.marks_per_right_answer, exam.marks_per_wrong_answer, answer.marks, process.start_time
			FROM ".$this->examTable." AS exam
			LEFT JOIN ".$this->enrollTable." AS enroll ON exam.id = enroll.exam_id
			LEFT JOIN ".$this->questionAnswerTable." AS answer ON exam.id = answer.exam_id
			LEFT JOIN ".$this->processTable." AS process ON exam.id = process.examid
			WHERE enroll.user_id = '".$_SESSION["userid"]."' GROUP BY exam.id ";				
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY exam.id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->examTable." WHERE id = '".$_SESSION["userid"]."'");
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($exam = $result->fetch_assoc()) { 				
			$rows = array();
			$status = '';
			$examMessage = '';
			
			$examDateTime = $exam['start_time'];
			$duration = $exam['duration'] . ' minute';
			$examEndTime = strtotime($examDateTime . '+' . $duration);
			$examEndTime = date('Y-m-d H:i:s', $examEndTime);
			$currentTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));
			
			if($examDateTime && $currentTime > $examEndTime) {
				$status = 'Completed';
				$examMessage = "View Result";
			} else if($examDateTime && $currentTime < $examEndTime) {
				$status = 'Pending';
				$examMessage = "Finish Exam";
			} else {
				$status = 'Pending';
				$examMessage = "Start Exam";
			}
			
			$rows[] = $exam['id'];
			$rows[] = $exam['exam_title'];
			$rows[] = $exam['duration']. ' Minute';
			$rows[] = $exam['total_question'] . ' Question';
			$rows[] = $exam['marks_per_right_answer']. ' Mark';
			$rows[] = '-' .$exam['marks_per_wrong_answer']. ' Mark';	
			$rows[] = $status;			
			$rows[] = '<a type="button" name="view" href="student_process_exam.php?exam_id='.$exam["id"].'" class="btn btn-info btn-xs">'.$examMessage.'</a>';					
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	





	public function getExamInfo () {
		
		if($this->exam_id) {
			$sqlQuery = "
				SELECT id, exam_title, duration, total_question, marks_per_right_answer, marks_per_wrong_answer, status
				FROM ".$this->examTable."
				WHERE id = ?";
				
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			return $record;
		}
		
	}
	





	public function loadQuestions() {
		if($this->exam_id) {
			
			$whereSql = '';
			if($this->question_id) {
				$whereSql = "questions.id = '".$this->question_id."'";
			} elseif($this->exam_id) {
				$whereSql = "questions.exam_id = '".$this->exam_id."'";
			}
			
			$sqlQuery = "
				SELECT questions.id as question_id, questions.question, questions.answer
				FROM ".$this->questionTable." AS questions 
				WHERE $whereSql ORDER BY questions.id ASC LIMIT 1";			
			
			$stmtQuestion = $this->conn->prepare("
				SELECT * FROM ".$this->optionTable." 
				WHERE question_id = ?");
				
			$sqlQueryPrev = $this->conn->prepare("
				SELECT id
				FROM ".$this->questionTable." 
				WHERE id < ? AND exam_id = ? ORDER BY id DESC LIMIT 1");
			
			$sqlQueryNext = $this->conn->prepare("
				SELECT id
				FROM ".$this->questionTable." 
				WHERE id > ? AND exam_id = ? ORDER BY id ASC LIMIT 1");
						
			$stmt = $this->conn->prepare($sqlQuery);			
			$stmt->execute();
			$result = $stmt->get_result();				
			$output = '';
			while ($questions = $result->fetch_assoc()) {
				$output .= '
				<h2>'.$questions["question"].'</h2>
				<hr />
				<div class="row">';
				
				$stmtQuestion->bind_param("i", $questions["question_id"]);	
				$stmtQuestion->execute();
				$resultQuestion = $stmtQuestion->get_result();
				$count = 1;
				while ($options = $resultQuestion->fetch_assoc()) {
					
					$output .= '
					<div class="col-md-6" style="margin-bottom:32px;">
						<div class="radio">
							<label><h4><input type="radio" name="option_1" class="answer_option" data-question_id="'.$questions["question_id"].'" data-id="'.$count.'"/>&nbsp;'.$options["title"].'</h4></label>
						</div>
					</div>';

					$count = $count + 1;
				}				
			
			$output .= '</div>';
				
						
			$sqlQueryPrev->bind_param("ii", $questions["question_id"], $this->exam_id);	
			$sqlQueryPrev->execute();
			$resultPrev = $sqlQueryPrev->get_result();
			
			$previousId = '';
			$nextId = '';
			while ($preQuestion = $resultPrev->fetch_assoc()) {
				$previousId = $preQuestion['id'];
			}	
			
			$sqlQueryNext->bind_param("ii", $questions["question_id"], $this->exam_id);	
			$sqlQueryNext->execute();
			$resultNext = $sqlQueryNext->get_result();
			
			while ($nextQuestion = $resultNext->fetch_assoc()) {
				$nextId = $nextQuestion['id'];
			}	
			
			$previousDisable = '';
			$nextDisable = '';

			if($previousId == "") {
				$previousDisable = 'disabled';
			}
			
			if($nextId == "") {
				$nextDisable = 'disabled';
			}
				
			$output .= '
				<br /><br />
				<div>
					<button type="button" name="previous" class="btn btn-info btn-lg previous" id="'.$previousId.'" '.$previousDisable.'>Previous</button>
					<button type="button" name="next" class="btn btn-warning btn-lg next" id="'.$nextId.'" '.$nextDisable.'>Next</button>
				</div>
				<br /><br />';
			}
			echo $output;
		}
	}
	
	



	function getQuestionAnswerOption(){
		if($this->question_id) {
			$sqlQuery = "
				SELECT answer
				FROM ".$this->questionTable."
				WHERE id = ?";				
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->question_id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			return $record;
		}
	}
	









	public function updateExamAnswer() {		
		if($this->exam_id && $this->question_id && $this->answer_option) {					
			$examDetails = $this->getExamInfo();
			$questionOption = $this->getQuestionAnswerOption();					
			$marks = 0;
			if($questionOption['answer'] == $this->answer_option) {
				$marks = '+' . $examDetails['marks_per_right_answer'];
			} else {
				$marks = '-' . $examDetails['marks_per_wrong_answer'];;
			}				
			$stmt = $this->conn->prepare("
				UPDATE ".$this->questionAnswerTable." 
				SET user_answer_option= ?, marks = ?
				WHERE user_id = ? AND exam_id = ? AND question_id = ?");						
			
			$stmt->bind_param("siiii", $this->answer_option, $marks, $_SESSION["userid"], $this->exam_id, $this->question_id);
			
			if($stmt->execute()){
				return true;
			}			
		}		
	}
	







	public function getExamResults () {		
		if($this->exam_id) {			
			$whereSQL = '';
			if($_SESSION["role"] == 'user') {
				$whereSQL = "AND answer.user_id = '".$_SESSION["userid"]."'";
			}
			$sqlQuery = "
				SELECT answer.question_id, answer.marks, question.question, question.answer, answer.user_answer_option
				FROM ".$this->questionTable." question
				LEFT JOIN ".$this->questionAnswerTable." answer ON answer.question_id = question.id
				WHERE question.exam_id = ? $whereSQL GROUP BY question.id"; 			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$records = array();		
			while ($examResult = $result->fetch_assoc()) { 				
				$rows = array();			
				$rows['question_id'] = $examResult['question_id'];
				$rows['marks'] = $examResult['marks'];					
				$rows['question'] = $examResult['question'];
				$rows['answer'] = $examResult['answer'];	
				$rows['user_answer_option'] = $examResult['user_answer_option'];				
				$records[] = $rows;
			}	
			return $records;
		}		
	}
	







	public function getQuestopnOptions ($questionId) {					
		if($questionId) {
			$sqlQuery = "
				SELECT id, question_id, option, title
				FROM ".$this->optionTable." question				
				WHERE question_id = '".$questionId."'"; 				
			$stmt = $this->conn->prepare($sqlQuery);			
			$stmt->execute();
			$result = $stmt->get_result();			
			$records = array();		
			while ($option = $result->fetch_assoc()) { 				
				$rows = array();			
				$rows['option'] = $option['option'];
				$rows['title'] = $option['title'];										
				$records[] = $rows;
			}	
			return $records;
		}		
			
	}
	






	public function getExamTotalMarks () {					
		if($this->exam_id) {					
			$sqlQuery = "
				SELECT SUM(marks) as mark 
				FROM ".$this->questionAnswerTable." 				
				WHERE user_id = '".$_SESSION['the_user']."' AND exam_id = '".$this->exam_id."'"; 				
			// $stmt = $this->conn->prepare($sqlQuery);			
			// $stmt->execute();
			// $result = $stmt->get_result();	
			$result = mysqli_query($this->conn,$sqlQuery);
			$marks=mysqli_fetch_assoc($result);
			$records=$marks["mark"];


			

			// $records = array();		
			// while ($marks = $result->fetch_assoc()) { 				
			// 	$rows = array();			
			// 	$rows['mark'] = $marks['mark'];														
			// 	$records[] = $rows;
			// }	
			return $records;
		}		
			
	}
	






	public function questionNavigation() {		
		if($this->exam_id) {
			$sqlQuery = "
				SELECT id
				FROM ".$this->questionTable."			
				WHERE exam_id = ?"; 
				
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			$output = '
			<div class="card">
				<div class="card-header">Question Navigation</div>
				<div class="card-body">
					<div class="row">
			';
			$count = 1;	
			while ($question = $result->fetch_assoc()) { 	
				$output .= '
				<div class="col-md-2" style="margin-bottom:24px;">
					<button type="button" class="btn btn-primary btn-lg question_navigation" data-question_id="'.$question["id"].'">'.$count.'</button>
				</div>
				';
				$count++;
			}		
			$output .= '
				</div>
			</div></div>
			';
			echo $output;
			
		}			
	}
	







	public function examCompleted() {
		if($_SESSION["userid"] && $this->exam_id) {
			$sqlQuery = "
				SELECT *
				FROM ".$this->questionAnswerTable." 			
				WHERE marks!='' AND user_id = ? AND exam_id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("ii", $_SESSION["userid"], $this->exam_id);	
			$stmt->execute();
			$result = $stmt->get_result();			
			if($result->num_rows > 0){
				return true;
			}
		}
		return false;
	}
	





	function examProcessUpdate() {
		if($_SESSION["userid"] && $this->exam_id){			
			$sqlQueryCheck = "
				SELECT *
				FROM ".$this->processTable." 			
				WHERE userid = ? AND examid = ?";
			$stmtCheck = $this->conn->prepare($sqlQueryCheck);
			$stmtCheck->bind_param("ii", $_SESSION["userid"], $this->exam_id);	
			$stmtCheck->execute();
			$resultCheck = $stmtCheck->get_result();			
			if(!$resultCheck->num_rows){					
				$examStartTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));
				$sqlQuery = "
					INSERT INTO ".$this->processTable."(userid, examid, start_time)
					VALUES(?, ?, ?)";			
				$stmt = $this->conn->prepare($sqlQuery);
				$stmt->bind_param("iis", $_SESSION["userid"], $this->exam_id, $examStartTime);			
				if($stmt->execute()) {					
					$stmtAnswer = $this->conn->prepare("
					INSERT INTO ".$this->questionAnswerTable."(`user_id`, `exam_id`, `question_id`)
					VALUES(?,?,?)");
					
					$sqlQuery = "
						SELECT id
						FROM ".$this->questionTable."
						WHERE exam_id = ?";	
					$stmtQuestion = $this->conn->prepare($sqlQuery);
					$stmtQuestion->bind_param("i", $this->exam_id);
					$stmtQuestion->execute();
					$result = $stmtQuestion->get_result();				
					while ($question = $result->fetch_assoc()) {					
						$stmtAnswer->bind_param("iii", $_SESSION["userid"], $this->exam_id, $question['id']);
						$stmtAnswer->execute();
					}
					return true;
				}
				
			}			
		}		
	}
	






	function getExamProcessDetails() {
		if($_SESSION["userid"] && $this->exam_id){			
			$sqlQuery = "
				SELECT start_time FROM ".$this->processTable."
				WHERE userid = ? and examid = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("ii", $_SESSION["userid"], $this->exam_id);			
			$stmt->execute();				
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			return $record;
		}		
	}
}





?>