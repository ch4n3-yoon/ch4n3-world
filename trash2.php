<!doctype html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

</html>
<?php
if(isset($_POST['submit'])) {
	$save_dir = "./";
	//파일이 HTTP POST 방식을 통해 정상적으로 업로드되었는지 확인한다.
	if(is_uploaded_file($_FILES["upload_file"]["tmp_name"])){
		echo "업로드한 파일명 : " . $_FILES["upload_file"]["name"];
		//파일을 저장할 디렉토리 및 파일명
		$dest = $save_dir . $_FILES["upload_file"]["name"];
		//파일을 지정한 디렉토리에 저장
		if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $dest))
			echo "<p>success</p>";
		else
			die("fail2");
	} else {
		echo "fail1";
	}
}
?>

<form enctype="multipart/form-data" method="post"
	  action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="file" name="upload_file" /><br />
	<input type="submit" value="upload" name="submit"/>
</form>

</body>
