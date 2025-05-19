<h1>Телефонные номера</h1>

<a href="/phones-add" class="btn btn-add">Добавить новый номер</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Номер телефона</th>
        <th>Помещение</th>
        <th>Абонент</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($phones as $phone): ?>
        <tr>
            <td><?= $phone->id ?></td>
            <td><?= htmlspecialchars($phone->number) ?></td>
            <td><?= htmlspecialchars($phone->room->title ?? 'Не указано') ?></td>
            <td>
                <?php if ($phone->subscriber): ?>
                    <?= htmlspecialchars($phone->subscriber->getFullName()) ?>
                <?php else: ?>
                    <span class="no-subscriber">Не назначен</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if (!$phone->subscriber): ?>
                    <form class="action-form" action="/phone/<?= $phone->id ?>/attach-subscriber" method="post">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <select name="subscriber_id" required>
                            <option value="">Выберите абонента</option>
                            <?php foreach ($allSubscribers as $subscriber): ?>
                                <option value="<?= $subscriber->id ?>">
                                    <?= htmlspecialchars($subscriber->getFullName()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn-attach">Прикрепить</button>
                    </form>
                <?php else: ?>
                    <form class="action-form" action="/phone/<?= $phone->id ?>/detach-subscriber" method="post">
                        <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                        <button type="submit" class="btn-detach">Открепить</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>