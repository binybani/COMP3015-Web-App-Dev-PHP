<?php

require_once 'Repositories/CourseRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['courseName'];
	$userId = $_SESSION['user_id'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$update = (new CourseRepository())->updateTitle($title, $authenticatedUser->id);
	if ($update) {
		header('Location: courses.php');
	} else {
		$_SESSION['error_message'] = 'Error updating course';
		header('Location: updateCourse.php');
	}
	exit(0);
}
