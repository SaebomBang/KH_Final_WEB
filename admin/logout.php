<?php
session_start();
if (!$_SESSION["user_id"]) {
    echo "<script>
        alert('잘못된 요청입니다.');
        history.back();
        </script>";
} else {
    session_destroy();
    session_regenerate_id();

    echo "<script>
        alert('로그아웃 되었습니다.');
        location.replace('../index.php');

    </script>";
}
?>