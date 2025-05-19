<h1>Добавить номер телефона</h1>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label>Номер телефона:</label>
        <input type="text" name="number"
               value="<?= htmlspecialchars($old['number'] ?? '') ?>"
               required
               pattern="[78]\d{10}"
               title="11 цифр, начинается с 7 или 8">
        <?php if (isset($errors['number'])): ?>
            <div class="alert alert-danger">
                <?= implode('<br>', $errors['number']) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Помещение:</label>
        <select name="room_id" required>
            <option value="">Выберите помещение</option>
            <?php foreach ($rooms as $room): ?>
                <option value="<?= $room->id ?>">
                    <?= htmlspecialchars($room->title) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Абонент (необязательно):</label>
        <select name="subscriber_id">
            <option value="">Не назначено</option>
            <?php foreach ($subscribers as $subscriber): ?>
                <option value="<?= $subscriber->id ?>">
                    <?= htmlspecialchars($subscriber->getFullName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn">Добавить</button>
    <a href="/phones" style="margin-left: 10px;">Отмена</a>
</form>

<style>
    .form-group { margin-bottom: 15px; }
    label { display: inline-block; width: 200px; }
    input, select { padding: 8px; width: 300px; }
    .error { color: red; font-size: 14px; }
</style>