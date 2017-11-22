<?php


/* Some Library for ch4n3 world */


/* The alerting function */
function alert($msg)
{
	$msg = str_replace("'", "\'", $msg);
	echo "<script> alert('{$msg}'); </script>";
}



/* location.href= 를 이용한 클라이언트 위치 변경 함수 */
function go($path)
{
	/* path 값이 -1 이라면 이전 화면으로 돌아감 */
	if ($path == -1)
		echo "<script> history.back(); </script>";

	else
	{
		$path = str_replace("'", "\'", $path);
		echo "<script> location.href='$path' </script>";
	}
}


/* XSS 취약점 block 함수 */
function xss($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}


?>