<?php

class Questions {	
   
	private $examTable = 'exams';
	private $questionTable = 'exam_question';
	private $optionTable = 'exam_option';
	private $conn;
	

   

	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listQuestions(){	
			
		$sqlQuery = "
			SELECT questions.id, questions.question, questions.answer, options.title as option_title
			FROM ".$this->questionTable." AS questions
			LEFT JOIN ".$this->examTable." AS exam ON questions.exam_id = exam.id
			LEFT JOIN ".$this->optionTable." AS options ON options.option = questions.answer AND questions.id = options.question_id
			WHERE exam.user_id = ? AND questions.exam_id = ? GROUP BY questions.id ";		
		if(!empty($_POST["order"])){
			$sqlQuery .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= ' ORDER BY questions.id ASC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("ii", $_SESSION["userid"], $this->examid);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare($sqlQuery);
		$stmtTotal->bind_param("ii", $_SESSION["userid"], $this->examid);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();	
	
		while ($question = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $question['id'];
			$rows[] = $question['question'];
			$rows[] = $question['option_title'];			
			$rows[] = '<button type="button" name="update" id="'.$question["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';			
			$rows[] = '<button type="button" name="delete" id="'.$question["id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';		
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

	public function getQuestion(){
		if($this->question_id) {			
			$sqlQuery = "
			SELECT questions.id as question_id, questions.question, questions.answer, options.id as option_id, options.option, options.title
			FROM ".$this->optionTable." AS options 
			LEFT JOIN ".$this->questionTable." AS questions ON options.question_id = questions.id
			WHERE questions.id = ? ";			
					
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->question_id);	
			$stmt->execute();
			$result = $stmt->get_result();				
			$records = array();		
			while ($question = $result->fetch_assoc()) { 				
				$rows = array();			
				$rows['question_id'] = $question['question_id'];
				$rows['question'] = $question['question'];			
				$rows['answer'] = $question['answer'];
				$rows['option_id'] = $question['option_id'];
				$rows['option'] = $question['option'];	
				$rows['title'] = $question['title'];				
				$records[] = $rows;
			}		
			$output = array(			
				"data"	=> 	$records
			);
			echo json_encode($output);
		}
	}
	
		
	public function insert(){
		
		if($this->exam_id && $this->question_title && $this->answer_option) {

			$sql="UPDATE exams SET total_question=total_question+1
			WHERE id='$this->exam_id' ";
			$result=mysqli_query($this->conn,$sql);



			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->questionTable."(`exam_id`, `question`, `answer`)
				VALUES(?,?,?)");
		
			$this->question_title = htmlspecialchars(strip_tags($this->question_title));
			$this->answer_option  = htmlspecialchars(strip_tags($this->answer_option));			
			$stmt->bind_param("iss", $this->exam_id, $this->question_title, $this->answer_option);
			
			if($stmt->execute()){
				$lastInsertQuestionId = $this->conn->insert_id;
				$stmt1 = $this->conn->prepare("
					INSERT INTO ".$this->optionTable."(`question_id`, `option`, `title`)
					VALUES(?,?,?)");				
				foreach($this->option as $key => $value) {					
					$stmt1->bind_param("iis", $lastInsertQuestionId, $key, $value);
					$stmt1->execute();
				}
				return true;
			}	
			
		


		}
	}
	
	
	public function update(){
		
		if($this->question_id && $this->question_title && $this->answer_option) {
			
			
			
			
			$stmt = $this->conn->prepare("
			UPDATE ".$this->questionTable." 
			SET question = ?, answer = ?
			WHERE id = ?");
	 
			$this->question_id = htmlspecialchars(strip_tags($this->question_id));
			$this->question_title = htmlspecialchars(strip_tags($this->question_title));
			$this->answer_option  = htmlspecialchars(strip_tags($this->answer_option));	
			
			$stmt->bind_param("ssi", $this->question_title, $this->answer_option, $this->question_id);
			
			if($stmt->execute()){
				$stmt1 = $this->conn->prepare("					
					UPDATE ".$this->optionTable." 
					SET title = ?
					WHERE option = ? AND question_id = ?");
			
				foreach($this->option as $key => $value) {					
					$stmt1->bind_param("sii", $value, $key, $this->question_id);
					$stmt1->execute();
				}
				return true;
			}
			
		}	
	}	
	
	public function delete(){




			
		$exam_id=$_SESSION['exam'];
			
		$sql = "UPDATE exams SET total_question=total_question-1
		WHERE id='$exam_id' ";
		$result = mysqli_query($this->conn,$sql);



		
		if($this->question_id && $_SESSION["userid"]) {
		

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->questionTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->question_id));

			$stmt->bind_param("i", $this->question_id);

			if($stmt->execute()){
				$stmt1 = $this->conn->prepare("
					DELETE FROM ".$this->optionTable." 
					WHERE question_id = ?");
				$stmt->bind_param("i", $this->question_id);
				return true;
			}
		}
	} 
}
?>