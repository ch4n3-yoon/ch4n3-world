<!DOCTYPE html>
<html lang="ko">
<head>
  <title>CH4N3 world :: write</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron text-center">
  <h1>ch4n3 world challenge writing</h1>
  <p>문제를 출제하고, 만든 문제를 ch4n3 world에 올릴 수 있습니다!</p>
</div>

<div class="container">
		<div class="row">
  		<div class="col-sm-4">
  			<a herf="./">홈으로</a>
  		</div>
  		<div class="col-sm-4">
  			<a href="./write.php?write=">문제 제출</a>
  		</div>
  		<div class="col-sm-4">
			<a href="./write.php?now=">문제 현황</a>
  		</div>
	</div>
  <?php

	if(isset($_GET['write'])) {
	?>
	<form class="form-inline">
		<div class="input-group">
    		<span class="input-group-addon">문제명</span>
    		<input id="msg" type="text" class="form-control" name="probName" placeholder="Input the name of the challenge">
  		</div>
		<div class="form-group">
 			<label class="sr-only" for="pwd">Password:</label>
 			<input type="password" class="form-control" id="pwd">
		</div>
		<div class="checkbox">
 			<label><input type="checkbox"> Remember me</label>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	</form>
	<?php
	}
  ?>
</div>

</body>
</html>
