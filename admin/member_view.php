<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$no = (int)($_GET["no"] ?? 0);
if ($no <= 0) die("잘못된 접근");

$res = mysqli_query($conn, "SELECT * FROM member WHERE no={$no} LIMIT 1");
$member = mysqli_fetch_assoc($res);
if (!$member) die("회원이 없습니다.");

$role_options = ["user", "admin"];

$pageTitle = "회원 상세";
include __DIR__ . "/views/member_view.view.php";