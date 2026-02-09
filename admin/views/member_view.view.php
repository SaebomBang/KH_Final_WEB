<?php
include __DIR__ . "/../common/header.php";
?>
<h2><?= h($pageTitle) ?></h2>
<p class="muted"><a href="/admin/members.php">← 회원 목록</a></p>

<form method="POST" action="/admin/member_update.php">
    <input type="hidden" name="no" value="<?= h($member["no"]) ?>">
    <table>
        <tr>
            <th>번호</th>
            <td><?= h($member["no"]) ?></td>
        </tr>
        <tr>
            <th>ID</th>
            <td><input type="text" name="id" value="<?= h($member["id"]) ?>"></input></td>
        </tr>
        <tr>
            <th>이름</th>
            <td><input type="text" name="m_name" value="<?= h($member["m_name"]) ?>"></input></td>
        </tr>
        <tr>
            <th>비밀번호</th>
            <td><input type="text" name="pass" value="<?= h($member["pass"]) ?>"></input></td>
        </tr>
        <tr>
            <th>나이</th>
            <td><input type="number" name="age" value="<?= h($member["age"]) ?>"></input></td>
        </tr>
        <tr>
            <th>이메일</th>
            <td><input type="text" name="email" value="<?= h($member["email"]) ?>"></input></td>
        </tr>
        <tr>
            <th>전화</th>
            <td><input type="text" name="phone" value="<?= h($member["phone"]) ?>"></input></td>
        </tr>
        <tr>
            <th>예약횟수</th>
            <td><?= h($member["res_count"] ?? 0) ?></td>
        </tr>
        <tr>
            <th>가입일</th>
            <td><?= h($member["reg_date"] ?? "") ?></td>
        </tr>
        <tr>
            <th>role</th>
            <td><select name="role">
                    <option value="<?= h($member["role"]) ?>"><?= h($member["role"]) ?></option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </td>
        </tr>
    </table>
    <button type="submit">변경</button>
<?php
include __DIR__ . "/../common/footer.php";
?>