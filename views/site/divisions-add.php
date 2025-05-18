<h1>Добавить подразделение</h1>

<form method="post" action="/divisions-add">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <div>
        <label>Название:</label>
        <input type="text" name="title" required>
    </div>

    <div>
        <label>Тип:</label>
        <select name="division_type" required>
            <option value="office">Офис</option>
            <option value="warehouse">Склад</option>
            <option value="production">Производство</option>
        </select>
    </div>

    <button type="submit">Добавить</button>
</form>

<a href="<?= app()->route->getUrl('/divisions') ?>" class="button main-buttons__button">Назад к списку</a>
