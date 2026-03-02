<?php
require __DIR__ . "/common/dbconn.php";

$name    = trim($_POST['name'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$content = trim($_POST['content'] ?? '');

if ($name === '' || $subject === '' || $content === '') {
    die("잘못된 요청");
}

// 업로드 설정
$uploadDir  = __DIR__ . "/uploads/board"; // 실제 저장 경로
$publicDir  = "/uploads/board";          // 웹 경로
$maxSize    = 5 * 1024 * 1024;           // 5MB
$allowedExt = ['jpg','jpeg','png','gif','pdf','txt','zip','hwp','doc','docx','ppt','pptx','xls','xlsx'];

// 폴더 생성
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$origName  = null;
$savedName = null;
$filePath  = null;
$fileSize  = null;
$mimeType  = null;

if (isset($_FILES['att_file']) && $_FILES['att_file']['error'] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES['att_file']['error'] !== UPLOAD_ERR_OK) {
        die("파일 업로드 에러: " . $_FILES['att_file']['error']);
    }

    if ($_FILES['att_file']['size'] > $maxSize) {
        die("파일 용량이 너무 큽니다. (최대 5MB)");
    }

    $origName = $_FILES['att_file']['name'];
    $tmpPath  = $_FILES['att_file']['tmp_name'];
    $fileSize = (int)$_FILES['att_file']['size'];

    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        die("허용되지 않는 파일 형식입니다.");
    }

    // MIME 타입(참고용)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = $finfo ? finfo_file($finfo, $tmpPath) : null;
    if ($finfo) finfo_close($finfo);

    // 저장명 생성
    $savedName = bin2hex(random_bytes(16)) . "." . $ext;
    $dest = $uploadDir . "/" . $savedName;

    if (!move_uploaded_file($tmpPath, $dest)) {
        die("파일 저장 실패");
    }

    $filePath = $publicDir . "/" . $savedName;
}

// DB 저장
$sql = "INSERT INTO board (strName, strSubject, strContent, writeDate,
                          orig_filename, saved_filename, file_path, file_size, mime_type)
        VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("prepare fail: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssis",
    $name,
    $subject,
    $content,
    $origName,
    $savedName,
    $filePath,
    $fileSize,
    $mimeType
);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('등록되었습니다.'); location.href='board.php';</script>";
} else {
    echo "에러: " . mysqli_stmt_error($stmt);
}