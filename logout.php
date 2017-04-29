<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>LOG OUT</title>
        <script>
            alert('로그아웃 되었습니다.');
            history.go(-1);
        </script>
    </head>
</html>
