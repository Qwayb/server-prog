<h1>Добавление нового абонента</h1>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="form-group">
        <label>Фамилия:</label>
        <input type="text" name="surname" required>
        <?php if (isset($errors['surname'])): ?>
            <div class="error"><?= $errors['surname'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Имя:</label>
        <input type="text" name="name" required>
        <?php if (isset($errors['name'])): ?>
            <div class="error"><?= $errors['name'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Отчество:</label>
        <input type="text" name="patronymic" required>
        <?php if (isset($errors['patronymic'])): ?>
            <div class="error"><?= $errors['patronymic'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Дата рождения:</label>
        <input type="date" name="birth_date" required>
        <?php if (isset($errors['birth_date'])): ?>
            <div class="error"><?= $errors['birth_date'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Пользователь:</label>
        <select name="user_id" required>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>">
                    <?= htmlspecialchars($user->login) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <button type="submit" class="btn">Добавить</button>
    <a href="/subscribers" class="btn-cancel">Отмена</a>
</form>

<style>
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: inline-block;
        width: 150px;
    }
    input, select {
        padding: 8px;
        width: 300px;
    }
    .error {
        color: red;
        font-size: 14px;
    }
</style>