<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$room_no = trim($_GET["r_no"] ?? ""); // 방번호 검색(선택)
$r_type  = trim($_GET["r_type"] ?? "");  // 타입 검색(선택)

$sql = "SELECT r_no, r_name, floor, max_people, r_price FROM room WHERE 1=1";

if ($room_no !== "") {
    $rn = (int)$room_no;
    $sql .= " AND r_no = {$rn} ";
}

if ($r_type !== "") {
    $rt_esc = mysqli_real_escape_string($conn, $r_type);
    $sql .= " AND r_name LIKE '%{$rt_esc}%' ";
}

$sql .= " ORDER BY r_no ASC";

$status_options = ["예약완료", "예약취소", "체크인", "체크아웃"];

$rooms = mysqli_query($conn, $sql);
$pageTitle = "객실 관리";
include __DIR__ . "/views/rooms.view.php";