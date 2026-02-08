<?php
require __DIR__ . "/common/dbconn.php";

$r_no = (int) ($_GET["r_no"] ?? 0);
if ($r_no <= 0)
    die("잘못된 접근");


$sql = "
SELECT r.*,
       rm.r_type, rm.floor, rm.max_people, rm.price
FROM reservation r
LEFT JOIN room rm ON r.room_no = rm.room_no
WHERE r.r_no = {$r_no}
LIMIT 1
";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
if (!$row)
    die("예약이 없습니다.");

$status_options = ["예약완료", "예약취소", "체크인", "체크아웃"];

$pageTitle = "예약 상세";
include __DIR__ . "/views/reservation_view.view.php";