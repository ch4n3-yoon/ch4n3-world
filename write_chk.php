<?php

session_start();

// 값의 유무 확인
if(!isset($_POST['probName'])) {
	die("<script>alert('probName was not defined.'); history.back(-1);</script>");
} else if(!isset($_POST['author'])) {
	// 출제자 명이 없다면 세션에 있는 닉네임으로 대체
	$_POST['author'] = $_SESSION['nick'];
} else if(!isset($_POST['prob'])) {
	die("<script>alert('prob was not defined.'); history.back(-1);</script>");
} else if(!isset($_POST['writeUp'])) {
	die("<script>alert('writeUp was not defined.'); history.back(-1);</script>");
} else if(!isset($_POST['flag'])) {
	die("<script>alert('flag was not defined.'); history.back(-1);</script>");
}

$_POST['probName'] = mysqli_real_escape_string($_POST['probName']);
if(preg_match("/\'|\"|or|and|\||\&/i", $_POST['author'])) {
	exit("<script>alert('Query Error.. senderName 칼럼에서 오류가 났습니다.'); location.href='./write.php';</script>");
}


include('./dbconfig.php');

$query = "INSERT INTO sendProb(probName, probCont, writeUp, field, author, date) VALUES('{$_POST['probName']}'";
$query .= ", '{$_POST['prob']}', '{$_POST['writeUp']}', '{$_POST['flag']}', NOW())";

// Send Query, 관리자가 볼 수 있는 문제 출제 현황 탭에 보낸다.
$result = $mysqli->query($query);
exit("<script>location.href='./write.php';</script>");

?>
