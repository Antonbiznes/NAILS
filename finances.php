<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('mysql:host=localhost;dbname=php-website', 'root', '');

$sql_days = 'SELECT `date`, COUNT(*) as count FROM yslygi GROUP BY `date` ORDER BY `date` DESC';
$query_days = $pdo->prepare($sql_days);
$query_days->execute();
$stats_days = $query_days->fetchAll(PDO::FETCH_ASSOC);


$sql_services = 'SELECT service, COUNT(*) as count FROM yslygi GROUP BY service';
$query_services = $pdo->prepare($sql_services);
$query_services->execute();
$stats_services = $query_services->fetchAll(PDO::FETCH_ASSOC);


$sql_total = 'SELECT COUNT(*) as total FROM yslygi';
$query_total = $pdo->prepare($sql_total);
$query_total->execute();
$total_records = $query_total->fetchColumn();


$sql_all = 'SELECT * FROM yslygi ORDER BY `date` DESC, hours DESC, minutes DESC';
$query_all = $pdo->prepare($sql_all);
$query_all->execute();
$all_records = $query_all->fetchAll(PDO::FETCH_ASSOC);


$total_income = 0;  
$income_by_days = [];  
$income_by_services = [];  


$sql_day_service = 'SELECT `date`, service, COUNT(*) as count FROM yslygi GROUP BY `date`, service ORDER BY `date` DESC';
$query_day_service = $pdo->prepare($sql_day_service);
$query_day_service->execute();
$stats_day_service = $query_day_service->fetchAll(PDO::FETCH_ASSOC);


foreach ($stats_day_service as $row) {
    $price = getServicePrice($row['service']);  
    $income = $row['count'] * $price;  
    
    
    $total_income += $income;
    
    
    if (!isset($income_by_days[$row['date']])) {
        $income_by_days[$row['date']] = 0;
    }
    $income_by_days[$row['date']] += $income;
    
    
    if (!isset($income_by_services[$row['service']])) {
        $income_by_services[$row['service']] = 0;
    }
    $income_by_services[$row['service']] += $income;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Финансы</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;  
            display: flex;  
            min-height: 100vh;  
        }
        .sidebar {
            width: 250px;  
            background-color: #f4f4f4;  
            padding: 20px;
            box-sizing: border-box;
            position: fixed;  
            height: 100%;  
            overflow-y: auto;  
        }
        .main-container {
            flex: 1;  
            margin-left: 250px;  
            padding: 20px;
            box-sizing: border-box;
        }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <?php require_once "blocks/lc.php"; ?> 
    <div class="main-container">
        <h1>Финансы</h1>
        <h2>Общий доход: <?php echo number_format($total_income, 0, ',', ' '); ?> руб.</h2>
        <h2>Общее количество записей: <?php echo $total_records; ?></h2>
        <h2>Доход по дням</h2>
        <table>
            <tr><th>Дата</th><th>Доход (руб.)</th><th>Количество записей</th></tr>
            <?php foreach ($stats_days as $day_row): ?>
                <?php $date = $day_row['date']; ?>
                <tr>
                    <td><?php echo htmlspecialchars($date); ?></td>
                    <td><?php echo number_format($income_by_days[$date] ?? 0, 0, ',', ' '); ?></td>
                    <td><?php echo htmlspecialchars($day_row['count']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Доход по услугам</h2>
        <table>
            <tr><th>Услуга</th><th>Доход (руб.)</th><th>Количество записей</th></tr>
            <?php foreach ($stats_services as $service_row): ?>
                <?php $service = $service_row['service']; ?>
                <tr>
                    <td><?php echo getServiceName($service); ?> (<?php echo htmlspecialchars($service); ?>)</td>
                    <td><?php echo number_format($income_by_services[$service] ?? 0, 0, ',', ' '); ?></td>
                    <td><?php echo htmlspecialchars($service_row['count']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Все записи (детали с ценами)</h2>
        <table>
            <tr>
                <th>Имя</th><th>Телефон</th><th>Email</th><th>Услуга</th><th>Цена (руб.)</th><th>Дата</th><th>Время</th><th>Комментарий</th>
            </tr>
            <?php foreach ($all_records as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo getServiceName($row['service']); ?> (<?php echo htmlspecialchars($row['service']); ?>)</td>
                    <td><?php echo number_format(getServicePrice($row['service']), 0, ',', ' '); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['hours'] . ':' . $row['minutes']); ?></td>
                    <td><?php echo htmlspecialchars($row['comment']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

<?php

function getServicePrice($code) {
    $prices = [
        'pedicur' => 800,
        'manicur' => 1500,
        'narashivanie' => 1000,
        'chistka' => 800
    ];
    return $prices[$code] ?? 0;
}


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