<?php
session_start(); // 
require __DIR__ . "/common/dbconn.php";

$id = trim($_POST["id"] ?? "");
$pw = trim($_POST["pass"] ?? "");

if ($id === "" || $pw === "") {
    header("Location: /member/login.php?err=1");
    exit;
}
/* =========================================================
   로그인 실패 잠금(계정 기반): 5분 창 내 5회 실패 -> 5분 잠금
   - 테이블: auth_login_guard (id PK) */

$ip = $_SERVER["REMOTE_ADDR"] ?? "";

// 최소 변경 원칙: guard 테이블 쿼리만이라도 SQL 깨짐 방지용 escape 적용
$id_esc = mysqli_real_escape_string($conn, $id);

// 0) 잠금 상태 확인 (lock_until > NOW())
$sqlLock = "SELECT lock_until
            FROM auth_login_guard
            WHERE id='{$id_esc}'
              AND lock_until IS NOT NULL
              AND lock_until > NOW()
            LIMIT 1";
$rsLock = mysqli_query($conn, $sqlLock);

if ($rsLock && mysqli_num_rows($rsLock) > 0) {
    echo "<script>
        alert('로그인 시도 횟수가 초과되어 잠시 후 다시 시도해줘.');
        history.back();
    </script>";
    exit;
}
/* ================================================================= */


$strSQL = "SELECT * FROM member WHERE id='" . $id . "' AND pw=PASSWORD('" . $pw . "')";
$rs = mysqli_query($conn, $strSQL);
$rs_arr = mysqli_fetch_array($rs);

// 2. DB 컬럼명에 맞춰서 짝 맞추기 (u_id -> id, u_pass -> pw)
// if($rs_arr) {
if ($rs_arr && ($rs_arr["id"] == $id)) {

/* =========================================================
    로그인 성공 시 실패 카운트/잠금 리셋 */
    mysqli_query($conn, "UPDATE auth_login_guard
                         SET fail_count=0, first_fail_at=NULL, last_fail_at=NULL, lock_until=NULL
                         WHERE id='{$id_esc}'");
/* ================================================================= */

    $_SESSION["user_id"] = $rs_arr["id"];
    $_SESSION["user_name"] = $rs_arr["name"];
    $_SESSION["log_ip"] = $_SERVER["REMOTE_ADDR"];

    echo "<script>
        alert('로그인 성공 했습니다.');
        location.replace('/member/index.php');
    </script>";
} else {

/* =========================================================
    로그인 실패 시: 5분 창 내 5회 실패하면 5분 잠금 */

    $sqlFail = "
    INSERT INTO auth_login_guard (id, fail_count, first_fail_at, last_fail_at, lock_until)
    VALUES ('{$id_esc}', 1, NOW(), NOW(), NULL)
    ON DUPLICATE KEY UPDATE
      last_fail_at = NOW(),
      fail_count = IF(first_fail_at IS NULL OR first_fail_at < (NOW() - INTERVAL 5 MINUTE),
                      1,
                      fail_count + 1),
      first_fail_at = IF(first_fail_at IS NULL OR first_fail_at < (NOW() - INTERVAL 5 MINUTE),
                         NOW(),
                         first_fail_at),
      lock_until = IF(
          (lock_until IS NOT NULL AND lock_until > NOW()),
          lock_until,
          IF(
            IF(first_fail_at IS NULL OR first_fail_at < (NOW() - INTERVAL 5 MINUTE),
               1,
               fail_count + 1) >= 5,
            NOW() + INTERVAL 5 MINUTE,
            NULL
          )
      )
    ";
    mysqli_query($conn, $sqlFail);

/* ================================================================= */

    echo "<script>
        alert('아이디 또는 비밀번호가 일치하지 않습니다.');
        history.back();
    </script>";
}
?>