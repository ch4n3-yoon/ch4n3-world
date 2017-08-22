<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
	</head>
<?php

session_start();

include("./dbconfig.php");

if( !isset($_POST['id']) || !isset($_POST['pw']))
{
    die("<script>alert('I think ID or Password is empty.'); history.go(-1);</script>");
}


/* prevent SQLi */
$id = addslashes( $_POST['id'] );
$pw = $_POST['pw'];


/* hash the password */
$pw = hash('sha512', $pw);


/* just block user login with admin */
if(preg_match("/admin/i", $id)){
    die("<script>alert('You are not admin ㅋㅋㅋ'); history.go(-1);</script>");
}


if( isset($id[20]) )
{
    die("<script> alert('Your ID is too long.'); history.go(-1); </script>");
}


$query = "SELECT * FROM login WHERE id=TRIM('{$id}') and pw=('{$pw}')";
$result = mysqli_fetch_array($mysqli->query($query));


/* user exists */
if( isset($result['nick']) )
{
    $_SESSION['id'] = $result['id'];
    $_SESSION['nick'] = $result['nick'];

    die("<script>alert('{$_SESSION['nick']}님 안녕하세요!'); location.href='./index.php';</script>");

}

/* user doesn't exist */
else
{
    die("<script>alert('ID or Password is not correct..'); location.href='./index.php';</script>");
}

?>

<script>
    location.href='./index.php';
</script>

</html>
