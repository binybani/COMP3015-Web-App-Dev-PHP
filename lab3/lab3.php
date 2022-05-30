<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Lab3 Form Processing</title>
</head>

<body>
  <h1>Form Processing Solution</h1>
  <?php
	//a constant to measure the length of user's name
	const MINIMUM_NAME_LENGTH 	= 2;

	//compound statement, ensure all form fields exist
	if (
		!isset($_POST['username'])
		|| !isset($_POST['password'])
		|| !isset($_POST['student-number'])
	) {
		die("Uh oh, the form fields dont seem to exist...<br />");
	}
	if(!isset($_POST['gender'])) {
		die("A gender must be selected.<br />");
	}
	//normalize data with trim()
	$uname 	=  ucwords(trim($_POST['username']));
	$pword 	=  trim($_POST['password']);
	$studentnum 	=  trim($_POST['student-number']);
	$gender = ($_POST['gender']);

	//apply any other rules we wish...
	if (strlen($uname) < MINIMUM_NAME_LENGTH) {
		die("Uh oh, the user name fields require at least two characters<br />");
	}

	//the only allowed password is 'bcit'
	if( $pword != "bcit"){				
		die("<p>Stop processing. Password was incorrect</p>");	
	}

	//match BCIT student number pattern: A0nnnnnnn
	$pattern = "/A0[0-9][0-9][0-9][0-9][0-9][0-9][0-9]/i";
	if(!(preg_match($pattern, $studentnum))){				
		echo "<p>Student number not match BCIT student number pattern: A0nnnnnnn</p>";
	} else if (strlen($pattern) != 9) {
		echo "<p>Student number length must be 9!</p>";
	}

	// print message depending on number of chosen language 
	if (isset($_POST['languages'])) {
		$arrayOfLanguages = $_POST['languages'];
		if (count($arrayOfLanguages)>=2){
			echo "<p>You are multilingual</p>";
		} else if (count($arrayOfLanguages)>5) {
			echo "<p>Impressive. You have been studying quite a few computing languages</p>";
		};
		foreach ($arrayOfLanguages as $oneLanguage) {
			echo "<br />" . $oneLanguage;
		}
	} else {
		echo "<p>You are not studying any computer language(s)</p>";
	}

	//do some special processing based on the user input
	$gendertitle = "";	
	if ($gender == 'female'){
		$gendertitle = 'Ms. ';
	} else {
		$gendertitle = 'Mr. ';
	}
	echo "<p>Hello, " . $gendertitle . $uname . "!" . "</p>";

	?>
</body>

</html>