<?php
require __DIR__ . "/common/dbconn.php";

$name = $_POST['name'];
$subject = $_POST['subject'];
$content = $_POST['content'];

// SQL Injection 테스트를 위해 real_escape_string을 생략할 수 있으나, 
// 쿼리 에러를 방지하려면 최소한의 처리는 하는 게 좋습니다.
$sql = "INSERT INTO board (strName, strSubject, strContent, writeDate) 
        VALUES ('$name', '$subject', '$content', NOW())";

if(mysqli_query($conn, $sql)) {
    echo "<script>alert('등록되었습니다.'); location.href='board.php';</script>";
} else {
    echo "에러: " . mysqli_error($conn);
}
?>