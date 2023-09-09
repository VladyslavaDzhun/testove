<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'news.php';
// Перевірка, чи користувач авторизований, та чи він адміністратор
if (!isUserLoggedIn() || !isAdmin($_SESSION['user_id'])) {
    header('Location: index.php?action=home');
    exit;
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $author_id = $_SESSION['user_id'];
    // Виклик функції для створення новини
    if (createNews($title, $text, $author_id)) {
        $message = 'Новину успішно створено';
    } else {
        $message = 'Помилка при створенні новини';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Створення новини</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Створення новини</h1>
    
    <?php echo $message; ?>
    
    <form method="post" action="index.php?action=create_news">
        <label>Заголовок:</label>
        <input type="text" name="title" required><br>
        
        <label>Текст:</label>
        <textarea name="text" rows="4" required></textarea><br>
        
        <button type="submit">Створити новину</button>
    </form>
    
    <p><a href="index.php?action=home">На головну</a></p>
</body>
</html>
