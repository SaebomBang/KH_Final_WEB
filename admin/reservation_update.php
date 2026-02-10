<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$res_no = (int)($_POST["res_no"] ?? 0);
$status = trim($_POST["status"] ?? "");

if ($res_no <= 0 || $status === "") die("잘못된 요청");

// 기능 구현 단계: 일단 업데이트만 되게
$status_esc = mysqli_real_escape_string($conn, $status);
mysqli_query($conn, "UPDATE reservation SET status='{$status_esc}' WHERE res_no={$res_no}");

header("Location: /admin/reservation_view.php?res_no=" . $res_no);
exit;