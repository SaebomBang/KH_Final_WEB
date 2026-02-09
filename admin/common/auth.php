<?php
// /admin/common/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 로그인 여부
function is_logged_in(): bool
{
    return isset($_SESSION["admin_id"]);
}

// 관리자만 접근
function require_admin(): void
{
    if (!is_logged_in()) {
        header("Location: /admin/login.php");
        exit;
    }
    // role 체크(혹시 세션 값이 변조/오류인 경우 대비)
    if (($_SESSION["admin_role"] ?? "") !== "admin") {
        // 권한 없으면 로그아웃 처리 후 로그인으로
        header("Location: /admin/logout.php");
        exit;
    }
}

// 로그인 상태면 index로 보내기(로그인 페이지에서 사용)
function redirect_if_logged_in(): void
{
    if (is_logged_in()) {
        header("Location: /admin/index.php");
        exit;
    }
}