<?php

require __DIR__ . "/common/dbconn.php";
$pageTitle = "회원정보";
include __DIR__ . "/common/head.php";

$userId = $_SESSION['user_id'] ?? '';
$strSQL = "SELECT * FROM member WHERE id='$userId'";
$rs = mysqli_query($conn, $strSQL);
$rs_arr = mysqli_fetch_array($rs);

// include_once("../random.php");
// $_SESSION["token"] = G_str(20);
?>

<script>
    function ck(){
        var en = /[^a-zA-Z0-9!@?#%^&*]/; 
        if(en.test(document.mform.user_pw1.value)){
            alert('영문과 숫자, 특수기호만 허용합니다.');
            document.mform.user_pw1.focus();
            return false;
        }
        if(document.mform.user_pw1.value =="" || document.mform.user_pw1.value.length < 6 || document.mform.user_pw1.value.length > 20 ){
            alert('비밀번호를 6~20자로 입력하세요.');
            document.mform.user_pw1.focus();
            return false;
        }
        if(document.mform.user_pw1.value != document.mform.user_pw2.value){
            alert('비밀번호가 일치하지 않습니다.');
            document.mform.user_pw2.focus();
            return false;
        }
        document.mform.submit();
    }
</script>

<div id="info_contents" class="contents">
    <?php
    if(isset($_GET["ch"])){
        if($_GET["ch"] == 1) echo "<h3 style='color:blue;'>성공적으로 변경되었습니다.</h3>";
        else if($_GET["ch"] == 2) echo "<h3 style='color:red;'>변경이 실패하였습니다.</h3>";
    }
    ?>

    <form name="mform" method="post" action="info_change.php">
        <table width="500" cellpadding="3" class="grayColor">
            <tr>
                <th colspan="2" style="background-color: #323232; color: white; font-size: 150%;">회 원 정 보</th>
            </tr>
            <tr>
                <th width="120px">*ID</th>
                <td><?=$rs_arr["id"]?></td> </tr>
            <tr>
                <th>*이 름</th>
                <td><?=$rs_arr["name"]?></td> </tr>
            <tr>
                <th>*비밀번호</th>
                <td>
                    <input type="password" name="user_pw1" size="20" maxlength="20">
                    <br><font style="color:red; font-size:0.8em;">6~20(영문/숫자/특수문자)</font>
                </td>
            </tr>
            <tr>
                <th>*비밀번호 확인</th>
                <td><input type="password" name="user_pw2" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <th>나이</th>
                <td><input type="number" name="age" value="<?=$rs_arr["age"]?>"></td>
            </tr>
            <tr>
                <th>연락처</th>
                <td><input type="text" name="phone" maxlength="11" value="<?=$rs_arr["phone"]?>"></td>
            </tr>
            <tr>
                <th>EMAIL</th>
                <td><input type="text" name="email" value="<?=$rs_arr["email"]?>"></td>
            </tr>
        </table>
        <p>
            <font size=2>* 는 필수 입력 항목입니다.</font><br /><br />
            <!-- <input type="hidden" value="<?=$_SESSION["token"];?>" name="token"> -->
            <input type="button" onclick="ck()" value="수정" class="btn_default btn_gray">
            <input type="reset" value="취소" class="btn_default btn_gray">
        </p>
    </form>
</div>

<!-- <?php include __DIR__ . "/common/footer.php"; ?> -->