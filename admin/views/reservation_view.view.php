<?php
include "common/header.php";
?>
  <h2><?=h($pageTitle)?></h2>
  <p class="muted"><a href="/admin/reservations.php">← 예약 목록</a></p>

  <table>
    <tr><th>예약번호</th><td><?=h($row["r_no"])?></td></tr>
    <tr><th>방번호</th><td><?=h($row["r_no"])?></td></tr>
    <tr><th>객실타입</th><td><?=h($row["r_name"] ?? "")?></td></tr>
    <tr><th>층</th><td><?=h($row["floor"] ?? "")?></td></tr>
    <tr><th>최대인원</th><td><?=h($row["max_people"] ?? "")?></td></tr>
    <tr><th>1박 가격</th><td><?=h($row["r_price"] ?? "")?></td></tr>

    <tr><th>회원ID</th><td><?=h($row["id"])?></td></tr>
    <tr><th>이름</th><td><?=h($row["m_name"])?></td></tr>
    <tr><th>체크인</th><td><?=h($row["check_in"])?></td></tr>
    <tr><th>체크아웃</th><td><?=h($row["check_out"])?></td></tr>
    <tr><th>숙박일수</th><td><?=h($row["stay_days"])?></td></tr>
    <tr><th>인원</th><td><?=h($row["m_count"] ?? "")?></td></tr>
    <tr><th>총액</th><td><?=h($row["total_price"])?></td></tr>
    <tr><th>상태</th><td><?=h($row["status"] ?? "")?></td></tr>
    <tr><th>생성일</th><td><?=h($row["created_at"] ?? "")?></td></tr>
  </table>

  <h3 style="margin-top:18px;">예약 상태 변경</h3>
  <form method="post" action="/admin/reservation_update.php">
    <input type="hidden" name="res_no" value="<?=h($row["res_no"])?>">
    <select name="status">
      <?php foreach($status_options as $opt): ?>
        <option value="<?=h($opt)?>" <?=($opt === ($row["status"] ?? "")) ? "selected" : ""?>>
          <?=h($opt)?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit">변경</button>
  </form>

<?php
include "common/footer.php";
?>