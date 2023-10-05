<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'news.php';
// Перевірка, чи користувач авторизований та чи він адміністратор
if (!isUserLoggedIn()) {
    header('Location: index.php?action=home');
    exit;
}
$message = '';
$news_id = $_GET['news_id'];
// Отримання даних про новину
$news = getNewById($news_id);
if (!isAuthor($_SESSION['user_id'], $news['author_id']) ) {
    header('Location: index.php?action=home');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $text = $_POST['text'];
    // Виклик функції для редагування новини
    if (editNews($news_id, $title, $text)) {
        $message = 'Новину успішно відредаговано';
        $news['title'] = $title;
        $news['text'] = $text;
    } else {
        $message = 'Помилка при редагуванні новини';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редагування новини</title>
    <!-- Включіть посилання на CSS-стилі тут -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагування новини</h1>
    
    <?php echo $message; ?>
    
    <form method="post" action="index.php?action=edit_news&news_id=<?php echo $news_id; ?>">
        <label>Заголовок:</label>
        <input type="text" name="title" value="<?php echo $news['title']; ?>" required><br>
        
        <label>Текст:</label>
        <textarea name="text" rows="4" required><?php echo $news['text']; ?></textarea><br>
        
        <button type="submit">Зберегти зміни</button>
    </form>
    
    <p><a href="index.php?action=home">На головну</a></p>
</body>
</html>
