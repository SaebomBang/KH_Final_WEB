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
                <?php if (isset($_SESSION["admin_id"])): ?>
                    <a class="btn" href="/admin/logout.php">로그아웃</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container py-4">