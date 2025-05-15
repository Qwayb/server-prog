<form class="auth-form" method="post">
    <input placeholder="Логин" type="text" name="login" required>
    <input placeholder="Пароль" type="password" name="password" required>
    <label>Роль
        <select name="role" required>
            <option value="admin">Администратор</option>
            <option value="sysadmin">Системный администратор</option>
        </select>
    </label>
    <h3><?= $message ?? ''; ?></h3>
    <button type="submit">Зарегистрироваться</button>
</form>