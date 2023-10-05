<?php
session_start();
require_once 'news.php';
require_once 'comments.php';
require_once 'user.php';

$news = getNewById($_GET['id']);
if (isUserLoggedIn() && isAuthor($_SESSION['user_id'], $news['author_id'])){
echo '<a href="index.php?action=edit_news&news_id='.$_GET['id'].'">Редагувати новину</a>';
echo '<form method="post" action="index.php?action=delete_news">';
echo '<input type="hidden" name="id" value='.$_GET['id'].' required><br>';
echo '<button type="submit">Видалити новину</button>';
echo '</form>';
}
echo '<div>';
echo '<h3>' . $news['title'] . '</h3>';
echo '<p>' . $news['text'] . '</p>';
echo '<p>Автор: ' . $news['name'] . '</p>';
echo '</div>';
?>
 <form method="post" action="index.php?action=create_comment&news_id=<?php echo $_GET['id']; ?>">
        <label>Текст коментаря:</label>
        <textarea name="text" rows="4" required></textarea><br>
        
        <button type="submit">Залишити коментар</button>
    </form>
<!-- Виведення списку коментарів -->
<h2>Коментарі</h2>
 <?php
 // Отримання списку коментарів і виведення їх
 $commentList = getCommentsForNews($_GET['id']); // Потрібно реалізувати функцію отримання списку коментарів
 if (!empty($commentList)) {
     foreach ($commentList as $comment) {
         echo '<div>';
         if (isUserLoggedIn() && isAuthor($_SESSION['user_id'], $comment['author_id'])){
         echo '<a href="index.php?action=edit_comment&comment_id='.$comment['id'].'">Редагувати коментар </a>';
         echo '<form method="post" action="index.php?action=delete_comment">';
        echo '<input type="hidden" name="id" value='.$comment['id'].' required><br>';
        echo '<button type="submit">Видалити коментар</button>';
        echo '</form>';
         }
         echo '<p>' . htmlentities($comment['text'], ENT_QUOTES) . '</p>';
         echo '<p>Автор: ' . $comment['author'] . '</p>';
         echo '</div>';
     }
 } else {
     echo '<p>Немає коментарів.</p>';
 }
 ?> 