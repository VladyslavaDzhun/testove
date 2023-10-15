<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'news.php';
// Перевірка, чи користувач авторизований, та чи він адміністратор
if (!isUserLoggedIn()) {
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
    <div class="container">
        <h1  class = "title-news">Створення новини</h1>
        
        <?php echo $message; ?>
        <div class="create-news-container">
            <form method="post" action="index.php?action=create_news">
                <label class = "news-title">Заголовок:</label>
                <input type="text" name="title" required><br>
            
                <label class = "news-text">Текст:</label>
                <textarea name="text" rows="4" required></textarea><br>
            
                <button type="submit" class = "create-news-button">Створити новину</button>
            </form>
        
            <p><a href="index.php?action=home" class = "return-button">На головну</a></p>
        </div>
    </div>
</body>
</html>
