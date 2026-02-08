<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function is_logged_in(): bool {
    return isset($_SESSION["user"]) && is_array($_SESSION["user"]);
}
function is_admin(): bool {
    return is_logged_in() && (($_SESSION["user"]["role"] ?? "") === "admin");
}
function require_admin(): void {
    if (!is_admin()) {
        header("Location: /admin/login.php");
        exit;
    }
}
function current_user(string $key, $default=null) {
    if (!is_logged_in()) return $default;
    return $_SESSION["user"][$key] ?? $default;
}
?>