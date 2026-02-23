<?php
session_start(); // 
require __DIR__ . "/common/dbconn.php";

$id = trim($_POST["id"] ?? "");
$pw = trim($_POST["pass"] ?? ""); 

if ($id === "" || $pw === "") {
    header("Location: /member/login.php?err=1");
    exit;
}


$strSQL = "SELECT * FROM member WHERE id='" . $id . "' AND pw='" . $pw . "'";
$rs = mysqli_query($conn, $strSQL);
$rs_arr = mysqli_fetch_array($rs);

// 2. DB 컬럼명에 맞춰서 짝 맞추기 (u_id -> id, u_pass -> pw)
// if($rs_arr) {
if($rs_arr && ($rs_arr["id"] == $id) && ($rs_arr["pw"] == $pw)){
    $_SESSION["user_id"] = $rs_arr["id"];     
    $_SESSION["user_name"] = $rs_arr["name"]; 
    $_SESSION["log_ip"] = $_SERVER["REMOTE_ADDR"];

    echo "<script>
        alert('로그인 성공 했습니다.');
        location.replace('/member/index.php');
    </script>";
} else {
    echo "<script>
        alert('아이디 또는 비밀번호가 일치하지 않습니다.');
        history.back();
    </script>";
}
?>