<?php
include __DIR__ . "/../common/header.php";
?>
<h2><?= h($pageTitle) ?></h2>
<p class="muted"><a href="/admin/index.php">← 대시보드</a></p>

<form method="get" action="/admin/rooms.php">
    <label>방번호</label>
    <input type="text" name="r_no" placeholder="예: 101">
    <label>타입</label>

    <select name="r_type">
        <option value="싱글">싱글</option>
        <option value="더블">더블</option>
        <option value="디럭스">디럭스</option>
        <option value="패밀리">패밀리</option>
        <option value="스위트">스위트</option>
    </select>
    <button type="submit">검색</button>
    <a href="/admin/rooms.php">초기화</a>
</form>

<table>
    <tr>
        <th>방번호</th>
        <th>타입</th>
        <th>층</th>
        <th>최대인원</th>
        <th>가격</th>
        <th>변경</th>

    </tr>

    <?php if ($rooms): ?>
        <?php while ($row = mysqli_fetch_assoc($rooms)): ?>
            <form method="post" action="/admin/room_update.php" style="margin:0;">
                <input type="hidden" name="r_no" value="<?= h($row["r_no"]) ?>">

                <tr>
                    <td><?= h($row["r_no"]) ?></td>
                    <td>
                        <select name="r_name">
                            <option value="<?= h($row["r_name"]) ?>"><?= h($row["r_name"]) ?></option>
                            <option value="싱글">싱글</option>
                            <option value="더블">더블</option>
                            <option value="디럭스">디럭스</option>
                            <option value="패밀리">패밀리</option>
                            <option value="스위트">스위트</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="floor" value="<?= h($row["floor"]) ?>" min="1" step="1" max="5">
                    </td>
                    <td>
                        <input type="number" name="max_people" value="<?= h($row["max_people"]) ?>" min="0" max="5" step="1">
                    </td>
                    <td>
                        <input type="number" name="r_price" value="<?= h($row["r_price"]) ?>" min="0" step="1000">
                    </td>
                    <td>
                        <button type="submit">변경</button>
                    </td>
                </tr>
            </form>

        <?php endwhile; ?>
    <?php endif; ?>
</table>

<?php
include __DIR__ . "/../common/footer.php";
?>