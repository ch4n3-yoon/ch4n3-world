<!DOCTYPE html>
<html style="margin: 0px;" class="no-js mdl-js" lang="en">
<!--<![endif]-->
<?php

// check whether user logged in.
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['nick'])) {
    $login_chk = 1;
} else {
    $login_chk = 0;
}

?>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="naver-site-verification" content="29053d28c1390cd30d83069f669d51609adb83dc"/>

    <title>ch4n3 world</title>

    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-pink.min.css" />
    <link rel="stylesheet" type="text/css" href="maincss.css">
    <link rel="stylesheet" type="text/css" href="maincss_2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="//cdn.jsdelivr.net/velocity/1.2.3/velocity.min.js"></script>

</head>

<body style="overflow-x: hidden !important;">

<div class="backgrounudimagegebabybaby" style="background-image: url('ang.jpg');"></div>
<div class="backgroundoverlay" style="
    background-image: -webkit-linear-gradient(left top, rgba(40, 40, 40, 0.5), rgba(20, 20, 20, 0.5));
    background-position-x: initial;
    background-position-y: initial;
"></div>

<div class="loginrightmenu">

    <div id="dates" class="loginregisterbutton">년 월 일</div>
    <div id="times" class="loginregisterbutton">오전 시 분 초</div>

    <?php

    if ($login_chk == 0) {
        //로그인  안 했을 때 실행되는 코드
        echo '<div id="logina">로그인</div><div id="registera">회원가입</div>';
    } else {
        //로그인 했을 때 실행되는 코드
        echo '<div class="logouta" id="logina"><a href="./logout.php">로그아웃</a></div>';
    }

    ?>


</div>


<div class="fristfloar">
    <div class="logo"></div>
    <div class="main">

        <div class="con">

            <div class="centering" align="center">

                <div class="one demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">User's Page</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        You can edit your account.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="profilebutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            go to my page!
                        </a>
                    </div>
                </div>

                <div class="two demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Probs</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        You can solve the problems.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="challengebutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="./probs.php">
                            Go to solve probs
                        </a>
                    </div>
                </div>
                <div class="three demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Rank</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Hello? Am I a good hacker?
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="rankbutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            I want to configure my rank!
                        </a>
                    </div>
                </div>
                <div  class="four demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Chat</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Chat with other hackers
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="chatbutton mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            go
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">Front Web Designed by 함종현(WP 16)<br>Backend Web Designed by 정윤서(HD 15),
            <a href="http://chaneyoon.tistory.com" style="color: inherit;">윤석찬</a>(HD 16)<br><br>@dimigo</div>
    </div>

