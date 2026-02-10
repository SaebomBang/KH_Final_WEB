<?php
include __DIR__ . "/../common/header.php";
?>
<h2><?= h($pageTitle) ?></h2>
<p class="muted"><a href="/admin/index.php">← 대시보드</a></p>

<form method="get" action="/admin/members.php">
    <label>검색(ID/이름)</label>
    <input type="text" name="q" value="<?= h($q) ?>">
    <label>role</label>
    <select name="role">
        <option value="" <?= ($role === "" ? "selected" : "") ?>>전체</option>
        <option value="user" <?= ($role === "user" ? "selected" : "") ?>>user</option>
        <option value="admin" <?= ($role === "admin" ? "selected" : "") ?>>admin</option>
    </select>
    <button type="submit">검색</button>
    <a class="btn" href="/admin/reservations.php">초기화</a>
</form>

<table>
    <tr>
        <th>번호</th>
        <th>ID</th>
        <th>이름</th>
        <th>이메일</th>
        <th>전화</th>
        <th>예약횟수</th>
        <th>가입일</th>
        <th>role</th>
        <th>상세</th>
    </tr>

    <?php if ($members): ?>
        <?php while ($row = mysqli_fetch_assoc($members)): ?>
            <tr>
                <td><?= h($row["no"]) ?></td>
                <td><?= h($row["id"]) ?></td>
                <td><?= h($row["name"]) ?></td>
                <td><?= h($row["email"]) ?></td>
                <td><?= h($row["phone"]) ?></td>
                <td><?= h($row["res_count"] ?? 0) ?></td>
                <td><?= h($row["reg_date"] ?? "") ?></td>
                <td><?= h($row["role"] ?? "") ?></td>
                <td><a href="/admin/member_view.php?no=<?= h($row["no"]) ?>">수정</a></td>
            </tr>
        <?php endwhile; ?>
    <?php endif; ?>
</table>

<?php
include __DIR__ . "/../common/footer.php";
?>