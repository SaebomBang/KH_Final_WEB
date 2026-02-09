<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$room_no = (int) ($_POST["room_no"] ?? 0);
$r_type = $_POST["r_type"];
$floor = (int) ($_POST["floor"] ?? 0);
$max_people = (int) ($_POST["max_people"] ?? 0);
$price = (int) ($_POST["price"] ?? -1);

if ($room_no <= 0 || $floor <= 0 || $max_people <= 0 || $price < 0)
    die("잘못된 요청");

$strSQL = "UPDATE room SET r_type='$r_type', floor={$floor}, max_people={$max_people}, price={$price} WHERE room_no={$room_no}";
mysqli_query($conn, $strSQL);

header("Location: /admin/rooms.php");
exit;