</div>
0
<div class="secendfloar">

    <div class="profile">
        <?php

        include("./dbconfig.php");

        // query to mysql
        $query = "SELECT id ,nick, intro,point ,(SELECT COUNT(*) FROM login as t2 WHERE t2.point >= t1.point) rank FROM login t1 WHERE id=('".$_SESSION['id']."') ORDER BY point";

        // load user's info
        $result = mysqli_fetch_array($mysqli->query($query));

        ?>

        <div class="logoup"></div>

        <div class="userpg">

            <div class="pg yourrank">등수 | <?php echo $result['rank'] ?>등 (<?php echo $result['point']?>점)</div>
            <div class="pg yourname">닉네임 | <?php echo $result['nick'] ?></div>
            <div class="pg yourid">아이디 | <?php echo $result['id'] ?></div>

            <div class="pginput mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="pginput2 mdl-textfield__input" type="password" id="USERPAGEPASSWORD" name="userpagepw" placeholder="비밀번호는 원래 비밀번호를 입력해주세요!">
                <label class="pginputitle mdl-textfield__label" id="userpagepasswordtext">비밀번호</label>
            </div>

            <div class="pginput mdl-textfield mdl-js-textfield is-dirty is-upgraded">
                <textarea class="pginput2 mdl-textfield__input" type="text" rows="5" name="introduce" id="introduce"><?php echo base64_decode($result['intro']) ?></textarea>
                <label class="pginputitle mdl-textfield__label" for="content" id="introduce">자기소개</label>
            </div>


        <button type="button" id="changebutton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" >
            <div class="logintitle">변경하기</div>
            <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>

            <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                <div class="backbuttontext">이전으로</div>
                <span class="mdl-button__ripple-container">
                    <span class="mdl-ripple"></span>
                </span>
            </button>
        </div>

    </div>




	 <!-- 현재 문제기능은 제외되어 있습니다-->
	 <!--
    <div class="challenge">
        <div class="logoup"></div>

        <div class="userpb" >
            <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                <div class="backbuttontext">이전으로</div>
                <span class="mdl-button__ripple-container">
                    <span class="mdl-ripple"></span>
                </span>
            </button>
            <div class="pg yourrank">RANK | <?php echo $result['rank'] ?> ( <?php echo $result['point'] ?>p )</div>
            <div class="pg yourname">NICK | <?php echo $_SESSION['nick']; ?></div>
            <br />
            <?php
            //DB에서 문제를 불러오는 코드
            include("./dbconfig.php");
            $query = "SELECT * FROM probs WHERE 1 ORDER BY point ASC";
            $result = $mysqli->query($query);

            $i = 0;
            while ($rows = $result->fetch_array()) {
                $i++;

                $db = new mysqli('localhost', 'ch4n3', 'rudska306', 'ch4n3');
                $db->set_charset('utf8');
                $query = "SELECT id FROM solvers WHERE id=('".$_SESSION['id']."') and no=(".$rows['no'].")";
                $r = mysqli_fetch_array($db->query($query));
                if (isset($r['id'])) {
                    $solved = 1;
                } else {
                    $solved = 0;
                }

                if ($i%4==1) {
                    $su = "one";
                } elseif ($i%4==2) {
                    $su = "two";
                } elseif ($i%4==3) {
                    $su = "three";
                } elseif ($i%4==0) {
                    $su = "four";
                }

                if ($i > 4) {
                    $su .= " shearty";
                }

                //solved people
                $query = "SELECT COUNT(*) AS solvers FROM solvers WHERE no={$rows['no']}";
                $re = mysqli_fetch_array($mysqli->query($query));



                ?>

                <div  class="<?php echo $su; ?> demo-card-square mdl-card mdl-shadow--2dp">

                    <div class="mdl-card__title mdl-card--expand" style="background-color: <?php if ($solved) {
                    echo "#39b544";
                } else {
                    echo "inhert";
                } ?>">
                    <h2 class="mdl-card__title-text"><?php echo $rows['prob'] ?></h2>
                </div>
                <div class="mdl-card__supporting-text">
                    Solvers : <?php echo $re['solvers']; ?> (First blood :
                    <?php

                    $query = "SELECT nick, date FROM `solvers` WHERE no={$rows['no']} ORDER BY date ASC LIMIT 1";
                    $re = mysqli_fetch_array($mysqli->query($query));
                    echo $re['nick'];

                    ?>)
                </div>

                <span id="tt<?php echo $i ?>" class="ang mdl-chip mdl-chip--contact">
                    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">by</span>
                    <span class="mdl-chip__text"><?php echo $rows['author'] ?></span>
                        <div class="mdl-tooltip mdl-tooltip--large" for="tt<?php echo $i ?>">
                            <?php echo $rows['category']; ?> | <?php echo $rows['point']; ?>pt
                        </div>
                    </span>

                    <div class="mdl-card__actions mdl-card--border" align="center">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="./problem.php?no=<?php echo $rows['no']; ?>">
                            <?php
                            if ($solved) {
                                echo "Already Solved";
                            } else {
                                echo "go";
                            } ?>
                        </a>
                    </div>
                </div>
            <?php

            } ?>

        </div>

        <button id="backbutton" style="right: 0; z-index: 9999; position: fixed; margin-top: 50px; margin-bottom: 50px;" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
            <div class="backbuttontext">이전으로</div>
            <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
    </div>
	-->
    <div class="rank">
        <?php
        //ranking system with mysql + php.
        include('./dbconfig.php');  //include mysqli

        //logged in user's ranking
        $query = "SELECT point ,(SELECT COUNT(*) FROM login as t2 WHERE t2.point >= t1.point) rank FROM login t1 WHERE id=('".$_SESSION['id']."') ORDER BY point";
        $result = mysqli_fetch_array($mysqli->query($query));
        $rank = $result['rank'];
        $point = $result['point'];



        ?>

        <div class="logoup"></div>
        <div class="userrk">

                <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                    <div class="backbuttontext">이전으로</div>
                    <span class="mdl-button__ripple-container">
                        <span class="mdl-ripple"></span>
                    </span>
                </button>

                <div class="pg yourrank">RANK | <?php echo $rank; ?> (<?php echo $point; ?>p)</div>
                <div class="pg yourname">닉네임 | <?php echo $_SESSION['nick']; ?></div>

                <?php
                $query = "SELECT SUM(point) as max FROM probs WHERE 1";
                $result = mysqli_fetch_array($mysqli->query($query));
                $maxPoint = $result['max'];

                $query = "SELECT * FROM login WHERE 1 ORDER BY point DESC"; //query to rank users
                $result = $mysqli->query($query);

                while ($rows = $result->fetch_array()) {

                    if($rows['point'] >= $maxPoint) {
                        $allClear = 1;
                    } else {
                        $allClear = 0;
                    }

                    $query = "SELECT (SELECT COUNT(*)+1 FROM login as t2 WHERE t2.point > t1.point) rank FROM login t1 WHERE id=('{$rows['id']}') ORDER BY point";
                    $r = mysqli_fetch_array($mysqli->query($query)); ?>

                    <div class="squaredesign">
                        <div align="center" class="rankcontent">
                            <?php echo $r['rank'] ?>위 - <?php echo $rows['nick'] ?>
                            (<?php
                            if($allClear) {
                                echo "All Cleared!";
                            } else {
                                echo $rows['point'] . "p";
                            }
                            ?>)
                            <p style="font-size: 12pt; margin: 0 auto;" align="center"><?php echo htmlentities(base64_decode($rows['intro'])); ?></p>
                        </div>

                    </div>
                <?php } ?>
                <div class="squaredesign">
                    <div align="center" class="rankcontent">
                        1위 - 키드
                    </div>
                </div>

                <div class="squaredesign">
                    <div align="center" class="rankcontent">
                        2위 - 윤석찬(ch4n3 - administrator)
                        <p align="center" style="font-size: 12pt;">
                            total
                            <?php
                            $query = "SELECT COUNT(*) as users FROM login WHERE 1";
                            $result = mysqli_fetch_array($mysqli->query($query));
                            echo $result['users'];
                            ?> users in here!
                        </p>
                    </div>
                </div>

                <button id="backbutton" style="margin-top: 50px; margin-bottom: 50px;" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
                    <div class="backbuttontext">이전으로</div>
                    <span class="mdl-button__ripple-container">
                        <span class="mdl-ripple"></span>
                    </span>
                </button>

                </div>



        </div>

        <div class="chat">

       <div class="logoup"></div>

       <div class="userct">

           <button id="backbutton" type="button" class="backbutton mdl-button mdl-js-button mdl-js-ripple-effect">
               <div class="backbuttontext">이전으로</div>
               <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>

           <div class="pg yourrank">RANK | <?php echo $rank ?> (<?php echo $point ?>p)</div>
           <div class="pg yourname">닉네임 | <?php echo $_SESSION['nick'] ?></div>

               <div class="chatbox" scrolling="yes">
                   <?php
                   // load chats from mysql DB
                   $query = "SELECT * FROM (SELECT * FROM chat ORDER BY date DESC LIMIT 30) as t ORDER BY date ASC";
                   $result = $mysqli->query($query);

                   while ($rows = $result->fetch_array()) {
                       ?>

                       <li class="mdl-list__item">
                           <span class="mdl-list__item-primary-content">
                               <i class="material-icons mdl-list__item-icon"></i>
                                <?php
                                $date = $rows['date'];
                                $date = explode(" ", $date);
                                echo $date[0]; ?> | <?php echo $rows['nick'] ?> : <?php echo htmlentities($rows['text']); ?>
                           </span>
                       </li>

                   <?php } ?>


                <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <marquee>[System] : 바르고 고운말ㅎㅎ</marquee>
                    </span>
                </li>

        </div>

           <div class="chating mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
               <input class="pginput2 mdl-textfield__input" type="text" id="CHATING" name="CHATING" onKeyDown="onKeyDown();">
               <label class="pginputitle mdl-textfield__label" id="CHATINGTEXT">메시지</label>
           </div>

           <button id="sendbutton" type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
               <div class="logintitle">SEND</div>
               <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
           </button>


       </div>

   </div>
