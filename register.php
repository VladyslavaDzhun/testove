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
    <div class="form-container">
        <h1 class = "form-title">Реєстрація</h1>
    
    <?php echo $message; ?>
        <div class="register">
            <form method="post" action="index.php?action=register">
                <label>Ім'я:</label>
                <input type="text" name="name" class = "name-input" required><br>
        
                <label>Email:</label>
                <input type="email" name="email" class = "login-input" required><br>
        
                 <label>Пароль:</label>
                <input type="password" name="password" class = "password-input" required><br>
        
             <button type="submit" class = "submit-button">Зареєструватися</button>
            </form>
        </div>
    <p>Вже маєте акаунт? <a href="index.php?action=login" class = "register-link">Увійдіть</a></p>
    </div>
</body>
</html>
