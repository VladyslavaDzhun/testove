<?php session_start(); 
require_once 'user.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Головна сторінка</title>
    <!-- Включіть посилання на ваші CSS-стилі тут -->
    <link href="css/style.css"  rel="stylesheet">
</head>
<body>
    <h1>Головна сторінка</h1>
    <!-- Перевірка наявності користувача і відображення відповідних елементів -->
    <?php if (isset($_SESSION['user_id'])) { ?>
        <p>Вітаємо, <?php echo $_SESSION['user_name']; ?>!</p>
        <?php if (isAdmin($_SESSION['user_id'])) { ?>
        <a href="index.php?action=create_news">Створити нову новину</a>
        <?php } ?>
        <a href="index.php?action=logout">Вийти</a>
    <?php } else { ?>
        <a href="index.php?action=login">Увійти</a>
        <a href="index.php?action=register">Зареєструватися</a>
    <?php } ?>
    
    <!-- Виведення списку новин -->
    <h2>Новини</h2>
 <?php
    // Отримання списку новин і виведення їх
    $newsList = getNewsList(); // Потрібно реалізувати функцію отримання списку новин
    if (!empty($newsList)) {
        foreach ($newsList as $news) {
            echo '<div>';
            echo '<h3> <a href="index.php?action=get_news&id='.$news["id"].'">' . $news['title'] . '</a></h3>';
            echo '<p>' . $news['text'] . '</p>';
            echo '<p>Автор: ' . $news['author'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>Немає новин.</p>';
    }
    ?>
    <script src="js/main.js"></script>
</body>
</html>
