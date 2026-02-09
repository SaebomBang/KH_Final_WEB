<?php
// 여기서는 "출력"만 담당. (데이터는 index.php에서 만들어서 넘어옴)
include "common/header.php";
?>
  <h2><?=h($pageTitle)?></h2>
  <p class="muted">기능 구현 단계(세션/보안 미적용). 오늘: <?=h($today)?></p>

  <hr class="hr">

  <div class="grid">
    <div class="card"><div class="title">회원 수</div><div class="num"><?=h($cntMembers)?></div></div>
    <div class="card"><div class="title">객실 수</div><div class="num"><?=h($cntRooms)?></div></div>
    <div class="card"><div class="title">전체 예약</div><div class="num"><?=h($cntResAll)?></div></div>
    <div class="card"><div class="title">예약완료(Booked)</div><div class="num"><?=h($cntBooked)?></div></div>

    <div class="card"><div class="title">취소(Cancel)</div><div class="num"><?=h($cntCancel)?></div></div>
    <div class="card"><div class="title">체크인(Checked-in)</div><div class="num"><?=h($cntCheckIn)?></div></div>
    <div class="card"><div class="title">체크아웃(Checked-out)</div><div class="num"><?=h($cntCheckOut)?></div></div>
    <div class="card"><div class="title">오늘 체크인</div><div class="num"><?=h($cntTodayIn)?></div></div>
    <div class="card"><div class="title">오늘 체크아웃</div><div class="num"><?=h($cntTodayOut)?></div></div>
  </div>

  <h3 style="margin-top:24px;">최근 예약 5건</h3>
  <table>
    <tr>
      <th>예약번호</th><th>방번호</th><th>타입</th><th>회원ID</th><th>이름</th>
      <th>체크인</th><th>체크아웃</th><th>총액</th><th>상태</th><th>생성일</th><th>상세</th>
    </tr>

    <?php if ($recent): ?>
      <?php while($row = mysqli_fetch_assoc($recent)): ?>
        <tr>
          <td><?=h($row["r_no"])?></td>
          <td><?=h($row["room_no"])?></td>
          <td><?=h($row["r_type"] ?? "")?></td>
          <td><?=h($row["m_id"])?></td>
          <td><?=h($row["m_name"])?></td>
          <td><?=h($row["check_in"])?></td>
          <td><?=h($row["check_out"])?></td>
          <td><?=h($row["total_price"])?></td>
          <td><?=h($row["status"] ?? "")?></td>
          <td><?=h($row["created_at"] ?? "")?></td>
          <td><a href="/admin/reservation_view.php?r_no=<?=h($row["r_no"])?>">보기</a></td>
        </tr>
      <?php endwhile; ?>
    <?php endif; ?>
  </table>
<?php
include "common/footer.php";
?>