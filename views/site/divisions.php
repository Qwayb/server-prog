<h1>Список подразделений:</h1>

<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Тип подразделения</th>
        <th>Абонентов</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($divisions as $division): ?>
        <tr>
            <td><?= $division->id ?></td>
            <td><?= htmlspecialchars($division->title) ?></td>
            <td><?= htmlspecialchars($division->division_type) ?></td>
            <td><?= $division->subscribers_count ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="<?= app()->route->getUrl('/divisions-add') ?>" class="button main-buttons__button">Добавить подразделение</a>
