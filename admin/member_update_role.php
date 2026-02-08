<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$no = (int)($_POST["no"] ?? 0);
$role = trim($_POST["role"] ?? "");

if ($no <= 0 || $role === "") die("잘못된 요청");

// 기능 구현 단계: 일단 업데이트만 되게
$role_esc = mysqli_real_escape_string($conn, $role);
mysqli_query($conn, "UPDATE member SET role='{$role_esc}' WHERE no={$no}");

header("Location: /admin/member_view.php?no=" . $no);
exit;