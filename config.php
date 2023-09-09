<?php
// Параметри для підключення до бази даних
$host = 'localhost';         // Адреса сервера бази даних
$dbname = 'testove';   // Назва бази даних
$username = 'root'; // Ім'я користувача бази даних
$password = ''; // Пароль користувача бази даних
// Підключення до бази даних
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Налаштування обробки помилок для PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>
