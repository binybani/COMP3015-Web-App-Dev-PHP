<?php
// print_r($_FILES["cover_picture"]);
const MAX_FILESIZE = 2000000000;
const FILE_TYPE = "image/jpeg";

$picture = "";

if ($_FILES["cover_picture"]["type"] == FILE_TYPE && $_FILES["cover_picture"]["size"] <= MAX_FILESIZE) {
	$picture = "upload/" . md5(time() . $_FILES["cover_picture"]["name"]) . "jpeg";

	move_uploaded_file($_FILES["cover_picture"]["tmp_name"], $picture);

} else {
	echo "Invalid cover picture!";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cover Picture</title>
</head>

<body>
	<div>
		<img src="<?php echo $picture; ?>" />
	</div>
</body>

</html>