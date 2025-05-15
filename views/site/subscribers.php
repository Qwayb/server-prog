<h1>Список всех абонентов:</h1>

<table class="subscribers-table">
    <thead>
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th>Создатель</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subscribers as $subscriber): ?>
        <tr>
            <td><?= htmlspecialchars($subscriber->surname) ?></td>
            <td><?= htmlspecialchars($subscriber->name) ?></td>
            <td><?= htmlspecialchars($subscriber->patronymic) ?></td>
            <td><?= date('d.m.Y', strtotime($subscriber->birth_date)) ?></td>
            <td><?= htmlspecialchars($subscriber->user_id) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>