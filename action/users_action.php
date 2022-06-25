<?php
include_once '../config/Database.php';
include_once '../class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listUsers') {
	$user->listUsers();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getUser') {
	$user->id = $_POST["id"];
	$user->getUser();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getUserDetails') {
	$user->userid = $_POST["userId"];
	$user->getUserDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
	$user->firstName = $_POST["firstName"];
	$user->lastName = $_POST["lastName"];
	$user->email = $_POST["email"];
	$user->mobile = $_POST["mobile"];
	$user->address = $_POST["address"];
	// $user->role = $_POST["role"];
	// $user->specility = $_POST["specility"];
	$user->newPassword = $_POST["newPassword"]; 
	// $user->id_specility = $_POST["id_specility"];    
	$user->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
	$user->updateUserId = $_POST["userId"]; 
	$user->firstName = $_POST["firstName"];
	$user->lastName = $_POST["lastName"];
	$user->email = $_POST["email"];
	$user->mobile = $_POST["mobile"];
	$user->address = $_POST["address"];
	$user->role = $_POST["role"];
	$user->newPassword = $_POST["newPassword"];
	// $user->id_specility = $_POST["id_specility"];     
	$user->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteUser') {
	$user->deleteUserId = $_POST["userId"];
	$user->delete();
}

?>