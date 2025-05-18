<h1>Список абонентов</h1>

<!-- Форма фильтрации -->
<form method="get" action="<?= app()->route->getUrl('/subscribers') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <div class="filter-section">
        <label>Фильтр по подразделению:</label>
        <select name="division_id">
            <option value="">Все подразделения</option>
            <?php foreach ($divisions as $division): ?>
                <option value="<?= $division->id ?>"
                    <?= ($selectedDivision !== null && $selectedDivision == $division->id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($division->title) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-filter">Применить</button>
    </div>
</form>

<a href="<?= app()->route->getUrl('/subscribers-add') ?>" class="btn-add">
    Добавить абонента
</a>

<table class="subscribers-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th>Пользователь</th>
        <th>Подразделение</th> <!-- Новый столбец -->
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subscribers as $subscriber): ?>
        <tr>
            <td><?= $subscriber->id ?></td>
            <td><?= htmlspecialchars($subscriber->surname) ?></td>
            <td><?= htmlspecialchars($subscriber->name) ?></td>
            <td><?= htmlspecialchars($subscriber->patronymic) ?></td>
            <td><?= $subscriber->birth_date ?></td>
            <td><?= htmlspecialchars($subscriber->user->login ?? 'Нет') ?></td>
            <td>
                <?= $subscriber->divisions->isNotEmpty()
                    ? implode(', ', $subscriber->divisions->pluck('title')->toArray())
                    : '—' ?>
            </td>
            <td>
                <a href="<?= app()->route->getUrl('/subscriber/' . $subscriber->id . '/phones') ?>"
                   class="btn-view"
                   title="Просмотр телефонов">
                    📞
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<style>
    /* Добавьте новые стили */
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
    .btn-filter {
        padding: 6px 12px;
        background: #2196F3;
        color: white;
        border: none;
        border-radius: 3px;
    }
</style>