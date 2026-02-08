<?php
$conn = mysqli_connect("192.168.50.111", "root", "1111", "hotel");

if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

/**
 * Summary of h
 * @param mixed $s
 * @return string prevent XSS attack 
 */
function h($s) {
  return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8");
}
?>
