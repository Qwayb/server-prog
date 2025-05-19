<h1>Добавить подразделение</h1>

<form method="post" action="/divisions-add">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <div class="form-group">
        <label>Название:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>" required>
        <?php if (isset($errors['title'])): ?>
            <div class="error"><?= $errors['title'][0] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label>Тип подразделения:</label>
        <input type="text" name="division_type" value="<?= htmlspecialchars($old['division_type'] ?? '') ?>" required>
        <?php if (isset($errors['division_type'])): ?>
            <div class="error"><?= $errors['division_type'][0] ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Добавить</button>
</form>

<a href="/divisions" class="btn-back">Назад к списку</a>

<style>
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: inline-block;
        width: 200px;
    }
    input {
        padding: 8px;
        width: 300px;
    }
    .error {
        color: red;
        font-size: 14px;
    }
    .btn-back {
        display: inline-block;
        margin-top: 15px;
        color: #333;
    }
</style>