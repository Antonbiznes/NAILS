<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('mysql:host=localhost;dbname=php-website', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sort = $_GET['sort'] ?? 'date_asc'; 

$orderBy = 'date ASC, hours ASC, minutes ASC'; 
if ($sort === 'date_desc') {
    $orderBy = 'date DESC, hours DESC, minutes DESC';
} elseif ($sort === 'name_asc') {
    $orderBy = 'name ASC';
}
$sql = "SELECT * FROM yslygi ORDER BY $orderBy";
$query = $pdo->prepare($sql);
$query->execute();
$records = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NailArt Studio - Записи клиентов</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php require_once "blocks/lc.php"; ?>
        <div class="main-content">
            <div class="header">
                <h2>Записи клиентов</h2>
            </div>
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-number"><?= count($records) ?></div>
                    <div class="stat-label">Всего записей</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?= count(array_filter($records, function($record) {
                        return date('Y-m-d') <= $record['date'];
                    })) ?></div>
                    <div class="stat-label">Предстоящие</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?= count(array_unique(array_column($records, 'email'))) ?></div>
                    <div class="stat-label">Уникальных клиентов</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?= count(array_unique(array_column($records, 'service'))) ?></div>
                    <div class="stat-label">Видов услуг</div>
                </div>
            </div>
            <div class="control-panel">
                <div class="sort-links">
                    <span>Сортировать:</span>
                    <a href="?sort=date_asc" class="sort-btn <?= $sort === 'date_asc' ? 'active' : '' ?>">
                        <i class="fas fa-sort-amount-up"></i> Дата (возр.)
                    </a>
                    <a href="?sort=date_desc" class="sort-btn <?= $sort === 'date_desc' ? 'active' : '' ?>">
                        <i class="fas fa-sort-amount-down"></i> Дата (убыв.)
                    </a>
                    <a href="?sort=name_asc" class="sort-btn <?= $sort === 'name_asc' ? 'active' : '' ?>">
                        <i class="fas fa-sort-alpha-up"></i> Имя (A-Z)
                    </a>
                </div>
            </div>
            <div class="table-container">
                <?php if (empty($records)): ?>
                <div class="no-records">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>Нет записей</h3>
                    <p>Записи клиентов появятся здесь</p>
                </div>
                <?php else: ?>
                <table class="appointments-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Услуга</th>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Комментарий</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['id']) ?></td>
                            <td><?= htmlspecialchars($record['name']) ?></td>
                            <td><?= htmlspecialchars($record['phone']) ?></td>
                            <td><?= htmlspecialchars($record['email']) ?></td>
                            <td><?= htmlspecialchars($record['service']) ?></td>
                            <td><?= htmlspecialchars($record['date']) ?></td>
                            <td><?= htmlspecialchars($record['hours']) ?> : <?= htmlspecialchars($record['minutes']) ?></td>
                            <td><?= htmlspecialchars($record['comment']) ?></td>
                            <td>
                                <span class="status-badge status-new">Записан</span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortButtons = document.querySelectorAll('.sort-btn');
            sortButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    sortButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            const tableRows = document.querySelectorAll('.appointments-table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
</body>
</html>
