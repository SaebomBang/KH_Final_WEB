<?php
require __DIR__ . "/common/dbconn.php";

$file_name = $_GET["file_name"];
// if ($strNumber <= 0) die("잘못된 요청");

// $sql = "SELECT orig_filename, saved_filename
//         FROM board
//         WHERE strNumber = ?
//         LIMIT 1";

// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "i", $strNumber);
// mysqli_stmt_execute($stmt);

// $res = mysqli_stmt_get_result($stmt);
// $row = $res ? mysqli_fetch_assoc($res) : null;

// if (!$row || empty($row['saved_filename'])) die("파일 없음");

$file = __DIR__ . "/uploads/board/" . $file_name;
if (!is_file($file)) die("파일 없음");


header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;