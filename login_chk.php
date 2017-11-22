<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
  </head>
<?php
session_start();
include("./dbconfig.php");

if(isset($_POST['id'])==0 || isset($_POST['pw'])==0) {
    die("<script>alert('아이디와 비밀번호를 모두 입력해주세요.'); history.go(-1);</script>");
}

$id = $_POST['id'];
$pw = $_POST['pw'];

//Password hashing
$pw = hash('sha512', $pw);

if(preg_match("/admin/i", $id)){
    die("<script>alert('음.. 당신이 어드민은 아닌 것 같아요.'); history.go(-1);</script>");
}

if(preg_match("/'|\"|`|\\| /i", $id)) {
    die("<script>alert('서버에 장애를 초래할 수 있는 문자가 포함되어 있습니다.'); history.go(-1);</script>");
} else if(preg_match("/'|\"|`|\\| /i", $pw)) {
    die("<script>alert('서버에 장애를 초래할 수 있는 문자가 포함되어 있습니다.'); history.go(-1);</script>");
}

if(strlen($id)>20) {
    die("<script>alert('입력된 값이 비정상적으로 깁니다.'); history.go(-1);</script>");
}

$id = addslashes($id);

$query = "SELECT * from login where id=trim('{$id}') and pw=('{$pw}')";
$result = mysqli_fetch_array($mysqli->query($query));

if(isset($result['nick'])) {
    $_SESSION['id'] = $result['id'];
    $_SESSION['nick'] = $result['nick'];

    die("<script>alert('{$_SESSION['nick']}님 안녕하세요!'); location.href='./index.php';</script>");

} else {
    die("<script>alert('ID or Password is not correct..'); location.href='./index.php';</script>");
}

?>
<script>
    location.href='./login_chk.php';
</script>

</html>
