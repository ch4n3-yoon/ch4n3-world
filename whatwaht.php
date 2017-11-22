<?php

eval(base64_decode("JGZsYWdfcHJpY2UgPSAyMDEyMTAwMjE7"));

if(isset($_POST['money']) && (((int)$_POST['money'] > $_SESSION['money'])) || ((int)$_POST['money'] < $flag_price)){
	Alert("Not enough money..You have only $".$_SESSION['money'],"shop");
}else{
	if((int)$_POST['money'] == $flag_price){
		include("/flag");
	}
}

?>

<h1> Complain Menu </h1>

<h3> Tell me your opinion to admin</h3>


<form method="POST">
	<p>Opinion:</p><textarea name="opinion" rows=10 cols=35></textarea>
	<p>Password: <input type="text" name="password"></p>

	<input type="submit" value="SEND">
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(strpos(session_id(), "php")){
		Alert("No hack!", "opinion");
	}else{
		$fp = fopen("./opinion/".$_POST['password']."_".session_id(),"w");
		if(!$fp){
			Alert("no hack!", "opinion");
		}else{
			fwrite($fp, $_POST['opinion']);
			fclose($fp);
			Alert("Thanks your opinion!","opinion");
		}
	}
}
?>
<a href="?page=view">view opinion</a>


<h1>View submited opinion</h1>
<h3>Input password</h3>
<form method="post">
	<p>password: <input type="text" name="password"></p>
	<input type="submit" value="CHECK">
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(strpos(session_id(), "php")){
		Alert("No hack!", "opinion");
	}else{
		$fp = fopen("./opinion/".$_POST['password']."_".session_id(), "r");
		if(!$fp){
			Alert("Your opionon doesn't existed!","opinion");
		}else{
			Alert(fread($fp, 100), "opinion");
		}
	}
}

?>

<html>
<head>
	<title>Buy the Flag</title>
</head>
<body>

<?php
function Alert($message, $redirect_page) {
	print '<script type="text/javascript">alert("'.$message.'");';
	print 'window.location.href="?page='.$redirect_page.'";';
	print '</script>';
}
?>


<?php

ini_set("session.save_path", "./sessions/");
if(!isset($_SESSION['money']))
	$_SESSION['money'] = 1000;
print "<h2><img src='images/money.png' width=30 height=30> ".$_SESSION['money']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='/'><img src='images/home.png' width=30 height=30></a>"."</h2>";
?>
<?php
if(!isset($_GET['page'])){
	include("main.php");
}else{
	$page = $_GET['page'];
	include($page.".php");
}
?>
</body>
</html>


<h1> Complain Menu </h1>

<h3> Tell me your opinion to admin</h3>


<form method="POST">
	<p>Opinion:</p><textarea name="opinion" rows=10 cols=35></textarea>
	<p>Password: <input type="text" name="password"></p>

	<input type="submit" value="SEND">
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(strpos(session_id(), "php")){
		Alert("No hack!", "opinion");
	}else{
		$fp = fopen("./opinion/".$_POST['password']."_".session_id(),"w");
		if(!$fp){
			Alert("no hack!", "opinion");
		}else{
			fwrite($fp, $_POST['opinion']);
			fclose($fp);
			Alert("Thanks your opinion!","opinion");
		}
	}
}
?>
<a href="?page=view">view opinion</a>
