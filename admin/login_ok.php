<?php
session_start();

$id = $_POST["id"];
$pw = $_POST["pass"];
require "./common/dbconn.php";

$strSQL = "SELECT * FROM member WHERE id='" . $id . "' AND pass='" . $pw . "'";
$rs = mysqli_query($conn, $strSQL);
$rs_arr = mysqli_fetch_array($rs);

if ($rs_arr) {
        $_SESSION["user"] = $rs_arr["id"]; 
        $_SESSION["name"] = $rs_arr["name"];

    echo "<script>
        alert('로그인 성공 했습니다.');
        location.replace('index.php');
    </script>";
} else {
    echo "<script>
        alert('로그인 실패 했습니다.');
        history.back();
        </script>";
}
?>