<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
    <label>Логин <input type="text" name="login" required></label>
    <label>Пароль <input type="password" name="password" required></label>
    <label>Роль
        <select name="role" required>
            <option value="admin">Администратор</option>
            <option value="sysadmin">Системный администратор</option>
        </select>
    </label>
    <button type="submit">Зарегистрироваться</button>
</form>