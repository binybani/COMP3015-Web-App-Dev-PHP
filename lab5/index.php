<?php 
 $error = '';  
 if(isset($_POST["add"]))  
 {  
	if(empty($_POST["course-name"]))  
	{  
		$error = "<label class='text-danger'>Enter Course Name!!</label>";  
	} 
	else {
	if(file_exists('courses.json'))  
	{  
		$current_data = file_get_contents('courses.json');  
		$array_data = json_decode($current_data, true);  
		$extra = array(
			'completed' => false,
		);  
		$array_data[$_POST["course-name"]] = $extra;
		$final_data = json_encode($array_data, JSON_PRETTY_PRINT);
		file_put_contents('courses.json', $final_data);   
	}  
	else  
	{  
		$error = 'JSON File not exits';  
	}  
	}
}
$courses = json_decode(file_get_contents('./courses.json'), true);
// if(isset($_POST["checkboxes"]))
// {
// 	echo "checked";
// } else {
// 	echo "unchecked";
// }
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
		<form enctype="multipart/form-data" action="lab5/cover_picture.php" method="post">
			<div>
				<label for="">Cover Picture</label>
				<!-- input type MUST file -->
				<input type="file" name="cover_picture">
				<input type="submit" value="Upload" class="upload-btn">
			</div>
		</form>
		<br/>
		<form enctype="multipart/form-data" method="post">
			<div>
				<input type="text" id="course-name" name="course-name" placeholder="ex-COMP3015">
				<input type="submit" name="add" value="ADD" class="add-btn btn-info" /><br />
				<?php
				echo "$error";
				?>
			</div>
		</form>
	</div>
	<table>
    <?php foreach($courses as $key=>$course): ?>
    <tr>
    	<td id="course_list">
			<form action="lab5/complete.php" method="POST">
				<input type="hidden" name="courseName" value="<?php echo $key ?>">
				<input type="checkbox" name="status" id="cbox" <?php echo($course['completed'] ? 'checked' : '') ?>>
				<label class="strikethrough">
				<span id="editable" name="new-course-name"><?= $key; ?></span>
				</label>
				<button class="delete-btn" name="delete-btn" value="DELETE" onclick='removeList();'>DELETE</button>			
			</form>
		</td>
    </tr>
    <?php endforeach;?>
	</table>
</body>

</html>
<script>
document.querySelectorAll("#editable").forEach(function(node){
	node.ondblclick=function(){
		var val=this.innerHTML;
		var input=document.createElement("input");
		input.value=val;
		input.onblur=function(){
			var val=this.value;
			this.parentNode.innerHTML=val;
		}
		this.innerHTML="";
		this.appendChild(input);
		input.focus();
	}
});
function removeList() {
  var row = document.getElementById('course_list');
  if (row) {
    row.parentNode.removeChild(row);
  }
}

document.querySelectorAll('input[name="status"]').forEach(function(item){
	item.onlclick=function(){
		document.getElementById('complete').submit();
	}
});
</script>