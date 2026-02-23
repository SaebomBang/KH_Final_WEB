<?php
// 1. 세션 시작은 항상 최상단에
ini_set('session.cookie_httponly', 0);

session_start();
require "common/dbconn.php";

// 2. 변수 받기 (SQL문의 컬럼명과 변수명을 가급적 통일하는게 안 헷갈립니다)
$r_no       = $_POST["room"];
$check_in   = $_POST["checkin"];
$check_out  = $_POST["checkout"];
$m_name     = $_POST["name"];
$email      = $_POST["email"];
$phone      = $_POST["phone"];
$m_count    = $_POST["m_count"]; 
$stay_days  = $_POST["days"];
$total_price = $_POST["total"];
$id         = $_SESSION["user_id"] ?? ''; // 세션 없을 경우 대비
$requests   = $_POST["requests"]; 

// 3. 유효성 검사
if($check_in == "" || $check_out == "") {
    echo "<script>alert('날짜를 선택해주세요.'); history.back();</script>";
    exit();
}
if($m_name == ""){
    echo "<script>alert('이름을 입력해주세요.'); history.back();</script>";
    exit();
}
if($email == ""){
    echo "<script>alert('이메일을 입력해주세요.'); history.back();</script>";
    exit();
}
if($phone == ""){
    echo "<script>alert('연락처를 입력해주세요.'); history.back();</script>";
    exit();
}
if($m_count == ""){
    echo "<script>alert('숙박인원을 입력해주세요.'); history.back();</script>";
    exit();
}

// 4. SQL문 (변수명을 위에서 정의한 것과 일치시켰습니다)
// res_no가 자동증가(AI)라면 0 대신 NULL을 넣거나 컬럼 목록에서 빼는 것이 좋습니다.
$sql = "INSERT INTO reservation (
            res_no, r_no, id, m_name, check_in, check_out, 
            stay_days, m_count, total_price, requests, status, created_at
        ) VALUES (
            NULL, '$r_no', '$id', '$m_name', '$check_in', '$check_out', 
            '$stay_days', '$m_count', '$total_price', '$requests', 'booked', NOW()
        )";
        
// 5. 실행 (변수명을 $sql로 통일)
if(mysqli_query($conn, $sql)) {
    echo "<script>alert('예약이 완료되었습니다.'); location.href='index.php';</script>";
} else {
    // 쿼리 실패 시 원인 출력
    echo "에러 발생: " . mysqli_error($conn); 
}
?>