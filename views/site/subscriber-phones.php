<div class="modal-content">
    <h2>Телефоны абонента: <?= htmlspecialchars($subscriber->getFullName()) ?></h2>

    <table class="phones-table">
        <thead>
        <tr>
            <th>Номер</th>
            <th>Помещение</th>
            <th>Подразделение</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($subscriber->phones as $phone): ?>
            <tr>
                <td><?= htmlspecialchars($phone->number) ?></td>
                <td><?= $phone->room ? htmlspecialchars($phone->room->title) : '—' ?></td>
                <td>
                    <?= $phone->room && $phone->room->division
                        ? htmlspecialchars($phone->room->division->title)
                        : '—' ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="window.history.back()" class="btn-close">Закрыть</button>
</div>

<style>
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        max-width: 800px;
        margin: 20px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .phones-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    .phones-table th, .phones-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
    .btn-close {
        padding: 8px 15px;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>