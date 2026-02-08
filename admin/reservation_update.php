<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$r_no = (int)($_POST["r_no"] ?? 0);
$status = trim($_POST["status"] ?? "");

if ($r_no <= 0 || $status === "") die("잘못된 요청");

// 기능 구현 단계: 일단 업데이트만 되게
$status_esc = mysqli_real_escape_string($conn, $status);
mysqli_query($conn, "UPDATE reservation SET status='{$status_esc}' WHERE r_no={$r_no}");

header("Location: /admin/reservation_view.php?r_no=" . $r_no);
exit;