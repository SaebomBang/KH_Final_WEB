<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$no = (int) ($_POST["no"] ?? 0);
$name = trim($_POST["m_name"] ?? "");
$pass = trim($_POST["pass"] ?? "");
$age = (int) ($_POST["age"] ?? 0);
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? 0);
$role = trim($_POST["role"] ?? "");


if ($no <= 0 || $name === "" || $pass === "" || $age <= 0 || $email === "" || $phone === "" || $role === "")
    die("잘못된 요청");

$name_esc = mysqli_real_escape_string($conn, $name);
$pass_esc = mysqli_real_escape_string($conn, $pass);
$email_esc = mysqli_real_escape_string($conn, $email);
$phone_esc = mysqli_real_escape_string($conn, $phone);
$role_esc = mysqli_real_escape_string($conn, $role);

$strSQL = "UPDATE member set name='{$name_esc}', pw='{$pass_esc}', age='{$age}', email='{$email_esc}', phone='{$phone_esc}', role='{$role_esc}' WHERE no={$no}";

mysqli_query($conn, $strSQL);

header("Location: /admin/member_view.php?no=" . $no);
exit;