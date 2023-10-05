<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'comments.php';
// Перевірка, чи користувач авторизований та чи він адміністратор
if (!isUserLoggedIn()) {
    header('Location: index.php?action=home');
    exit;
}
$message = '';
$comment_id = $_GET['comment_id'];
// Отримання даних про коментар
$comment = getCommentById($comment_id);
if (!isAuthor($_SESSION['user_id'], $comment['author_id']) ) {
    header('Location: index.php?action=home');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'];
    // Виклик функції для редагування коментаря
    if (editComment($comment_id, $text)) {
        $message = 'Коментар успішно відредаговано';
        $comment['text'] = $text;
    } else {
        $message = 'Помилка при редагуванні коментаря';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редагування коментаря</title>
    <!-- Включіть посилання на CSS-стилі тут -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Редагування коментаря</h1>
    
    <?php echo $message; ?>
    
    <form method="post" action="index.php?action=edit_comment&comment_id=<?php echo $comment_id; ?>">
        <label>Текст коментаря:</label>
        <textarea name="text" rows="4" required><?php echo $comment['text']; ?></textarea><br>
        
        <button type="submit">Зберегти зміни</button>
    </form>
    
    <p><a href="index.php?action=home">На головну</a></p>
</body>
</html>
