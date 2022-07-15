<?php require_once 'header.php'; ?>

<?php

require_once 'Repositories/CourseRepository.php';

use src\Repositories\CourseRepository;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$courses = [];
if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
	$coursesRepository = new CourseRepository();
	$courses = $coursesRepository->getCoursesForUser($userId);
} else {
	header('Location: login.php');
}
?>

<body>

<?php require_once 'nav.php' ?>
	<div class="mx-12 mt-12">
		<!-- cover picture upload -->
		<form enctype="multipart/form-data" action="cover_picture.php" method="POST">
			<div>
				<label for="">Cover Picture</label>
				<input type="file" name="cover_picture">
				<input type="submit" value="Upload" class="upload-btn">
			</div>
		</form>
		<!-- cover picture upload end -->
		<br/>
		<!-- add course -->
		<form enctype="multipart/form-data" action="addCourse.php" method="POST">
			<div>
				<label for="title" class="block text-sm font-extrabold"> Course Title </label>
				<input id="title" name="title" type="text" placeholder="A title for your course">
				<input type="submit" name="add" value="ADD" class="add-btn" /><br />
			</div>
		</form>
	</div>
	<!-- add course end -->

	<!-- course list -->
	<div class="my-12">
		<div class="mx-12">
			<ul role="list">
				<span class="font-extrabold"><?php echo count($courses) === 0 ? 'No courses yet.' : 'Your Courses:' ?></span>
				<!-- Loop through each of the courses -->
				<?php foreach ($courses as $course): ?>
					<li class="py-4 flex" id="course_list">
						<div class="ml-3">
							<!-- Checkbox Form -->
							<form style="display: inline" action="complete.php" method="POST" id="complete">
								<input type="hidden" name="courseName" value="<?= $course->title ?>">
								<input type="checkbox" name="status" id="cbox" value="1" <?= $course->is_completed ? 'checked' : '' ?>>
								<!-- Editable Course Title  -->
								<label class="strikethrough">
									<span class="courseTitle" data-originalcoursename="<?= $course->title ?>" contentEditable="true">
									<?php echo $course->title ?>
									</span>
								</label>
								<!-- Editable Course Title  -->
							</form>
							<!-- Checkbox Form End  -->
						</div>
						<!-- Delete Button Form  -->
						<form style="display: inline" action="delete.php" method="POST">
							<input type="hidden" name="courseName" value="<?= $course->title ?>">
							<button class="delete-btn" name="delete-btn" value="DELETE" onclick='removeList();'>DELETE</button>
						</form>
						<!-- Delete Button Form End  -->
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<!-- Update Button Form  -->
		<form style="display: none;" id="updateForm" action="updateCourse.php" method="post" class="mx-12">
			<input type="hidden" name="courseName" value="<?= $course->title ?>">
			<button id="updateButton">Update</button>
		</form>
		<!-- Update Button Form End  -->
	</div>
	<!-- course list end -->
</body>
<script>
const checkboxes = document.querySelectorAll('input[type=checkbox]');
checkboxes.forEach(ch => {
	ch.onclick = function() {
		this.parentNode.submit()
	};
})

document.querySelectorAll('input[name="status"]').forEach(function(item){
	item.onlclick=function(){
		document.getElementById('complete').submit();
	}
});

/* CODE TO HANDLE EDITING TITLES */
const editedCourses = [];
const editableCourseTitles = document.querySelectorAll('.courseTitle');
const updateButton = document.querySelector('#updateButton');

// Event Handler for when you click out of content-editable
editableCourseTitles.forEach(course => course.addEventListener("blur", (e) => {
	const updateForm = document.querySelector('#updateForm');
	updateForm.style.display = "block";
	editedCourses.push({
		"originalCourseTitle": e.target.getAttribute("data-originalcoursename"),
		"newCourseTitle": e.target.innerText
	});
}));

// Event Handler for when you click on the update button
updateButton.addEventListener("click", async () => {
	const response = await fetch('updateCourse.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(editedCourses)
	});
});

function removeList() {
  var row = document.getElementById('course_list');
  if (row) {
    row.parentNode.removeChild(row);
  }
}

</script>
<style>
	ul {
		list-style: none;
	}

	input[type="text"],
	textarea {
		outline: none;
		background-color: #d1d1d1;
	}

	input[type=text] {
		color: #000;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		outline: none;
		border: 0px;
		width: 250px;
		height: 30px;
		padding-left: 10px;
	}

	.add-btn, .upload-btn, #updateButton {
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

	.delete-btn {
		background-color: #992526;
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

	input[type="checkbox"] {
		-webkit-appearance: none;
		position: relative;
		width: 20px;
		height: 20px;
		cursor: pointer;
		outline: none !important;
		border-radius: 5px;
		background: #d8d8d8;
		align-items: center;

	}

	input[type="checkbox"]::before {
		content: "\2713";
		position: absolute;
		top: 50%;
		left: 50%;
		overflow: hidden;
		transform: scale(0) translate(-50%, -50%);
		line-height: 1;
	}

	input[type="checkbox"]:hover {
		border-color: rgba(170, 170, 170, 0.5);
	}

	input[type="checkbox"]:checked {
		background-color: #d8d8d8;
		color: black;
	}

	input[type="checkbox"]:checked::before {
		border-radius: 2px;
		transform: scale(1) translate(-50%, -50%)
	}

	#text {
		font-weight: bold;
		font-size: x-large;
	}
	
	input[type=checkbox]:checked + label.strikethrough {
		color: red;
		text-decoration:line-through;
	}
</style>