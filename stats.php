<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Подключение к БД
try {
    $pdo = new PDO('mysql:host=localhost;dbname=php-website', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения к БД: " . $e->getMessage();
    exit;
}
// Запрос 1: Статистика по дням (количество записей на каждый день)
$sql_days = 'SELECT `date`, COUNT(*) as count FROM yslygi GROUP BY `date` ORDER BY `date` DESC';
$query_days = $pdo->prepare($sql_days);
$query_days->execute();
$stats_days = $query_days->fetchAll(PDO::FETCH_ASSOC);
// Запрос 2: Статистика по услугам (количество записей на каждую услугу)
$sql_services = 'SELECT service, COUNT(*) as count FROM yslygi GROUP BY service';
$query_services = $pdo->prepare($sql_services);
$query_services->execute();
$stats_services = $query_services->fetchAll(PDO::FETCH_ASSOC);
// Запрос 3: Общее количество записей
$sql_total = 'SELECT COUNT(*) as total FROM yslygi';
$query_total = $pdo->prepare($sql_total);
$query_total->execute();
$total = $query_total->fetchColumn();
// Запрос 4: Детали записей (все записи, если нужно показать список)
$sql_all = 'SELECT * FROM yslygi ORDER BY `date` DESC, hours DESC, minutes DESC';
$query_all = $pdo->prepare($sql_all);
$query_all->execute();
$all_records = $query_all->fetchAll(PDO::FETCH_ASSOC);

// Вспомогательная функция для перевода кодов услуг в названия
function getServiceName($code) {
    $names = [
        'pedicur' => 'Педикюр',
        'manicur' => 'Маникюр',
        'narashivanie' => 'Наращивание',
        'chistka' => 'Чистка'
    ];
    return $names[$code] ?? 'Неизвестно';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика записей</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Подключаем общие стили -->
    <style>
        /* Локальные стили для stats.php, если нужно (ваши старые для таблиц) */
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <?php require_once "blocks/lc.php"; ?> <!-- Sidebar здесь -->
        <div class="main-content"> <!-- Основной контент с отступом -->
            <div class="header">
                <h2>Статистика записей</h2>
            </div>
            <h2>Общее количество записей: <?php echo $total; ?></h2>
            <h2>По дням</h2>
            <table>
                <tr><th>Дата</th><th>Количество записей</th></tr>
                <?php foreach ($stats_days as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['count']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <h2>По услугам</h2>
            <table>
                <tr><th>Услуга</th><th>Количество записей</th></tr>
                <?php foreach ($stats_services as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['service']); ?> (<?php echo getServiceName($row['service']); ?>)</td>
                    <td><?php echo htmlspecialchars($row['count']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <h2>Все записи (детали)</h2>
            <table>
                <tr>
                    <th>Имя</th><th>Телефон</th><th>Email</th><th>Услуга</th><th>Дата</th><th>Время</th><th>Комментарий</th>
                </tr>
                <?php foreach ($all_records as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['service']); ?> (<?php echo getServiceName($row['service']); ?>)</td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['hours'] . ':' . $row['minutes']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>