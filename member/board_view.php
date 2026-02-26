<?php
require __DIR__ . "/common/dbconn.php";
$num = $_GET['num'];

// 조회수 증가
mysqli_query($conn, "UPDATE board SET viewCount = viewCount + 1 WHERE strNumber = $num");

$rs = mysqli_query($conn, "SELECT * FROM board WHERE strNumber = $num");
$data = mysqli_fetch_array($rs);

$pageTitle = "글보기";
include __DIR__ . "/common/head.php";
?>
<main class="container py-4">
    <table class="table table-bordered">
        <tr>
            <th class="table-light" width="20%">제목</th>
            <td><?=$data['strSubject']?></td> <!-- XSS 취약 지점 -->
        </tr>
        <tr>
            <th class="table-light">작성자</th>
            <td><?=$data['strName']?></td>
        </tr>
        <tr>
            <td colspan="2" style="min-height:300px; padding:30px;">
                <?=$data['strContent']?> <!-- XSS 취약 지점 -->
            </td>
        </tr>
    </table>
    <div class="text-center">
        <button class="btn btn-secondary" onclick="location.href='board.php';">목록으로</button>
    </div>
</main>