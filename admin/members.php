<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$q = trim($_GET["q"] ?? "");      // id / m_name 검색
$role = trim($_GET["role"] ?? ""); // role 필터(선택)

$sql = "SELECT no, m_name, id, email, phone, res_count, reg_date, role FROM member WHERE 1=1";

if ($q !== "") {
    $q_esc = mysqli_real_escape_string($conn, $q);
    $sql .= " AND (id LIKE '%{$q_esc}%' OR m_name LIKE '%{$q_esc}%') ";
}

if ($role !== "") {
    $role_esc = mysqli_real_escape_string($conn, $role);
    $sql .= " AND role = '{$role_esc}' ";
}

$sql .= " ORDER BY no DESC";

$members = mysqli_query($conn, $sql);

$pageTitle = "회원 관리";
include __DIR__ . "/views/members.view.php";