<?php

require_once 'Repositories/CourseRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

$courses = [];
if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
	$coursesRepository = new CourseRepository();
	$courses = $coursesRepository->getCoursesForUser($userId);
} 
foreach ($courses as $course):
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$status = isset($_POST['status']);
	$userId = $_SESSION['user_id'];
  $courseName = $_POST['courseName'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$completed = (new CourseRepository())->completed($status, $authenticatedUser->id);

  if ($completed) {
		header('Location: courses.php');
	} else {
		$_SESSION['error_message'] = 'Error completed course';
		header('Location: complete.php');
	}
	exit(0);
}
endforeach;