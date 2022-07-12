<?php require_once 'header.php' ?>

<body>
<?php require_once 'nav.php' ?>

	<div class="m-5">
		<!-- MUST POST -->
		<form enctype="multipart/form-data" action="cover_picture.php" method="POST">
			<div>
				<label for="">Cover Picture</label>
				<!-- input type MUST file -->
				<input type="file" name="cover_picture">
				<input type="submit" value="Upload" class="upload-btn">
			</div>
		</form>
		<br/>
		<form enctype="multipart/form-data" action="addCourse.php" method="POST">
			<div>
				<label for="title" class="block text-sm font-medium text-gray-700"> Course Title </label>
				<input id="title" name="title" type="text" placeholder="A title for your course">
				<input type="submit" name="add" value="ADD" class="add-btn" /><br />
			</div>
		</form>
	</div>
</body>
<style>
	input[type="text"],
	textarea {
		outline: none;
		background-color: #d1d1d1;
	}

	input[type=text] {
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		outline: none;
		border: 0px;
		width: 250px;
		height: 30px;
		padding-left: 10px;
	}

	.add-btn, .upload-btn {
		background-color: #000000;
		border: none;
		color: white;
		padding: 7px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 0px 4px;
		cursor: pointer;
		border-radius: 10px;
		font-weight: bold;
	}
</style>
<?php

require_once 'Repositories/CourseRepository.php';
require_once 'Repositories/UserRepository.php';

use src\Repositories\CourseRepository;
use src\Repositories\UserRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = $_POST['title'];
	$is_completed = false;
	$userId = $_SESSION['user_id'];
	$authenticatedUser = (new UserRepository())->getUserById($userId);
	$course = (new CourseRepository())->saveCourse($title, $is_completed, $authenticatedUser->id);
	if ($course) {
		header('Location: courses.php');
	} else {
		$_SESSION['error_message'] = 'Error creating course';
		header('Location: addCourse.php');
	}
	exit(0);
}
