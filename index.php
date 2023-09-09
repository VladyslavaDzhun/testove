<?php
// Підключення файлу конфігурації та інших необхідних файлів
require_once 'config.php';
require_once 'news.php';
// Обробка вхідних запитів
$action = isset($_GET['action']) ? $_GET['action'] : 'home';
switch ($action) {
    case 'home':
        // Відображення головної сторінки
        include 'home.php';
        break;
    case 'login':
        // Обробка входу користувача
        include 'login.php';
        break;
    case 'logout':
        // Обробка виходу користувача
        include 'logout.php';
        break;
    case 'register':
        // Обробка реєстрації користувача
        include 'register.php';
        break;
    case 'create_news':
        // Створення нової новини
        include 'create_news.php';
        break;
    case 'get_news':
        //  Отримання новини по id
        include 'get_news.php';
        break;
    // case 'create_comment':
    //     // Створення нового коментаря
    //     include 'create_comment.php';
    //     break;
    // // Додаткові дії та маршрути можна додати тут
    default:
        // Відображення сторінки 404, якщо дія не знайдена
        include '404.php';
        break;
}
?>
