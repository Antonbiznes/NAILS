<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$service = trim(filter_var($_POST['service'], FILTER_SANITIZE_SPECIAL_CHARS));
$date = trim(filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS));
$hours = trim(filter_var($_POST['hours'], FILTER_SANITIZE_SPECIAL_CHARS));
$minutes = trim(filter_var($_POST['minutes'], FILTER_SANITIZE_SPECIAL_CHARS));
$comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($name) < 5){
    echo "Короткое имя и Фамилия";
exit;
}
if (strlen($phone) < 11 && str_contains($phone, '+')) {
    echo "Отсутсвует +";
exit;
}
//DB

$pdo = new PDO('mysql:host=localhost;dbname=php-website','root','');


//Проверка на занятость
$sql_check = 'SELECT COUNT(*) FROM yslygi WHERE `date` = ? AND hours = ? AND minutes = ?';
$query_check = $pdo->prepare(($sql_check));
$query_check->execute([$date, $hours, $minutes]);
$count = $query_check->fetchColumn();

if ($count > 0) {
    echo "Это время уже занато, выберите другое.";
    exit();
}

$current_date = date('Y-m-d');
if ($date < $current_date) {
    echo "Данная дата уже в прошлом, выберите будущую дату.";
    exit;
}

$current_timestamp = time();
$selected_time = "{$date} {$hours}:{$minutes}:00";
$selected_timestamp = strtotime($selected_time);

if ($selected_timestamp === false) {
    echo "Неверный формат даты или времению";
    exit;
}

if ($selected_timestamp < $current_timestamp){
    echo "Выбранное время в прошлом. Пожалуйства выберите будущую дату";
    exit;
}

$sql = 'INSERT INTO yslygi(name, phone, email, service, date, hours, minutes, comment) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$name, $phone, $email, $service, $date, $hours, $minutes, $comment]);

header('Location: /GOTOV/главнаястраница.php');
exit();
?>