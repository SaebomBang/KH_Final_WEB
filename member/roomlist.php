<?php
require __DIR__ . "/common/dbconn.php";

$pageTitle = "객실 리스트";
include __DIR__ . "/common/head.php";

// 1. 검색 조건 설정
$whereClause = "1"; // 기본값: 모든 데이터 검색
if (isset($_GET["keyword"]) && trim($_GET["keyword"]) !== "") {
    $key = mysqli_real_escape_string($conn, $_GET["keyword"]); // 보안 처리
    $room_s = $_GET["room_s"];

    switch ($room_s) {
        case '1':
            $whereClause = "r_no LIKE '%$key%'";
            break;
        case '2':
            $whereClause = "r_name LIKE '%$key%'";
            break;
        case '3':
            $whereClause = "floor LIKE '%$key%'";
            break;
        default:
            $whereClause = "1";
    }
}  

// 2. 최종 쿼리 실행
$strSQL = "SELECT * FROM room WHERE $whereClause ORDER BY r_no ASC";
$rs = mysqli_query($conn, $strSQL);
$rs_num = mysqli_num_rows($rs);
?>

<!-- 검색 창을 상단으로 이동 (사용자 편의성) -->
<form method="get" action="roomlist.php" style="margin-bottom: 20px; text-align: center;">
    <select name="room_s">
        <option value="1" <?php if(@$_GET['room_s'] == '1') echo 'selected'; ?>>객실번호</option>
        <option value="2" <?php if(@$_GET['room_s'] == '2') echo 'selected'; ?>>객실타입</option>
        <option value="3" <?php if(@$_GET['room_s'] == '3') echo 'selected'; ?>>층수</option>
    </select>
    <input type="text" name="keyword" value="<?php echo htmlspecialchars(@$_GET['keyword']); ?>">
    <input type="submit" value="검색">
    <a href="roomlist.php"><button type="button">초기화</button></a>
</form>

<table border="1" style="width:100%; border-collapse: collapse;">
    <tr>
        <th colspan="4" style="padding:15px; background-color: #eee;">
            <font style="font-size:150%;">객실 리스트 (<?php echo $rs_num; ?>건)</font>
        </th>
    </tr>

    <?php if ($rs_num == 0): ?>
    <tr>
        <td colspan="4" align="center" style="padding:50px;">검색 결과가 없습니다.</td>
    </tr>
    <?php else: ?>
        <?php while ($rs_arr = mysqli_fetch_array($rs)): 
            $r_no   = $rs_arr["r_no"];
            $type   = $rs_arr["r_name"];
            $max    = $rs_arr["max_people"];
            $price  = $rs_arr["r_price"];
            
            $image_name = $type . ".png"; 
            $image_path = "common/" . $image_name;
        ?>
        <tr>
            <!-- 호수 출력 -->
            <th width="100" align="center">
                <b style="font-size:1.2em;"><?php echo $r_no; ?>호</b>
            </th>

            <!-- 사진 출력 -->
            <td width="200" align="center" style="padding:10px;">
                <img src="<?php echo $image_path; ?>" width="180" alt="<?php echo $type; ?>" onerror="this.src='common/noimage.png';">
            </td>
            
            <!-- 레이블 열 -->
            <td width="120" style="padding-left:10px; background-color:#f8f8f8;">
                <p>타입</p>
                <p>숙박인원</p>
                <p>1박 금액</p>
            </td>
            
            <!-- 실제 데이터 열 -->
            <td style="padding-left:10px;">
                <p><?php echo $type; ?></p>
                <p><?php echo $max; ?>명</p>
                <p><?php echo number_format($price); ?>원</p>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php endif; ?>
</table>

