<?php
require_once 'news.php';
require_once 'comments.php';

$news = getNewById($_GET['id']);
echo '<div>';
echo '<h3>' . $news['title'] . '</h3>';
echo '<p>' . $news['text'] . '</p>';
echo '<p>Автор: ' . $news['name'] . '</p>';
echo '</div>';
?>

<!-- Виведення списку коментарів -->
<h2>Коментарі</h2>
 <?php
 // Отримання списку коментарів і виведення їх
 $commentList = getCommentsForNews($_GET['id']); // Потрібно реалізувати функцію отримання списку коментарів
 if (!empty($commentList)) {
     foreach ($commentList as $comment) {
         echo '<div>';
         echo '<p>' . $comment['text'] . '</p>';
         echo '<p>Автор: ' . $comment['author'] . '</p>';
         echo '</div>';
     }
 } else {
     echo '<p>Немає коментарів.</p>';
 }
 ?> 