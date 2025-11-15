<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if(strlen($login) < 2) {
    echo "Короткий Логин";
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
$pdo = new PDO('mysql:host=localhost;dbname=php-website','root','');

//Auth user
$sql = 'SELECT * FROM users WHERE login = ? AND password = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if($query->rowCount() == 0)
    echo "Такого пользователя нет!";
else{
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['name'];
    header('Location: /GOTOV/lc.php');
}
}