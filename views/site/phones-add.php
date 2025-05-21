<div class="container">
    <h1 class="mt-4">Добавление телефонного номера</h1>

    <form method="post" class="mt-4">
        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

        <div class="mb-3">
            <label for="number" class="form-label">Номер телефона</label>
            <input type="text"
                   class="form-control <?= isset($errors['number']) ? 'is-invalid' : '' ?>"
                   id="number"
                   name="number"
                   value="<?= htmlspecialchars($old['number'] ?? '') ?>"
                   placeholder="Пример: 79123456789">
            <?php if (isset($errors['number'])): ?>
                <div class="invalid-feedback">
                    <?= implode('<br>', $errors['number']) ?>
                </div>
            <?php endif; ?>
            <div class="form-text">Введите 11 цифр, начинающихся с 7 или 8</div>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Помещение</label>
            <select class="form-select <?= isset($errors['room_id']) ? 'is-invalid' : '' ?>"
                    id="room_id"
                    name="room_id"
                    required>
                <option value="">Выберите помещение</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room->id ?>"
                        <?= isset($old['room_id']) && $old['room_id'] == $room->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($room->title) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['room_id'])): ?>
                <div class="invalid-feedback">
                    <?= implode('<br>', $errors['room_id']) ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="subscriber_id" class="form-label">Абонент (необязательно)</label>
            <select class="form-select <?= isset($errors['subscriber_id']) ? 'is-invalid' : '' ?>"
                    id="subscriber_id"
                    name="subscriber_id">
                <option value="">Не назначено</option>
                <?php foreach ($subscribers as $subscriber): ?>
                    <option value="<?= $subscriber->id ?>"
                        <?= isset($old['subscriber_id']) && $old['subscriber_id'] == $subscriber->id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($subscriber->getFullName()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['subscriber_id'])): ?>
                <div class="invalid-feedback">
                    <?= implode('<br>', $errors['subscriber_id']) ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Добавить</button>
            <a href="/phones" class="btn btn-outline-secondary">Отмена</a>
        </div>
    </form>
</div>

<style>
    .form-group { margin-bottom: 15px; }
    label { display: inline-block; width: 200px; font-weight: bold; }
    input, select {
        padding: 8px;
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .error {
        color: #d9534f;
        font-size: 14px;
        margin-top: 5px;
    }
    .btn {
        padding: 8px 16px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-cancel {
        padding: 8px 16px;
        background-color: #ccc;
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        margin-left: 10px;
    }
    .form-actions { margin-top: 20px; }
</style>