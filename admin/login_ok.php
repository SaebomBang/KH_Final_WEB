<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";

$id = trim($_POST["id"] ?? "");
$pw_input = trim($_POST["pass"] ?? "");

if ($id === "" || $pw_input === "") {
  header("Location: /admin/login.php?err=1");
  exit;
}

$sql = "SELECT no, id, pw, role, name
        FROM member
        WHERE id = ?
        LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
  die("prepare fail: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "s", $id);

if (!mysqli_stmt_execute($stmt)) {
  die("execute fail: " . mysqli_stmt_error($stmt));
}

$res = mysqli_stmt_get_result($stmt);
$user = $res ? mysqli_fetch_assoc($res) : null;

$ok = false;
if ($user && (($user["pw"] ?? "") === $pw_input) && (($user["role"] ?? "") === "admin")) {
  $ok = true;
}

if (!$ok) {
  header("Location: /admin/login.php?err=1");
  exit;
}

$_SESSION["admin_no"] = (int)$user["no"];
$_SESSION["admin_id"] = $user["id"];
$_SESSION["admin_name"] = $user["name"] ?? "";
$_SESSION["admin_role"] = $user["role"] ?? "";

header("Location: /admin/index.php");
exit;