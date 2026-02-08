<?php
include __DIR__ . "/../common/header.php";
?>
  <h2><?=h($pageTitle)?></h2>
  <p class="muted"><a href="/admin/index.php">← 대시보드</a></p>

  <form method="get" action="/admin/rooms.php">
    <label>방번호</label>
    <input type="text" name="room_no" value="<?=h($room_no)?>" placeholder="예: 101">
    <label>타입</label>

    
    <input type="text" name="r_type" value="<?=h($r_type)?>" placeholder="예: Deluxe">
    <button type="submit">검색</button>
    <a href="/admin/rooms.php">초기화</a>
  </form>

  <table>
    <tr>
      <th>방번호</th><th>타입</th><th>층</th><th>최대인원</th><th>가격</th><th>가격 수정</th>
    </tr>

    <?php if ($rooms): ?>
      <?php while($row = mysqli_fetch_assoc($rooms)): ?>
        <tr>
          <td><?=h($row["room_no"])?></td>
          <td><?=h($row["r_type"])?></td>
          <td><?=h($row["floor"])?></td>
          <td><?=h($row["max_people"])?></td>
          <td><?=h($row["price"])?></td>
          <td>
            <form method="post" action="/admin/room_update.php" style="margin:0;">
              <input type="hidden" name="room_no" value="<?=h($row["room_no"])?>">
              <input type="number" name="price" value="<?=h($row["price"])?>" min="0" step="1000">
              <button type="submit">변경</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php endif; ?>
  </table>

<?php
include __DIR__ . "/../common/footer.php";
?>