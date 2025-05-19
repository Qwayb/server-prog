<h1>Выберите подразделение</h1>

<div class="form-group">
    <label>Подразделение:</label>
    <select id="divisionSelect" required>
        <?php foreach ($divisions as $division): ?>
            <option value="<?= $division->id ?>">
                <?= htmlspecialchars($division->title) ?> (<?= $division->division_type ?>)
            </option>
        <?php endforeach; ?>
    </select>
</div>

<button type="button" onclick="redirectToDivision()" class="btn">Посмотреть абонентов</button>

<a href="/divisions">Назад к списку подразделений</a>

<script>
    function redirectToDivision() {
        const divisionId = document.getElementById('divisionSelect').value;
        window.location.href = `/subscribers/${divisionId}`;
    }
</script>