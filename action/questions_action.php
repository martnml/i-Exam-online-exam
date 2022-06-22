<?php
include_once 'config/Database.php';
include_once 'class/Questions.php';

$database = new Database();
$db = $database->getConnection();

$questions = new Questions($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listQuestions') {
	$questions->examid = $_POST['exam_id'];
	$questions->listQuestions();
}


if(!empty($_POST['action']) && $_POST['action'] == 'getQuestion') {
	$questions->question_id = $_POST["question_id"];
	$questions->getQuestion();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addQuestions') {
	$questions->exam_id = $_POST["exam_id"];	
	$questions->question_title = $_POST["question_title"];
	$options = array();	
	for($count = 1; $count <= 4; $count++) {
		$options[$count] = $_POST['option_title_' . $count];
	}
	$questions->option = $options;    
	$questions->answer_option = $_POST["answer_option"];
	$questions->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateQuestions') {
	$questions->question_id = $_POST["id"];
	$questions->question_title = $_POST["question_title"];	
	$options = array();	
	for($count = 1; $count <= 4; $count++) {
		$options[$count] = $_POST['option_title_' . $count];
	}
	$questions->option = $options;    
	$questions->answer_option = $_POST["answer_option"];
	$questions->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteQuestions') {
	$questions->question_id = $_POST["id"];
	$questions->delete();
}

?>