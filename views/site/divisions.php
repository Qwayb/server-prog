<h1>Список подразделений:</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Тип подразделения</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($divisions as $division): ?>
        <tr>
            <td><?= $division->id ?></td>
            <td><?= htmlspecialchars($division->title) ?></td>
            <td><?= htmlspecialchars($division->division_type) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>