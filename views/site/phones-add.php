<!DOCTYPE html>
<html>
<head>
    <title>Добавить номер телефона</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 150px; }
        input, select { padding: 8px; width: 250px; }
        .btn { padding: 8px 15px; background: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
<h1>Добавить номер телефона</h1>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label>Номер телефона:</label>
        <input type="text" name="number" required>
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
</body>
</html>