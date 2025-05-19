<h1>Добавить новое помещение</h1>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label>Название помещения:</label>
        <input type="text" name="title"
               value="<?= htmlspecialchars($old['title'] ?? '') ?>"
               required>
        <?php if (isset($errors['title'])): ?>
            <div class="error"><?= implode('<br>', $errors['title']) ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Тип помещения:</label>
        <input type="text" name="room_type" required>
        <?php if (isset($errors['room_type'])): ?>
            <div class="error"><?= $errors['room_type'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Подразделение:</label>
        <select name="division_id" required>
            <?php foreach ($divisions as $division): ?>
                <option value="<?= $division->id ?>">
                    <?= htmlspecialchars($division->title) ?> (<?= $division->division_type ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['division_id'])): ?>
            <div class="error"><?= $errors['division_id'][0] ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="button main-buttons__button">Добавить</button>
</form>

<a href="<?= app()->route->getUrl('/rooms') ?>" class="button main-buttons__button">Назад к списку помещений</a>

<style>
    .form-group { margin-bottom: 15px; }
    label { display: inline-block; width: 200px; }
    input, select { padding: 8px; width: 300px; }
    .btn { padding: 8px 15px; background: #4CAF50; color: white; border: none; }
    .error { color: red; font-size: 14px; }
</style>