<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <div class="feedback">
        <div class="container">
            <h2>Авторизация</h2>
            <form method="post" action="lib/auth.php">
                <div class="inline">
                    <div>
                        <label>Логин</label>
                        <input type="text" name="login">
                    </div>
                    <div>
                        <label>Пароль</label>
                    <input type="password" name="password">
                    </div>
                    <button type="submit">Авторизоваться</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>