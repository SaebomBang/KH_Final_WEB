<?php
session_start();
require_once __DIR__ . "/dbconn.php";
if (!isset($pageTitle))
    $pageTitle = "hotel";
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title><?= h($pageTitle) ?></title>
    <link rel="stylesheet" href="/member/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/member/assets/member.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/member/index.php">Hotel</a>
            <div class="collapse navbar-collapse" id="area_menu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/member/roomlist.php">객실 리스트</a></li>
                    
                    <?php if(!isset($_SESSION["user_id"])): ?> 
                        <li class="nav-item"><a class="nav-link" href="/member/login.php">로그인</a></li>
                        <li class="nav-item"><a class="nav-link" href="/member/register.php">회원가입</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/member/info.php">회원정보</a></li>    
                        <li class="nav-item"><a class="nav-link" href="/member/reservation.php">예약</a></li>    
                        <li class="nav-item"><a class="nav-link" href="/member/reser_info.php">예약 확인</a></li>
                        <li class="nav-item"><a class="nav-link" href="/member/logout.php">로그아웃</a></li> <?php endif; ?> 
                </ul>
            </div>
        </div>
    </nav>
    <main class="container py-4">