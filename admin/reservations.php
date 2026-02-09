<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$q = trim($_GET["q"] ?? "");             // m_id / m_name 검색
$status = trim($_GET["status"] ?? "");   // status 필터

$sql = "
SELECT r.r_no, r.room_no, rm.r_type, r.m_id, r.m_name,
       r.check_in, r.check_out, r.total_price, r.status, r.created_at
FROM reservation r
LEFT JOIN room rm ON r.room_no = rm.room_no
WHERE 1=1
";

if ($q !== "") {
  $q_esc = mysqli_real_escape_string($conn, $q);
  $sql .= " AND (r.m_id LIKE '%{$q_esc}%' OR r.m_name LIKE '%{$q_esc}%') ";
}

if ($status !== "") {
  $st_esc = mysqli_real_escape_string($conn, $status);
  $sql .= " AND r.status = '{$st_esc}' ";
}

$sql .= " ORDER BY r.r_no DESC";

$reservations = mysqli_query($conn, $sql);

$pageTitle = "예약 관리";
include "views/reservations.view.php";