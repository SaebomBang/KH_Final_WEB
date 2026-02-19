<?php
require __DIR__ . "/common/dbconn.php";


$pageTitle = "로그인";
include __DIR__ . "/common/head.php";
?>

<h2><?= h($pageTitle) ?></h2>

<?php if (!empty($_GET["err"])): ?>
    <p class="muted" style="color:#dc3545; font-weight:700;">로그인 실패: 아이디/비밀번호 또는 권한을 확인해줘.</p>
<?php endif; ?>

<form class="login-form" method="post" action="/member/login_ok.php">
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <div>
            <label>ID</label><br>
            <input type="text" name="id" required>
        </div>
        <div>
            <label>Password</label><br>
            <input type="password" name="pass" required>
        </div>
        <div style="display:flex; align-items:flex-end;">
            <button type="submit">로그인</button>
        </div>
    </div>
</form>

<!-- <?php include __DIR__ . "/common/footer.php"; ?> -->