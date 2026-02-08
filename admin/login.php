<!doctype html>
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
</head>
<body>
  <h2>관리자 로그인</h2>
  <form method="post" action="login_ok.php">
    <div>
      <label>ID</label>
      <input type="text" name="id" required>
    </div>
    <div>
      <label>PW</label>
      <input type="password" name="pass" required>
    </div>
    <button type="submit">Login</button>
  </form>
</body>
</html>