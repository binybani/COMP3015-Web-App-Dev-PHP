<?php

require_once 'Repositories/CourseRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$userId = $_SESSION['user_id'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$course = (new CourseRepository())->deleteCourse($title, $authenticatedUser->id);
	if ($course = null) {
		header('Location: courses.php');
	} else {
		$_SESSION['error_message'] = 'Error deleting course';
		header('Location: delete.php');
	}
	exit(0);
}
