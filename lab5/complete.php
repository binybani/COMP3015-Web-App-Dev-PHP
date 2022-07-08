<?php
$courses = json_decode(file_get_contents('./courses.json'), true);
$courseName = $_POST['courseName'];
// Here, update $courses by setting completed to true or false depending on what $_POST['status'] is
foreach($courses["database"] as $key => $course) {
  if($course["courseTitle"] == $courseName) {
    $courses["database"][$key]["completed"] = isset($_POST['status']);
  }
}

file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT)); // write the updated data back to disk
// here, redirect to index.php
header("Location: index.php");
exit();
?>
