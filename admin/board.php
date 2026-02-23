<?php

require __DIR__ . "/common/dbconn.php";
$pageTitle = "문의게시판";
include __DIR__ . "/common/header.php";

// 검색 조건 처리
$keyword = $_GET["keyword"] ?? '';
$k_s = $_GET["k_s"] ?? '';
$where = "";

if ($keyword) {
    if ($k_s == '1') $where = "WHERE strSubject LIKE '%$keyword%'";
    else if ($k_s == '2') $where = "WHERE strContent LIKE '%$keyword%'";
    else if ($k_s == '3') $where = "WHERE strName LIKE '%$keyword%'";
}

$strSQL = "SELECT * FROM board $where ORDER BY strNumber DESC";
$rs = mysqli_query($conn, $strSQL);
?>

<main class="container py-4">
    <div id="board_contents" class="contents">
        <h2 class="text-center mb-4">문 의 게 시 판</h2>
        
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th width="7%">번호</th>
                    <th width="46%">제목</th>
                    <th width="15%">작성자</th>
                    <th width="20%">등록일</th>
                    <th width="12%">조회</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($rs) == 0): ?>
                <tr>
                    <td colspan="5" class="text-center py-5">등록된 게시물이 없습니다.</td>
                </tr>
                <?php else:
                while($rs_arr = mysqli_fetch_array($rs)){
                    $b_num = $rs_arr["strNumber"];
                ?>
                <tr class="text-center">
                    <td><?=$b_num;?></td>
                    <td class="text-start">
                        <a href="board_view.php?num=<?=$b_num;?>" class="text-decoration-none text-dark">
                            <?=$rs_arr["strSubject"];?>
                        </a>
                    </td>
                    <td><?=$rs_arr["strName"];?></td>
                    <td><?=date("Y-m-d", strtotime($rs_arr["writeDate"]));?></td>
                    <td><?=$rs_arr["viewCount"];?></td>
                </tr>
                <?php } endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-3">
            <form method="get" action="board_list.php" class="d-flex gap-2">
                <select name="k_s" class="form-select form-select-sm" style="width:100px;">
                    <option value="1" <?=$k_s=='1'?'selected':''?>>글제목</option>
                    <option value="2" <?=$k_s=='2'?'selected':''?>>글내용</option>
                    <option value="3" <?=$k_s=='3'?'selected':''?>>작성자</option>
                </select>
                <input type="text" name="keyword" class="form-control form-control-sm" value="<?=$keyword?>" style="width:200px;">
                <button type="submit" class="btn btn-secondary btn-sm">검색</button>
            </form>
            <button class="btn btn-primary" onclick="location.href='board_write.php';">글쓰기</button>
        </div>
    </div>
</main>