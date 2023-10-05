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
    <link href="css/style.css"  rel="stylesheet">
    
</head>
<body>
    <div class="form-container">
        <h1 class = "form-title">Вхід</h1>
        
        <?php echo $message; ?>
        <div class="login">
            <form method="post" action="index.php?action=login">
                <label>Email:</label>
                <input type="email" name="email" class="login-input" required><br>
                
                <label>Пароль:</label>
                <input type="password" name="password" class="password-input" required><br>
                
                <button type="submit" class="submit-button">Увійти</button>
            </form>
        </div>
        <p>Не маєте акаунта? <a href="index.php?action=register" class="register-link">Зареєструйтесь</a></p>
    </div>    
</body>
</html>
