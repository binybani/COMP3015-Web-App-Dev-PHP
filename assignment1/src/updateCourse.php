<?php
$rawPostBody = file_get_contents("php://input");
require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$courses = [];
foreach ($rawPostBody as $index => $payload) {
	$payloadAsArray = [];
	foreach($courses as $course) {
		if ($course->title == $payloadAsArray["originalCourseTitle"]) {
				$courses->title = $payloadAsArray["newCourseTitle"];
		}
	}
}

header('Location: courses.php');
?>