</div>



<div class="backblur">

</div>

<div class="alertbox">

    <div class="Login">

        <div class="toptitle"></div>

        <div class="toptitle2">LOGIN</div>

        <form action="/login_chk.php" name="LOGINFORM" method="POST" id="LOGINFORM">

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" onkeyup="inputKeyUp(event)"  type="text" id="LOGINID" name="id">
                <label class="logintitle mdl-textfield__label" id="idtext">ID</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input sendText" type="password" id="LOGINPASSWORD" name="pw">
                <label class="logintitle mdl-textfield__label" id="passwordtext">PASSWORD</label>
            </div>

            <!--
                비밀번호 찾기 기능은 제한됩니다.
                <button class="mdl-button mdl-js-button mdl-button--primary">
                    FORGETTING PASSWORD
                </button>
            -->

            <button style="float:right;" type="button" id="loginbutton" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                <div class="logintitle">LOGIN</div>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
            </button>
        </form>
        <div id="result">

        </div>
    </div>

    <div class="Register">

        <div class="toptitle"></div>

        <div class="toptitle2">REGISTER</div>

        <form action="/join_chk.php" name="REGISTERFORM" method="POST" id="REGISTERFORM">

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="NAME" name="nick">
                <label id="regnametxt" class="logintitle mdl-textfield__label">NICKNAME</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="ID" name="id">
                <label id="regidtext" class="logintitle mdl-textfield__label">ID</label>
            </div>

				<div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="ID" name="email">
                <label id="regidtext" class="logintitle mdl-textfield__label">E-mail</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="password" autocomplete="off" id="PASSWORD" name="pw">
                <label id="regpasswordtext" class="logintitle mdl-textfield__label">PASSWORD</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="password" autocomplete="off" id="PASSWORD2" name="pw_chk">
                <label id="regrepasswordtext" class="logintitle mdl-textfield__label">PASSWORD CHECK</label>
            </div>

            <div class="accounttext mdl-textfield mdl-js-textfield mdl-textfield--floating-label is-upgraded">
                <input class="mdl-textfield__input" type="text" autocomplete="off" id="INTRODUCE" name="intro">
                <label id="regemailtext" class="logintitle mdl-textfield__label">INTRODUCE</label>
            </div>

            <button id="registerbutton" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                <div class="logintitle">REGISTER</div>
                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
            </button>

        </form>

    </div>

