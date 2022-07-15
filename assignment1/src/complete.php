<?php
require_once 'courses.php';
require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$courses = [];
$courseName = $_POST['courseName'];
// Here, update $courses by setting completed to true or false depending on what $_POST['status'] is
foreach($courses as $course) {
  if($course->title == $courseName) {
    $courses->is_completed = isset($_POST['status']);
  }
}

header("Location: courses.php");
exit();
?>
