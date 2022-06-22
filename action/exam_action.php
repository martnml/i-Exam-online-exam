<?php
include_once 'config/Database.php';
include_once 'class/Exam.php';

$database = new Database();
$db = $database->getConnection();

$exam = new Exam($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listExam') {
	
	$exam->listExam();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExam') {
	$exam->id = $_POST["id"];
	$exam->getExam();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addExam') {	
	$exam->exam_title = $_POST["exam_title"];  
	$exam->id_specility= $_POST["id_specility"];
	$exam->duration = $_POST["exam_duration"];
	$exam->endtime = $_POST["endtime"]; 
	$exam->total_question = $_POST["total_question"];
	$exam->marks_per_right_answer = $_POST["marks_right_answer"];
	$exam->marks_per_wrong_answer = $_POST["marks_wrong_answer"];
	$exam->status = $_POST["status"];
	$exam->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateExam') {
	$exam->id = $_POST["id"];
	$exam->exam_title = $_POST["exam_title"]; 
	$exam->duration = $_POST["exam_duration"];
	$exam->id_specility= $_POST["id_specility"];
	$exam->endtime = $_POST["endtime"]; 
	$exam->total_question = $_POST["total_question"];
	$exam->marks_per_right_answer = $_POST["marks_right_answer"];
	$exam->marks_per_wrong_answer = $_POST["marks_wrong_answer"];
	$exam->status = $_POST["status"];	
	$exam->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteExam') {
	$exam->id = $_POST["id"];
	$exam->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExamEnroll') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->getExamEnroll();
}
?>