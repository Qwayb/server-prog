<h1>Добавить подразделение</h1>

<form method="post" action="/divisions-add">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Название:</label>
        <input type="text" name="title" required>
        <label>Тип:</label>
        <input type="text" name="division-type" required>
    <button type="submit">Добавить</button>
</form>

<a href="<?= app()->route->getUrl('/divisions') ?>" class="button main-buttons__button">Назад к списку</a>
