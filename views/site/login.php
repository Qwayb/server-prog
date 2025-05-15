<?php
if (!app()->auth::check()):
    ?>
    <form class="auth-form" method="post">
        <input placeholder="Логин" type="text" name="login">
        <input placeholder="Пароль" type="password" name="password">
        <h3><?= $message ?? ''; ?></h3>
        <button>Войти</button>
    </form>
<?php endif;