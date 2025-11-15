<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if(strlen($login) < 2) {
    echo "Короткий Логин";
exit;
}
if(strlen($username) < 2) {
    echo "Короткое имя";
exit;
}
if(strlen($email) < 2 && str_contains($email, '@')) {
    echo "Ошибка:Короткий адрес или отсутвие @";
exit;
}
if(strlen($password) < 2) {
    echo "Короткий пароль";
exit;
}

//Password
$salt = 'fnguhiu£$£^%*!';
$password = md5($salt.$password);

//DB
$pdo = new PDO('mysql:hots=localhost;dbname=php-website','root','');

$sql = 'INSERT INTO users(login, username, email, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$login, $username, $email, $password]);

header('Location: /GOTOV/главнаястраница.php');