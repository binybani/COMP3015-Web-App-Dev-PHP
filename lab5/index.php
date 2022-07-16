<?php 
$courses = json_decode(file_get_contents('./courses.json'), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		body {
			margin: 10%;
		}

		ul {
			list-style: none;
		}

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

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course Manager</title>
</head>

<body>
	<div>
		<!-- MUST POST -->
		<form enctype="multipart/form-data" action="cover_picture.php" method="post">
			<div>
				<label for="">Cover Picture</label>
				<!-- input type MUST file -->
				<input type="file" name="cover_picture">
				<input type="submit" value="Upload" class="upload-btn">
			</div>
		</form>
		<br/>
		<form enctype="multipart/form-data" action="addCourse.php" method="post">
			<div>
				<input type="text" id="courseName" name="courseName" placeholder="ex-COMP3015">
				<input type="submit" name="add" value="ADD" class="add-btn btn-info" /><br />
			</div>
		</form>
	</div>
	<div>
		<!-- Loop through each of the courses -->
    	<?php foreach($courses["database"] as $key=>$course): ?>
    
    	<div id="course_list">
			<!-- Checkbox Form -->
			<form style="display: inline" action="complete.php" method="post" id="complete">
				<input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
				<input type="checkbox" name="status" id="cbox" value="1" <?= $course['completed'] ? 'checked' : '' ?>>
				<!-- Editable Course Title  -->
				<label class="strikethrough">
					<span class="courseTitle" data-originalcoursename="<?= $course["courseTitle"] ?>" contentEditable="true">
						<?php echo $course["courseTitle"] ?>
					</span>
					<!-- Editable Course Title  -->
				</label>
			</form>
			<!-- Checkbox Form End  -->

			<!-- Delete Button Form  -->
			<form style="display: inline" action="delete.php" method="post">
				<input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
				<button class="delete-btn" name="delete-btn" value="DELETE" onclick='removeList();'>DELETE</button>
			</form>
			<!-- Delete Button Form End  -->
		</div>
		<?php endforeach;?>
		
		<!-- Update Button Form  -->
		<form style="display: none;" id="updateForm" action="updateCourse.php" method="post">
		<input type="hidden" name="courseName" value="<?= $course["courseTitle"] ?>">
		<button id="updateButton">Update</button>
		</form>
		<!-- Update Button Form End  -->
	</div>
</body>

</html>
<script>
const checkboxes = document.querySelectorAll('input[type=checkbox]');
checkboxes.forEach(ch => {
	ch.onclick = function() {
		this.parentNode.submit()
	};
})

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