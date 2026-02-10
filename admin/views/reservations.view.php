<?php
include __DIR__ . "/../common/header.php";
?>
  <h2><?=h($pageTitle)?></h2>
  <p class="muted"><a href="/admin/index.php">← 대시보드</a></p>

  <form method="get" action="/admin/reservations.php">
    <label>검색(아이디/이름)</label>
    <input type="text" name="q" value="<?=h($q)?>">
    <label>상태</label>
    <select name="status">
        <option value="">전체</option>
        <option value="예약완료">예약완료</option>
        <option value="예약취소">예약취소</option>
        <option value="체크인">체크인</option>
        <option value="체크아웃">체크아웃</option>
    </select>
    <button type="submit">검색</button>
    <a href="/admin/reservations.php">초기화</a>
  </form>

  <table>
    <tr>
      <th>예약번호</th><th>방번호</th><th>타입</th>
      <th>회원ID</th><th>이름</th>
      <th>체크인</th><th>체크아웃</th>
      <th>총액</th><th>상태</th><th>생성일</th><th>상세</th>
    </tr>

    <?php if ($reservations): ?>
      <?php while($row = mysqli_fetch_assoc($reservations)): ?>
        <tr>
          <td><?=h($row["r_no"])?></td>
          <td><?=h($row["r_no"])?></td>
          <td><?=h($row["r_name"] ?? "")?></td>
          <td><?=h($row["id"])?></td>
          <td><?=h($row["m_name"])?></td>
          <td><?=h($row["check_in"])?></td>
          <td><?=h($row["check_out"])?></td>
          <td><?=h(number_format($row["total_price"])."원")?></td>
          <td><?=h($row["status"] ?? "")?></td>
          <td><?=h($row["created_at"] ?? "")?></td>
          <td><a href="/admin/reservation_view.php?res_no=<?=h($row["res_no"])?>">보기</a></td>
        </tr>
      <?php endwhile; ?>
    <?php endif; ?>
  </table>
<?php
include __DIR__ . "/../common/footer.php";
?>