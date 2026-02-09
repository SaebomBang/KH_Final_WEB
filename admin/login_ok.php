<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";

$id = trim($_POST["id"] ?? "");
$pw = trim($_POST["pass"] ?? "");

if ($id === "" || $pw === "") {
  header("Location: /admin/login.php?err=1");
  exit;
}

// member에서 id로 조회
$stmt = mysqli_prepare($conn, "SELECT no, id, pass, role, m_name FROM member WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);

$ok = false;

// 현재 DB pass가 평문일 가능성이 높으니 일단 평문 비교
// (나중에 보안 단계에서 password_hash/password_verify로 교체 가능)
if ($user && ($user["pass"] === $pw) && (($user["role"] ?? "") === "admin")) {
  $ok = true;
}

if (!$ok) {
  header("Location: /admin/login.php?err=1");
  exit;
}

// 세션 저장
$_SESSION["admin_no"] = (int)$user["no"];
$_SESSION["admin_id"] = $user["id"];
$_SESSION["admin_name"] = $user["m_name"] ?? "";
$_SESSION["admin_role"] = $user["role"] ?? "";

// 로그인 성공 → index로
header("Location: /admin/index.php");
exit;