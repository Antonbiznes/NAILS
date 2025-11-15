<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeNails - Эксперты нейл-арта</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #FF69B4;
            --secondary: #FFF0F5;
            --accent: #FFD700;
            --dark: #2F2F2F;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: white;
            overflow-x: hidden;
        }

        /* Шапка */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: 0.3s;
            position: relative;
        }

        .nav-menu a:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: 0.3s;
        }

        .nav-menu a:hover:after {
            width: 100%;
        }

        /* Герой секция */
        .hero {
            height: 100vh;
            background: linear-gradient(45deg, rgba(255,105,180,0.1), rgba(255,240,245,0.3)),
                        url('https://images.unsplash.com/photo-1604654894610-df63bc536371');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding-top: 80px;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            color: var(--dark);
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .cta-button {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
            border: 2px solid transparent;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255,105,180,0.4);
        }

        /* Услуги */
        .services {
            padding: 5rem 2rem;
            background: var(--secondary);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* Галерея */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            padding: 2rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            aspect-ratio: 1/1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.3s;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Мобильное меню */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php require_once "blocks/header.php";?>
    <header class="header">
        <nav class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-gem"></i>
                LuxeNails
            </a>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-menu">
                <a href="#services">Услуги</a>
                <a href="galery.html">Галерея</a>
                <a href="#about">О нас</a>
                <a href="#contact">Контакты</a>
                <a href="reg.php">Личный кабинет</a>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Совершенство в каждой детали</h1>
            <p>Профессиональный уход за ногтями с авторским дизайном</p>
            <a href="zapis.php" class="cta-button">Записаться онлайн</a>
        </div>
    </section>

    <section id="services" class="services">
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-spa service-icon"></i>
                <h3>Маникюр</h3>
                <p>Аппаратный, комбинированный</p>
                <p class="price">от 1500₽</p>
            </div>
            <div class="service-card">
                <i class="fas fa-spa service-icon"></i>
                <h3>Педикюр</h3>
                <p>Аппаратный, комбинированный</p>
                <p class="price">от 800₽</p>
            </div>
            <div class="service-card">
                <i class="fas fa-paint-brush service-icon"></i>
                <h3>Наращивание</h3>
                <p>Наращивание ногтей</p>
                <p class="price">от 1000₽</p>
            </div>
            <div class="service-card">
                <i class="fas fa-hand-holding-heart service-icon"></i>
                <h3>Чистка</h3>
                <p>Чистка ногтей</p>
                <p class="price">от 500₽</p>
            </div>
            <div class="service-card">
                <i class="fas fa-spa service-icon"></i>
                <h3>Консультация</h3>
                <p>Проконсультируем</p>
                <p class="price">от 100₽</p>
            </div>
        </div>
    </section>
    <section id="about" class="about">
        <div class="about-grid"></div>
    </section>

    <script>
        // Мобильное меню
        const menuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');

        menuBtn.addEventListener('click', () => {
            navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
        });

        // Плавный скролл
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>