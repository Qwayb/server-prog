<h1>Список помещений:</h1>

<table class="rooms-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Тип помещения</th>
        <th>Подразделение</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room->id ?></td>
            <td><?= htmlspecialchars($room->title) ?></td>
            <td><?= htmlspecialchars($room->room_type) ?></td>
            <td><?= htmlspecialchars($room->division_id) ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>