</div>

<script>

var $height = $(".main").css("height");

$.gofirst = function() {

    $('.secendfloar').css({"display" : "block", "margin-top" : $height});
    $('html, body').css("overflow", "hidden");

    $('body,html').animate({

        scrollTop: $height

    }, 1500, "swing", function() {

        $('html, body').scrollTop(0);
        $('.secendfloar').css("margin-top", "0px");
        $('html, body').css("overflow", "auto");
        $('.fristfloar').css("display", "none");

    });

}

$.gosecond = function() {

    $('.fristfloar').css("display", "block");
    $('html, body').css("overflow", "hidden");
    $('.secendfloar').css("margin-top", $height);
    $('html, body').scrollTop(parseInt($height.replace("px", "")));

    $('body,html').animate({

        scrollTop: 0

    }, 1500, "swing", function() {

        $('html, body').scrollTop(0);
        $('html, body').css("overflow", "auto");
        $('.secendfloar').css("display", "none");

    });

}

$(".profilebutton").click(function() {
    $(".challenge").css("display", "none");
    $(".rank").css("display", "none");
    $(".chat").css("display", "none");
    $(".profile").css("display", "inherit");
    $.gofirst();
});

$(".challengebutton").click(function() {
    $(".challenge").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".chat").css("display", "none");
    $(".rank").css("display", "none");
    $.gofirst();
});

$(".rankbutton").click(function() {
    $(".rank").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".chat").css("display", "none");
    $(".challenge").css("display", "none");
    $.gofirst();
});

$(".chatbutton").click(function() {
    $(".chat").css("display", "inherit");
    $(".profile").css("display", "none");
    $(".rank").css("display", "none");
    $(".challenge").css("display", "none");
    setInterval(function(){$('.chatbox').load('chat_load.php');}, 2000);
    $.gofirst();
});

$(".backbutton").click(function() {
    $.gosecond();
});

