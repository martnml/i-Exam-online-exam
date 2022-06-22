<?php
include_once 'config/Database.php';
include_once 'class/Exam.php';

$database = new Database();
$db = $database->getConnection();

$exam = new Exam($db);

if(!empty($_POST['action']) && $_POST['action'] == 'examDetails') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->getExamDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'enrollExam') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->enrollToExam();
}

if(!empty($_POST['action']) && $_POST['action'] == 'listUserExam') {
	$exam->listUserExam();
}

if(!empty($_POST['action']) && $_POST['action'] == 'loadQuestion') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->question_id = $_POST['question_id'];
	$exam->loadQuestions();
}

if(!empty($_POST['action']) && $_POST['action'] == 'answer') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->question_id = $_POST['question_id'];
	$exam->answer_option = $_POST['answer_option'];
	$exam->updateExamAnswer();
}

if(!empty($_POST['action']) && $_POST['action'] == 'questionNavigation') {
	$exam->exam_id = $_POST['exam_id'];
	$exam->questionNavigation();
}

?>