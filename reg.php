<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <?php require_once "blocks/header.php"?>
    <div class="feedback">
        <div class="container">
            <h2>Регистрация</h2>
            <form method="post" action="lib/reg.php">
                <div class="inline">
                    <div>
                        <label>Логин</label>
                        <input type="text" name="login">
                    </div>
                    <div>
                        <label>Имя</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                    <label>Email</label>
                    <input type="email" class="one-line" name="email">
                    </div>

                    <label>Пароль</label>
                    <input type="password" class="one-line" name="password">
                    <h4>Есть Логин? <a href="/GOTOV/auth.php">Войти</h4>
                    <div>
                    <button type="submit">Зарегистрироваться</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>