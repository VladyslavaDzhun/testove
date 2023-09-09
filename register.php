<?php
session_start();
require_once 'config.php';
require_once 'user.php';
// Перевірка, чи користувач вже увійшов, і перенаправлення на головну сторінку
if (isset($_SESSION['user_id'])) {
    header('Location: index.php?action=home');
    exit;
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Виклик функції для реєстрації користувача
    if (registerUser($name, $email, $password)) {
        // Успішна реєстрація - перенаправлення на сторінку входу
        header('Location: index.php?action=login');
        exit;
    } else {
        $message = 'Помилка реєстрації';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Реєстрація</h1>
    
    <?php echo $message; ?>
    
    <form method="post" action="index.php?action=register">
        <label>Ім'я:</label>
        <input type="text" name="name" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        
        <button type="submit">Зареєструватися</button>
    </form>
    
    <p>Вже маєте акаунт? <a href="index.php?action=login">Увійдіть</a></p>
</body>
</html>
