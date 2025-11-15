<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeNails | Портфолио</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #fff5f7;
            color: #3d3d3d;
        }

        .header {
            background: linear-gradient(45deg, #ff758c, #ff7eb3);
            padding: 2rem 0;
            box-shadow: 0 4px 20px rgba(255, 118, 140, 0.2);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 10%, transparent 70%);
            transform: rotate(30deg);
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: white;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .gallery-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 20px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }

        .nail-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: pointer;
            background: white;
        }

        .nail-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(255, 118, 140, 0.3);
        }

        .nail-card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .nail-card:hover img {
            transform: scale(1.05);
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 1.5rem;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .nail-card:hover .card-overlay {
            opacity: 1;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 2rem 0;
            background: #fff;
            margin-top: 3rem;
        }

        .social-icon {
            font-size: 1.8rem;
            color: #ff758c;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
            color: #ff7eb3;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            
            .logo {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <?php require_once "blocks/header.php";?>
        <h1 class="logo">LuxeNails✨ Галерея работ</h1>
    </header>

    <main class="gallery-container">
        <div class="gallery-grid">
            <!-- Пример работы 1 -->
            <div class="nail-card">
                <img src="https://estelife-clinic.ru/storage/images/services/2023/09/14/E3aivXQXJy0oM63IzSzwPT0iyMlazrD3x3swcj7M.jpg" alt="Нейл-арт 1">
                <div class="card-overlay">
                    <h3>Французский маникюр с стразами</h3>
                    <p>Гель-лак, дизайн Swarovski</p>
                </div>
            </div>

            <!-- Пример работы 2 -->
            <div class="nail-card">
                <img src="https://avatars.mds.yandex.net/i?id=f757ea187033b19cfd5a648df85ae158_l-8219873-images-thumbs&n=13" alt="Нейл-арт 2">
                <div class="card-overlay">
                    <h3>Мраморный френч</h3>
                    <p>Комбинированная техника, ручная роспись</p>
                </div>
            </div>
            <!-- Пример работы 3 -->
            <div class="nail-card">
                <img src="https://i.pinimg.com/736x/61/ec/13/61ec13b6a6bd1c4ca1d15bd2aadb1ecb.jpg" alt="Нейл-арт 2">
                <div class="card-overlay">
                    <h3>Мраморный френч</h3>
                    <p>Комбинированная техника, ручная роспись</p>
                </div>
            </div>

            <!-- Добавьте больше работ по аналогии -->
        </div>
    </main>

    <footer>
        <div class="social-links">
            <a href="#"><i class="fab fa-instagram social-icon"></i></a>
            <a href="#"><i class="fab fa-whatsapp social-icon"></i></a>
            <a href="#"><i class="far fa-envelope social-icon"></i></a>
        </div>
    </footer>
</body>
</html>