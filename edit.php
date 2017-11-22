<?php

session_start();

if (!isset($_POST['intro']) && !isset($_POST['pw'])) {
    die("<script>alert('입력값이 없습니다.'); location.href='./';</script>");
}

include("./dbconfig.php");
$intro = $_POST['intro'];
$intro = base64_encode($intro);

$id = $_SESSION['id'];
$pw = $_POST['pw'];
$pw = hash('sha512', $pw);

$query = "SELECT id FROM login WHERE pw=('{$pw}')";
$result = mysqli_fetch_array($mysqli->query($query));

if ($result['id'] !== $id) {
    die("<script>alert('비밀번호가 틀립니다. '); location.href='./index.php';</script>");
}

$query = "UPDATE login SET intro='{$intro}' WHERE pw=('{$pw}')";
$mysqli->query($query);

echo "<script>alert('자기소개가 수정되었습니다.'); location.href='./index.php';</script>";
