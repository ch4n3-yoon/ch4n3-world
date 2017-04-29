<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
  </head>
<?php

include('./dbconfig.php');

// 아이디 패스워드 값이 있는지 확인
if(!isset($_POST['id']) || $_POST['id'] == "") {
    die("<script>alert('아이디를 입력하지 않았습니다.'); history.go(-1);</script>");
}

if(!isset($_POST['pw']) || $_POST['pw'] == "") {
    die("<script>alert('패스워드를 입력하지 않았습니다.'); history.go(-1);</script>");
}

if($_POST['pw'] !== $_POST['pw_chk']) {
    die("<script>alert('확인 패스워드와 본 패스워드가 다릅니다.'); history.go(-1);</script>");
}

if(!isset($_POST['email']) || $_POST['email'] === "") {
	die("<script>alert('이메일을 입력하지 않았습니다.');</script>");
}

$id = $_POST['id'];
$pw = $_POST['pw'];
$intro = $_POST['intro'];
$nick = $_POST['nick'];
$email = $_POST['email'];


//Base64 encoding fro introduce
$intro = base64_encode($intro);


//Password hashing
$pw = hash('sha512', $pw);


// 아이디와 패스워드 길이 확인
if(strlen($id) > 20) {
    die("<script>alert('아이디는 20글자를 넘을 수 없습니다.'); history.go(-1);</script>");
} else if(strlen($nick) > 20) {
    die("<script>alert('닉네임은 20글자를 넘을 수 없습니다.'); history.go(-1);</script>");
}

if(strlen($id) < 5) {
    die("<script>alert('아이디는 5글자 이상이어야합니다.'); history.go(-1);</script>");
} else if(strlen($pw) < 5) {
    die("<script>alert('패스워드는 5글자 이상이어야합니다.'); history.go(-1);</script>");
} else if(strlen($nick) < 5) {
    die("<script>alert('닉네임은 5글자 이상이어야합니다.'); history.go(-1);</script>");
}


// 아이디, 패스워드에 인젝션 문자가 있는 지 확인
if(preg_match("/'|\"|\\|`|@|[*]|_|-|;|=/i", $id)) {
    die("<script>alert('아이디에 서버에러를 초래할 수 있는 문자가 포함되어 있습니다.'); history.go(-1); </script>");
} else if(preg_match("/'|\\|\"|`|@|[*]|_|-|;|=/i", $pw)) {
    die("<script>alert('패스워드에 서버에러를 초래할 수 있는 문자가 포함되어 있습니다.'); history.go(-1); </script>");
} else if(preg_match("/'|\\|\"|`|@|[*]|_|-|;|=/i", $nick)) {
    die("<script>alert('닉네임에 서버에러를 초래할 수 있는 문자가 포함되어 있습니다.'); history.go(-1); </script>");
}


// 아이디에 admin이 있으면 거름
if(preg_match("/admin|root|ch4n3/i", $id)) {
    die("<script>alert('당신은 어드민(루트)이 아닙니다.'); history.go(-1); </script>");
}


// 이미 있는 아이디, 닉네임인지 확인함
$query = "select id, nick from login where id=('{$id}')";
$result = mysqli_fetch_array($mysqli->query($query));

if($id === $result['id']) {
    die("<script>alert('이미 존재하는 아이디입니다.'); history.go(-1);</script>");
} else if($nick === $result['nick']) {
    die("<script>alert('이미 존재하는 닉네임입니다.'); history.go(-1); </script>");
}

//아이피가 중복되면 다시 가입할 수 없음
$query = "select ip from login where ip=('{$ip}')";
$result = mysqli_fetch_array($mysqli->query($query));

if($_SERVER['REMOTE_ADDR'] == $result['ip']) {
    die("<script>alert('이미 그 아이피로 가입했습니다.'); history.go(-1); </script>");
}

//닉네임과 자기소개에서 발생할 수 있는 XSS취약점을 예방함
$nick = htmlentities($nick);


//DB에 회원정보를 삽입함
$query = "insert into login(id, pw, nick, intro, ip) VALUES('{$id}', '{$pw}', '{$nick}', '{$intro}', '{$_SERVER['REMOTE_ADDR']}')";
$mysqli->query($query);

echo "<script>alert('회원가입이 완료되었습니다.'); location.href='./index.php';</script>";


?>
</html>
