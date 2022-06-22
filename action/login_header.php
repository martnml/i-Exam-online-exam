<?php 
include_once '../../config/Database.php';
include_once '../../class/User.php';
include_once '../../fact.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    header("Location: ../../login.php");
}


?>