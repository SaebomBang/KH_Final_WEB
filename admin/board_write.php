<?php
$pageTitle = "글쓰기";
include __DIR__ . "/common/head.php";
?>
<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">문의하기</h3>
            <form action="board_insert.php" method="post">
                <div class="mb-3">
                    <label class="form-label">작성자</label>
                    <input type="text" name="name" class="form-control" value="<?=$_SESSION['user_name'] ?? ''?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">제목</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">내용</label>
                    <textarea name="content" class="form-control" rows="10" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">등록하기</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back();">취소</button>
                </div>
            </form>
        </div>
    </div>
</main>