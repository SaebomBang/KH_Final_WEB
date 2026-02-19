<?php

$pageTitle = "hotel_main"; 
require_once "common/head.php";
?>

<div class="container mt-5">
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">🏨 우리 호텔에 오신 것을 환영합니다!</h1>
            <p class="col-md-8 fs-4 mx-auto">
                최고의 서비스와 안락한 객실이 준비되어 있습니다.<br>
                지금 바로 예약하고 특별한 하루를 보내세요.
            </p>
            <?php if(!isset($_SESSION["user_id"])): ?>
                <a href="login.php" class="btn btn-primary btn-lg">지금 로그인하기</a>
            <?php else: ?>
                <p class="text-primary"><strong><?= h($_SESSION["user_id"]) ?></strong>님, 반갑습니다! 😊</p>
                <a href="reservation.php" class="btn btn-success btn-lg">객실 예약하러 가기</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// 3. (선택사항) 푸터가 있다면 불러오기
// require_once "footer.php";
?>
</body>
</html>