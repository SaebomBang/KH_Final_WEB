<?php
require __DIR__ . "/common/dbconn.php";
require __DIR__ . "/common/auth.php";
require_admin();

$r_no = (int) ($_POST["r_no"] ?? 0);
$r_name = $_POST["r_name"];
$floor = (int) ($_POST["floor"] ?? 0);
$max_people = (int) ($_POST["max_people"] ?? 0);
$r_price = (int) ($_POST["r_price"] ?? -1);

if ($r_no <= 0 || $floor <= 0 || $max_people <= 0 || $r_price < 0)
    die("잘못된 요청");

$strSQL = "UPDATE room SET r_name='$r_name', floor={$floor}, max_people={$max_people}, r_price={$r_price} WHERE r_no={$r_no}";
mysqli_query($conn, $strSQL);

header("Location: /admin/rooms.php");
exit;