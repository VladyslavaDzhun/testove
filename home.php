<?php session_start(); 
require_once 'user.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Головна сторінка</title>
    <!-- Включіть посилання на ваші CSS-стилі тут -->
    <link href="css/style.css"  rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="page">
        <div class="container">
            <h1 class = "header">Головна сторінка</h1>
            <!-- Перевірка наявності користувача і відображення відповідних елементів -->
            <?php if (isset($_SESSION['user_id'])) { ?>
                <p class = "vitaemo">Вітаємо, <?php echo $_SESSION['user_name']; ?>!</p>
                <a href="index.php?action=create_news" class = "news-button">Створити нову новину</a>
                <a href="index.php?action=logout" class = "logout-buttom">Вийти</a>
            <?php } else { ?>
                <div class="register-buttons">
                    <a href="index.php?action=login" class = "login-button">Увійти</a>
                    <a href="index.php?action=register" class = "register-button">Зареєструватися</a>
                </div>
            <?php } ?>
        
         <!-- Виведення списку новин -->
            <h2 class = "title-news">Новини</h2>
         
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
        </div>
    </div>     
    <script src="js/main.js"></script>
</body>
</html>
