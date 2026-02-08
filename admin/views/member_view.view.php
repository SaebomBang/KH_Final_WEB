<?php
include __DIR__ . "/../common/header.php";
?>
  <h2><?=h($pageTitle)?></h2>
  <p class="muted"><a href="/admin/members.php">← 회원 목록</a></p>

  <table>
    <tr><th>번호</th><td><?=h($member["no"])?></td></tr>
    <tr><th>ID</th><td><?=h($member["id"])?></td></tr>
    <tr><th>이름</th><td><?=h($member["m_name"])?></td></tr>
    <tr><th>비밀번호</th><td><?=h($member["pass"])?></td></tr>
    <tr><th>나이</th><td><?=h($member["age"])?></td></tr>
    <tr><th>이메일</th><td><?=h($member["email"])?></td></tr>
    <tr><th>전화</th><td><?=h($member["phone"])?></td></tr>
    <tr><th>예약횟수</th><td><?=h($member["res_count"] ?? 0)?></td></tr>
    <tr><th>가입일</th><td><?=h($member["reg_date"] ?? "")?></td></tr>
    <tr><th>role</th><td><?=h($member["role"] ?? "")?></td></tr>
  </table>

  <h3 style="margin-top:18px;">권한(role) 변경</h3>
  <form method="post" action="/admin/member_update_role.php">
    <input type="hidden" name="no" value="<?=h($member["no"])?>">
    <select name="role">
      <?php foreach($role_options as $opt): ?>
        <option value="<?=h($opt)?>" <?=($opt === ($member["role"] ?? "")) ? "selected" : ""?>>
          <?=h($opt)?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">변경</button>
  </form>

<?php
include __DIR__ . "/../common/footer.php";
?>