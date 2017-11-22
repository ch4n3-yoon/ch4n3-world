<!DOCTYPE html>
<html lang="ko">
<?php

session_start();
if (!isset($_SESSION['nick'])) {
	die("<script>alert('login plz'); location.href='./';</script>");
} else if (!isset($_GET['no']) || $_GET['no'] == "") {
	die("query error.."); //check the value, 'no'
} else if (preg_match("/[^0-9]/i", $_GET['no'])) {
	die("Only digits..");
}

include './dbconfig.php'; //$mysqli

// Check if MySQL has the value, 'no'
$no = $_GET['no'];
$query = "SELECT * FROM probs WHERE no=($no)";
$result = mysqli_fetch_array($mysqli->query($query));

if (!isset($result['no'])) {
	die("<script>alert('Query error..');	location.href='./probs.php';	</script>");
}

$prob = $result['prob']; //문제명
$point = $result['point']; //점수
$author = $result['author']; //문제 만든이
$category = $result['category']; //문제 카테고리
$text = $result['text']; //문제 부가설명
$flag = $result['flag']; //플래그

?>
	<head>
		<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    	<title>ch4n3 world - Solve</title

    	<!-- Bootstrap core CSS -->
    	<link href="http://bootstrapk.com/dist/css/bootstrap.min.css" rel="stylesheet">


    	<!-- Custom styles for this template -->
    	<link href="http://bootstrapk.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">

    	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    	<script src="http://bootstrapk.com/assets/js/ie-emulation-modes-warning.js"></script>

    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    	<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
  	</head>

  	<body>
		<div class="container">
      <div class="header">
			<nav>
				<ul class="nav nav-pills pull-right">
            	<li role="presentation"><a href="./">Home</a></li>&nbsp;
					<li role="presentation"><a href="./probs.php">List</a></li>
            	<li role="presentation"><a href="#">About</a></li>
            	<li role="presentation"><a href="#">Contact</a></li>
          	</ul>
        	</nav>
        	<h3 class="text-muted">
				Ch4n3 World
			</h3>
      </div>

      <div class="jumbotron">
        	<h2 align="left"><?php echo ($prob); ?> (<?php echo ($category); ?>)</h2>
			<br />
			<!-- Author and point -->
        	<p class="lead" align="left">
				Created by <b><?php echo ($author); ?></b> |
				You can get <?php echo ($point); ?>point!
			</p>

			<!-- prob information text -->
			<hr />
			<div class="lead" align="left" >
				<pre style="font-size: 18px;"><?php echo ($text); ?></pre>
			</div>
			<hr />
			<div class="row">
	  			<div class="col-lg-6">
	    			<div class="input-group">
	      			<input type="text" id="flag" class="form-control" placeholder="ex) Y0u_g0t_the_f14g!" size="50">
	      			<span class="input-group-btn">
	        				<button style="height: 35px; padding-top: 0px;" class="btn btn-secondary" type="button" id="auth">Auth</button>
	      			</span>
	    			</div>
	  			</div>
			</div>
			<br />
			<div id="result" role="alert">

			</div>

      </div>


      <div class="row marketing">
			<h3>People who solved this prob.</h3>
        	<div class="col-lg-6">
				<?php

$query = "SELECT COUNT(*) AS solvers FROM solvers WHERE no=($no)";
$result = mysqli_fetch_array($mysqli->query($query));

$solvers = $result['solvers'];
if ($solvers % 2 == 0) {
	//'$solvers' is even number.
	$solvers /= 2;
} else {
	//'$solvers' is odd number.
	$solvers += 1;
	$solvers /= 2;
}

$query = "SELECT * FROM solvers WHERE no=($no) ORDER BY date DESC LIMIT {$solvers}";
$result = $mysqli->query($query);

while ($rows = $result->fetch_array()) {
	?>
                <?php
//get prob's name
	$query = "SELECT prob FROM probs WHERE no=({$rows['no']})";
	$re = mysqli_fetch_array($mysqli->query($query));
	?>
					 <h4><?php echo ($rows['nick']) ?></h4>
	           	<p>solved at <?php echo ($rows['date']) ?>.</p>
            <?php }?>


        	</div>


        	<div class="col-lg-6">

				<?php
$query = "SELECT * FROM solvers WHERE no=($no) ORDER BY date DESC LIMIT {$solvers}, {$solvers}";
$result = $mysqli->query($query);

while ($rows = $result->fetch_array()) {
	?>
					 <?php
//get prob's name
	$query = "SELECT prob FROM probs WHERE no=({$rows['no']})";
	$re = mysqli_fetch_array($mysqli->query($query));
	?>
					 <h4><?php echo ($rows['nick']) ?></h4>
					<p>solved at <?php echo ($rows['date']) ?>.</p>
				<?php }?>
        	</div>
      </div>

      <footer class="footer">
			<p>&copy; ch4n world</p>
      </footer>

		</div> <!-- /container -->
	 <script src="./solve_js.js"></script>
	 <script>
	 	var no = <?php echo ($_GET['no']); ?>
	 </script>
  </body>
</html>
