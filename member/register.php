<?php
require __DIR__ . "/common/dbconn.php";
$pageTitle = "회원가입";
include __DIR__ . "/common/head.php";
?>

<head>
    <title>회원 가입</title>
</head>


    <script>
        function ck(){
            if(document.mform.user_id.value == ""){
                alert('아이디를 입력하세요.');
                mform.user_id.focus();
                return false;
            }

            // if(document.mform.user_id.value.length < 4 || document.mform.user_id.value.length > 12){
            //     alert('아이디는 4~12자여야 합니다.');
            //     mform.user_id.focus();
            //     return false;
            // }

            // if(document.mform.name.value == ""){
            //     alert('이름을 입력하세요.');
            //     mform.name.focus();
            //     return false;
            // }

            // var en1=/[^(a-zA-Z0-9)]/;
            // if(en1.test(document.mform.user_id.value)){
            //     alert('아이디는 영문, 숫자만 가능합니다.');
            //     user_id.focus();
            //     return
            // }

            // if(document.mform.user_pw1.value == ""){
            //     alert('비밀번호를 입력하세요.');
            //     mform.user_pw1.focus();
            //     return false;
            // }

            // if(document.mform.user_pw1.value.length < 6 || document.mform.user_pw1.value.length > 20){
            //     alert('비밀번호는 6~20자여야 합니다.');
            //     mform.user_pw1.focus();
            //     return false;
            // }

            // var en2=/[^(a-zA-Z0-9!@#$%^&*)]/;
            // if(en2.test(document.mform.user_pw1.value)){
            //     alert('비밀번호는 영문, 숫자 또는 특수기호만 가능합니다.');
            //     mform.user_pw1.focus();
            //     return
            // }

            if(document.mform.user_pw2.value == ""){
                alert('비밀번호 확인을 입력하세요.');
                mform.user_pw2.focus();
                return false;
            }

            if(document.mform.user_pw1.value != document.mform.user_pw2.value){
                alert('비밀번호가 일치하지 않습니다.');
                mform.user_pw1.focus();
                return false;
            }


            document.mform.submit();
        }
    </script>


<body>
    <!-- <iframe src="common/head.php" id="bodyFrame" name="body" width="100%" frameborder="0"></iframe> -->

    <div id="register_contents" class="contents">
        <form name="mform" method="post" action="/member/register_ok.php">
            <table width="550" cellpadding="3" class="grayColor">
                <tr>
                    <th colspan="2" style="background-color:#323232">
                        <font style="color:white; font-size:150%;">회 원 등 록</font>
                    </th>
                </tr>

                <tr>
                    <th>*ID</th>
                    <td>
                        <input type="text" name="user_id" maxlength="12" size="15">
                        <font style="color:red;">4~12(영문/숫자)</font>
                    </td>
                </tr>

                <tr>
                    <th>*이름</th>
                    <td><input type="text" name="name" size="15"></td>
                </tr>

                <tr>
                    <th>*비밀번호</th>
                    <td>
                        <input type="password" name="user_pw1" maxlength="20" size="20">
                        <font style="color:red;">6~20(영문/숫자/특수문자)</font>
                    </td>
                </tr>

                <tr>
                    <th>*비밀번호 확인</th>
                    <td><input type="password" name="user_pw2" maxlength="20" size="20"></td>
                </tr>

                <tr>
                    <th>나이</th>
                    <td><input type="number" name="age" min="0" max="150"></td>
                </tr>

                <tr>
                    <th>연락처</th>
                    <td><input type="number" name="phone" maxlength="11"></td>
                </tr>


                <tr>
                    <th>EMAIL</th>
                    <td><input type="text" name="email" size="30"></td>
                </tr>
            </table>

            <p>
                <font size="2">* 는 필수 입력 항목입니다.</font><br><br>

                <input type="button" value="등록" onclick="ck()" class="btn_default btn_gray">
                <input type="reset" value="삭제" class="btn_default btn_gray">
            </p>
        </form>
    </div>
</body>
<?php include __DIR__ . "/common/footer.php"; ?>



