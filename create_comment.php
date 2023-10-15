<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'comments.php';
// Перевірка, чи користувач авторизований
if (!isUserLoggedIn()) {
    header('Location: index.php?action=home');
    exit;
}
$message = '';
$news_id = $_GET['news_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'];
    $author_id = $_SESSION['user_id'];
    // Виклик функції для створення коментаря
    if (createComment($text, $author_id, $news_id)) {
        $message = 'Коментар успішно створено';
    } else {
        $message = 'Помилка при створенні коментаря';
    }
    header('Location: index.php?action=get_news&id='.$news_id);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Створення коментаря</title>
    <!-- Включіть посилання на CSS-стилі тут -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Створення коментаря</h1>
    
    <?php echo $message; ?>
    <div class="create-comment-container">
        <form method="post" action="index.php?action=create_comment&news_id=<?php echo $news_id; ?>">
            <label>Текст коментаря:</label>
            <textarea name="text" rows="4" required></textarea><br>
        
            <button type="submit">Залишити коментар</button>
        </form>
    
        <p><a href="index.php?action=home" class = "return-button">На головну</a></p>
    </div>
</body>
</html>
