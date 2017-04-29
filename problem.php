<?php
include("./dbconfig.php");
session_start();


if(!isset($_SESSION['nick'])) {
    die("login plz..");         //로그인 했는지 확인함
} else if(!isset($_GET['no']) || $_GET['no']=="") {
    die("query error..");       //no에 올바른 값이 제대로 넘어왔는지 확인함
} else if(preg_match("/#|-|_|;|\n| |\t/", $_GET['no'])) {
    die("no hack ~_~");         //no에 hackable 단어가 있으면 die함
}


//no가 DB에 없는 값이면 뒤로가기
$no = $_GET['no'];
$query = "SELECT no FROM probs ORDER BY no DESC LIMIT 1";
$result = mysqli_fetch_array($mysqli->query($query));

if ($no > $result['no']) {
    die("<script>history.go(-1);</script>");
}

//문제 정보를 불러오는 코드
$query = "select * from probs where no=(({$no}))";
$result = @mysqli_fetch_array($mysqli->query($query));


$prob = $result['prob'];            //문제명
$point = $result['point'];          //점수
$author = $result['author'];        //문제 만든이
$category = $result['category'];    //문제 카테고리
$text =  $result['text'];           //문제 부가설명
$flag = $result['flag'];            //플래그


// 플래그 인증 부분
if (isset($_POST['flag'])) {
    if ($_POST['flag']===$flag) {
        $query = "select * from solvers where id=('{$_SESSION['id']}') and no=({$no})";
        $result = @mysqli_fetch_array($mysqli->query($query));
        if (isset($result['id'])) {
            die("Already solved (date : {$result['date']})");
        }

        //푼 사용자의 점수를 올려주는 쿼리
        $query = "update login set point=point+{$point} where id=('{$_SESSION['id']}')";
        $result = $mysqli->query($query);

        //푼 사용자의 정보를 DB에 저장함
        $query = "insert into solvers(no, id, nick, date) values({$no}, '{$_SESSION['id']}', '{$_SESSION['nick']}', now())";
        $mysqli->query($query);

        die("Congratulation! You've got {$point} p!");
    }


    //플래그가 틀렸을 때 나오는 코드
    die("Wrong flag.. Try again");

}
//플래그 검사 끝


?>
