<?php
require __DIR__ . "/common/dbconn.php";

$room_no = (int)($_POST["room_no"] ?? 0);
$price   = (int)($_POST["price"] ?? -1);

if ($room_no <= 0 || $price < 0) die("잘못된 요청");

// 기능 구현 단계: 일단 업데이트만
mysqli_query($conn, "UPDATE room SET price={$price} WHERE room_no={$room_no}");

header("Location: /admin/rooms.php");
exit;