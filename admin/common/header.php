<?php
if (!isset($pageTitle))
    $pageTitle = "Admin";
?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title><?= h($pageTitle) ?></title>

    <!-- Bootstrap (local) -->
    <link rel="stylesheet" href="/admin/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/assets/admin.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/index.php">Hotel Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navAdmin">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/admin/reservations.php">예약관리</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/members.php">회원관리</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/rooms.php">객실관리</a></li>
                </ul>
                <!-- 로그인 붙이면 여기 로그아웃 버튼 추가하면 됨 -->
            </div>
        </div>
    </nav>

    <main class="container py-4">