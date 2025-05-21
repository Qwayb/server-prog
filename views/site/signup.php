<form class="auth-form signup-form" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <div class="form-group">
        <input placeholder="Логин"
               type="text"
               name="login"
               value="<?= htmlspecialchars($old['login'] ?? '') ?>"
               required>
    </div>

    <div class="form-group">
        <input placeholder="Пароль"
               type="password"
               name="password"
               required>
<!--        --><?php //if (isset($errors['password'])): ?>
<!--            <div class="error">--><?php //= $errors['password'][0] ?? '' ?><!--</div>-->
<!--        --><?php //endif; ?>
    </div>

    <div class="form-group">
        <select name="role" required>
            <option value="admin" <?= ($old['role'] ?? '') === 'admin' ? 'selected' : '' ?>>
                Администратор
            </option>
            <option value="sysadmin" <?= ($old['role'] ?? '') === 'sysadmin' ? 'selected' : '' ?>>
                Системный администратор
            </option>
        </select>
    </div>

    <h3><?= $message ?? ''; ?></h3>
    <button type="submit">Зарегистрировать</button>
</form>