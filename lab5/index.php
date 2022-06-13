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

		.add-btn {
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
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Course Manager</title>
</head>

<body>
	<h1>My Classes</h1>
	<div>
		<form enctype="multipart/form-data" action="" method="post">
			<div>
				<input type="text" id="texto" placeholder="ex-COMP3015">
				<button type="button" id="btn" class="add-btn">ADD</button>
			</div>
			<ul id="ul"></ul>
		</form>
	</div>

</body>

</html>
<script>
	// document.querySelectorAll("table tr:nth-child(2) td").forEach(function(node) {
	document.querySelectorAll("ul").forEach(function(node) {
		node.ondblclick = function() {
			var val = this.innerHTML;
			var input = document.createElement("input");
			input.value = val;
			input.onblur = function() {
				var val = this.value;
				this.parentNode.innerHTML = val;
			}
			this.innerHTML = "";
			this.appendChild(input);
			input.focus();
		}
	});

	function addItem() {
		var ul = document.getElementById('ul'); //ul
		var li = document.createElement('li'); //li
		var p = document.createElement('p');
		var button = document.createElement("BUTTON");
		button.classList.add('delete-btn');
		var label = document.createElement('label');
		label.classList.add('class-checkbox');
		var t = document.createTextNode("Delete");
		var checkbox = document.createElement('input');

		checkbox.type = "checkbox";
		checkbox.value = 1;
		checkbox.name = "todo[]";

		li.appendChild(checkbox);
		var text = document.getElementById('texto');
		li.appendChild(document.createTextNode(text.value));

		li.appendChild(button);
		button.appendChild(t);
		ul.appendChild(li);

	}
	var button = document.getElementById('btn');
	button.onclick = addItem
</script>