$.realtimes = function() {

    var servertimes = new Date();

    servertimes.setMonth(servertimes.getMonth());

    var AMPM;

    if(servertimes.getHours() > 12) {
        AMPM = "오후 ";

        servertimes.setHours(servertimes.getHours() - 12);



    } else {
        AMPM = "오전 ";
        if(servertimes.getHours() == 0) {

            servertimes.setHours(servertimes.getHours() + 12);

        }
    }
    var tmpMonth = servertimes.getMonth() + 1;
    $("#dates").text(servertimes.getFullYear() + "년 " + tmpMonth + "월 " + servertimes.getDate() + "일");
    $("#times").text(AMPM + servertimes.getHours() + "시 " + servertimes.getMinutes() + "분 " + servertimes.getSeconds() + "초");

}


$("#logina").click(function() {

    $(".backblur").css("display", "block");
    $(".backblur").animate({ "opacity": "1" }, 500);
    $(".Login").css("display", "block");
    $(".Register").css("display", "none");
    $(".alertbox").css({"display" : "block", "height" : "400px", "margin-top" : "-100px"});
    $(".alertbox").animate({ 'marginTop': '-200px',  "opacity": "1" }, 300);

});

$("#registera").click(function() {

    $(".backblur").css("display", "block");
    $(".backblur").animate({ "opacity": "1" }, 500);
    $(".Register").css("display", "block");
    $(".Login").css("display", "none");
    $(".alertbox").css({"display" : "block", "height" : "550px", "margin-top" : "-75px"});
    $(".alertbox").animate({ 'marginTop': '-275px',  "opacity": "1" }, 300);

});

$(".backblur").click(function() {
    $(".backblur").animate({ "opacity": "0" }, 500);
    $(".backblur").promise().done(function(){
        $(".backblur").css("display", "none");
    });
    $(".alertbox").animate({ 'marginTop': '-100px',  "opacity": "0" }, 300);
    $(".backblur").promise().done(function(){
        $(".alertbox").css("display", "none");
    });
});

$(window).resize(function() {
    $height = $(".main").css("height");
});

$(document).ready(function() {

    setInterval('$.realtimes()', 1000);

});

// ch4n3 로그인 및 로그인 확인 코드

$("#loginbutton").click(function() {
    var data = "id="+$('#LOGINID').val()+"&pw="+$('#LOGINPASSWORD').val();
    $.ajax({
        type: "POST",
        url: "./login_chk.php",
        data: data,
        success: function(data) {
            $('#logina').html(data);
        },
        dataType: NaN
    });
});

$(".logouta").click(function() {
    $.ajax({
        type: "POST",
        url: "./logout.php",
        data: Nan,
        success: function(data) {
            $('.logouta').html(data);
        },
        dataType: NaN
    });
});


$('#userpg').click(function() {
    <?php
    //유저 페이지 오기 전에 로그인했는지 확인
    if (!$login_chk) {
        ?>
        <!-- 로그인하지 않았을 경우 다시 메인페이지로 접속함 -->
        alert('login plz..');
        location.href = './';
    <?php

    } ?>
    });

$('#changebutton').click(function() {
    var data = "pw="+$('#USERPAGEPASSWORD').val()+"&intro="+$('#introduce').val();
    $.ajax({
        type: "POST",
        url: "./edit.php",
        data: data,
        success: function(data) {
            $('.userpg').html(data);
        },
        dataType: NaN
    });
});

$(document).ready(function() {

    setInterval('$.realtimes()', 1000);


});

$chatsend = function(data) {
    $.ajax({
        type: "POST",
        url: "./chat.php",
        data: data,
        success: function(data) {
            $('.chatbox').load('chat_load.php');
            $('#CHATING').val() = "";
        },
        dataType: NaN
    });
};

$('#sendbutton').click(function() {
    var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
    $chatsend(data);
    $('#CHATING').val("");
});

function onKeyDown() {
    if(event.keyCode == 13) {
         var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
         $chatsend(data);
         $('#CHATING').val("");
    }
}

function inputKeyUp(e) {
    e.which = e.which || e.keyCode;
    if(e.which == 13) {
        var data = "nick=<?php echo $_SESSION['nick'] ?>&text="+$('#CHATING').val();
        $chatsend(data);
    }
}


</script>

</body>
</html>
