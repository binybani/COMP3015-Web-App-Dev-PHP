<?php
$courses = json_decode(file_get_contents('./courses.json'), true);
$courseName = $_POST['courseName'];
// Here, update $courses by setting completed to true or false depending on what $_POST['status'] is
if (isset($courseName)){
  
    foreach($courses as $key=>$course):
    $current_status = $course['completed'];
  
    if ($_POST['status'] == 'checked') {
        $switch_data = array(
			'completed' => true,
		); 
    } else {
        $switch_data = array(
			'completed' => false,
		); 
    };
    endforeach;
    $courses[$_POST["course-name"]] = $switch_data;
}

file_put_contents('./courses.json', json_encode($courses, JSON_PRETTY_PRINT)); // write the updated data back to disk
// here, redirect to index.php
header("Location: index.php");
exit();
?>
