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
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Виклик функції для перевірки входу користувача
    if (loginUser($email, $password)) {
        header('Location: index.php?action=home');
        exit;
    } else {
        $message = 'Неправильний email або пароль';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Вхід</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Вхід</h1>
    
    <?php echo $message; ?>
    
    <form method="post" action="index.php?action=login">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        
        <button type="submit">Увійти</button>
    </form>
    
    <p>Не маєте акаунта? <a href="index.php?action=register">Зареєструйтесь</a></p>
</body>
</html>
