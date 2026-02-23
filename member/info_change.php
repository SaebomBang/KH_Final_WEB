<?php
session_start();
require "common/dbconn.php";

// if($_SERVER["HTTP_REFERER"] != "http://192.168.50.123/member/member_info.php"){
//     echo "<script>
//     alert('잘못된 요청입니다.');
//     history.back();
//     </script>";
//     exit();
// }

if($_POST["token"] != $_SESSION["token"]){
   echo "<script>
    alert('잘못된 요청입니다.');
    history.back();
    </script>";
    $_SESSION["token"]="";
    exit();
} else {
    $_SESSION["token"]="";
}

$pw1 = $_POST["user_pw1"];
$pw2 = $_POST["user_pw2"];
$age = $_POST["age"];
$phone = $_POST["phone"];
$email = $_POST["email"];



if (!$pw1 || !$pw2) {
    echo "<script>
        alert('비밀번호가 입력되지 않았습니다.');
        history.back();
    </script>";
    exit();
} else if ($pw1 != $pw2) {
    echo "<script>
        alert('비밀번호가 다릅니다.');
        history.back();
    </script>";
    exit();
} else {
    $strSQL = "UPDATE member SET u_pass='$pw1', ";
    //php에서 .= 두개의 값을 붙여줌
    //ex) $a=1; $b=2; $c=$a.$b; ->($c=12)
    if ($age)
        $strSQL .= "age=$age, ";
    if ($phone)
        $strSQL .= "nickname='$phone' ";
    if ($email)
        $strSQL .= ", email='$email' ";

    $strSQL .= " WHERE id='$_SESSION[user_id]'";

    $rs = mysqli_query($conn, $strSQL);
    // echo $strSQL;
    // echo $_SESSION[user_id];
    if ($rs) {
        $_SESSION["nickname"] = $nick;
        header("Location:info.php?ch=1");
    } else {
        header("Location:info.php?ch=1");
    }
}
?>