<div class="main-buttons">
    <a href="<?= app()->route->getUrl('/subscribers') ?>" class="button main-buttons__button">Просмотр всех абонентов</a>
    <a href="<?= app()->route->getUrl('/') ?>" class="button main-buttons__button">Просмотр всех помещений</a>
    <a href="<?= app()->route->getUrl('/divisions') ?>" class="button main-buttons__button">Просмотр всех подразделений</a>
    <a href="<?= app()->route->getUrl('/') ?>" class="button main-buttons__button">Просмотр всех телефонов</a>
</div>

<?php if (app()->auth::isAdmin()): ?>
    <a href="<?= app()->route->getUrl('/signup') ?>" class="button">Добавить пользователя</a>
<?php endif; ?>