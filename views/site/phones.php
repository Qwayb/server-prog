<h1>Список номеров:</h1>

<table>
    <thead>
    <tr>
        <th>Номер</th>
        <th>Комната</th>
        <th>Абонент</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($phones as $phone): ?>
        <tr>
            <td><?= htmlspecialchars($phone->number) ?></td>
            <td><?= $phone->id ?></td>
            <td><?= htmlspecialchars($phone->subscriber_id) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>