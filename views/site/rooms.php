<h1>Список помещений:</h1>

<?php if (app()->auth::isAdmin()): ?>
    <a href="<?= app()->route->getUrl('/rooms-add') ?>" class="button">Добавить помещение</a>
<?php endif; ?>

<table class="rooms-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Тип помещения</th>
        <th>Подразделение</th>
        <th>Абонентов</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room->id ?></td>
            <td><?= htmlspecialchars($room->title) ?></td>
            <td><?= htmlspecialchars($room->room_type) ?></td>
            <td><?= htmlspecialchars($room->division_id) ?></td>
            <td><?= $room->subscribersCount() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<style>
.filter-section {
margin-bottom: 20px;
padding: 15px;
background: #f5f5f5;
border-radius: 4px;
}
.filter-section select {
padding: 6px;
width: 300px;
margin-right: 10px;
}
</style>

