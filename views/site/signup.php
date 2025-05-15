<form class="auth-form signup-form" method="post">
    <input placeholder="Логин" type="text" name="login" required>
    <input placeholder="Пароль" type="password" name="password" required>
    <select name="role" required>
        <option value="admin">Администратор</option>
        <option value="sysadmin">Системный администратор</option>
    </select>
    <h3><?= $message ?? ''; ?></h3>
    <button type="submit">Зарегистрировать</button>
</form>