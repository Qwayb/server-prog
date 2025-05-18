<h1>Абоненты подразделения: <?= $division->title ?></h1>

<?php if ($subscribers->isEmpty()): ?>
    <p>Нет абонентов в этом подразделении.</p>
<?php else: ?>
    <table border="1">
        <tr>
            <th>ФИО</th>
            <th>Телефоны</th>
        </tr>
        <?php foreach ($subscribers as $subscriber): ?>
            <tr>
                <td><?= htmlspecialchars($subscriber->name) ?></td>
                <td>
                    <?php foreach ($subscriber->phones as $phone): ?>
                        <?= htmlspecialchars($phone->number) ?><br>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<a href="/divisions-select">Назад к выбору подразделения</a>