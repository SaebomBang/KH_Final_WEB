<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$conn = mysqli_connect("localhost", "root", "P@ssw0rd", "hotel");

if (!$conn) {
    die("연결 실패했습니다: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8");
}
