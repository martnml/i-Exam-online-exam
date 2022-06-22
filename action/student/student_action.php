<?php
include_once '../../config/Database.php';
include '../../class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


//----------------------------- list of students
if(!empty($_POST['action']) && $_POST['action'] == 'listUsers') {
	$user->listUsers();
}



//----------------------------- get student by his id
if(!empty($_POST['action']) && $_POST['action'] == 'getUser') {
	$user->id = $_POST["userid"];
	$user->getUser();
}




//------------------------------- get student details
if(!empty($_POST['action']) && $_POST['action'] == 'getUserDetails') {
	$user->userid = $_POST["userId"];
	$user->getUserDetails();
}




//--------------------------------- add a student
if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
	$user->firstName = $_POST["firstName"];
	$user->lastName = $_POST["lastName"];
	$user->email = $_POST["email"];
	$user->mobile = $_POST["mobile"];
	$user->address = $_POST["address"];
	$user->role = $_POST["role"];
	
	$user->newPassword = $_POST["newPassword"];     
	$user->insert();
}




//-------------------------- change student informations
if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
	$user->updateUserId = $_POST["userId"]; 
	$user->firstName = $_POST["firstName"];
	$user->lastName = $_POST["lastName"];
	$user->email = $_POST["email"];
	$user->mobile = $_POST["mobile"];
	$user->address = $_POST["address"];
	$user->role = $_POST["role"];
	
	$user->newPassword = $_POST["newPassword"];     
	$user->update();
}



//--------------------------------- delete a student by his id 
if(!empty($_POST['action']) && $_POST['action'] == 'deleteUser') {
	$user->deleteUserId = $_POST["userId"];
	$user->delete();
}

?>