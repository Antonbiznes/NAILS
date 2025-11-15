<!-- Сайдбар -->
<div class="sidebar">
    <a href="главнаястраница.php" target="_blank" class="logo-link">
        <div class="logo">
            <h1>Nail<span>Art</span> Studio</h1>
        </div>
    </a>
    <ul class="nav-links">
        <li><a href="lc.php" <?php if(basename($_SERVER['PHP_SELF']) == 'главнаястраница.php') echo 'class="active"'; ?>><i class="fas fa-home"></i> <span>Главная</span></a></li>
        <li><a href="raspis.php" <?php if(basename($_SERVER['PHP_SELF']) == 'schedule.php') echo 'class="active"'; ?>><i class="fas fa-calendar-alt"></i> <span>Расписание</span></a></li>
        <li><a href="clients.php" <?php if(basename($_SERVER['PHP_SELF']) == 'clients.php') echo 'class="active"'; ?>><i class="fas fa-users"></i> <span>Клиенты</span></a></li>
        <li><a href="stats.php" <?php if(basename($_SERVER['PHP_SELF']) == 'stats.php') echo 'class="active"'; ?>><i class="fas fa-chart-line"></i> <span>Статистика</span></a></li>
        <li><a href="finances.php" <?php if(basename($_SERVER['PHP_SELF']) == 'finance.php') echo 'class="active"'; ?>><i class="fas fa-wallet"></i> <span>Финансы</span></a></li>
        <li><a href="setting.php" <?php if(basename($_SERVER['PHP_SELF']) == 'settings.php') echo 'class="active"'; ?>><i class="fas fa-cog"></i> <span>Настройки</span></a></li>
    </ul>
    <div class="user-info">
        <img src="https://pw.artfile.me/wallpaper/04-06-2012/650x428/zhivotnye-obezyany-obezyana-637659.jpg" alt="Аватар" class="user-avatar">
        <p><h3>Это я</h3></p>
        <p>Мастер ногтевого сервиса</p>
    </div>
</div>

<style>
    .logo-link {
        text-decoration: none;
        color: inherit;
        display: inline-block;
    }
    .logo-link:hover {
        text-decoration: none;
        color: inherit;
    }
    .logo-link:visited {
        color: inherit;
    }
</style>