
<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();
$today = date("Y-m-d");

function one($conn, $sql)
{
    $res = mysqli_query($conn, $sql);
    if (!$res)
        return 0;
    $row = mysqli_fetch_assoc($res);
    return $row ? (int) ($row["c"] ?? 0) : 0;
}

$cntMembers = one($conn, "SELECT COUNT(*) AS c FROM member");
$cntRooms = one($conn, "SELECT COUNT(*) AS c FROM room");
$cntResAll = one($conn, "SELECT COUNT(*) AS c FROM reservation");

$cntBooked = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE status='booked' OR status='예약완료'");
$cntCancel = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE status='cancel' OR status='취소'");
$cntCheckIn = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE status='checked_in' OR status='체크인'");
$cntCheckOut = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE status='checked_out' OR status='체크아웃'");

$cntTodayIn = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE check_in='{$today}'");
$cntTodayOut = one($conn, "SELECT COUNT(*) AS c FROM reservation WHERE check_out='{$today}'");

$recent = mysqli_query($conn, "
  SELECT r.r_no, r.room_no, rm.r_type, r.m_id, r.m_name, r.check_in, r.check_out, r.total_price, r.status, r.created_at
  FROM reservation r
  LEFT JOIN room rm ON r.room_no = rm.room_no
  ORDER BY r.r_no DESC
  LIMIT 5
");
$pageTitle = "호텔 관리자 대시보드";
include __DIR__ . "/views/index.view.php";