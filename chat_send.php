<?php

session_start();

if(!isset($_SESSION['nick'])) {
    die("<script>alert('login plz'); location.href='./'</script>");
}

include('./dbconfig.php');

if(isset($_POST['text']) && isset($_POST['nick'])) {
    if(preg_match("/\)|\(|\'|\"|\\|\#|-|_|;|\n|\t/i", $_POST['text'])) {
        die("<script>alert('no hack ~_~'); location.href='./chat.php';</script>");
    } else if(strlen($_POST['text'])>100) {
        die("<script>alert('no more than 100'); location.href='./chat.php';</script>");
    } else if($_POST['text'] == " " && $_POST['text'] == "") {
        die("<script>alert('No whitespace only'); location.href='./chat.php';</script>");
    }

    $_POST['text'] = preg_replace("/ㅅㅂ|시발|씨발|시1발|ㅆㅂ/", "[안좋은말]", $_POST['text']);
    $_POST['text'] = preg_replace("/ㅄ|ㅂㅅ|병신|븅신|빙신|비융신/", "[나쁜말]",$_POST['text']);
    $_POST['text'] = preg_replace("/fuck|bitch|bullshit|damn|fucker/i", "[영어로하는나쁜말]",$_POST['text']);
    $_POST['text'] = preg_replace("/윤석찬|석찬/", "송중기, 공유보다 잘생긴 사람",$_POST['text']);

    $query = "INSERT INTO chat(nick, text, date) VALUES('{$_SESSION['nick']}', ((((('{$_POST['text']}'))))), NOW())";
    $mysqli->query($query);
}

?>