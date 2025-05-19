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
        <button type="submit" class="button main-buttons__button">Применить</button>
        <a href="<?= app()->route->getUrl('/subscribers-add') ?>" class="button main-buttons__button">Добавить абонента</a>
    </div>
</form>


<table class="subscribers-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Дата рождения</th>
        <th>Действия (Телефон)</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subscribers as $subscriber): ?>
        <tr>
            <td><?= $subscriber->id ?></td>
            <td>
                <?= htmlspecialchars(
                    $subscriber->surname . ' ' .
                    $subscriber->name . ' ' .
                    $subscriber->patronymic
                ) ?>
            </td>
            <td><?= $subscriber->birth_date ?></td>
            <td>
                <?php if ($subscriber->phones->isNotEmpty()): ?>
                    <?php foreach ($subscriber->phones as $phone): ?>
                        <div><?= htmlspecialchars($phone->number) ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="no-phone">Нет телефона</span>
                <?php endif; ?>
            </td>
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