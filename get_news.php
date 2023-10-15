<?php
session_start();
require_once 'news.php';
require_once 'comments.php';
require_once 'user.php';

echo '<link href="css/style.css"  rel="stylesheet">';
echo '<div class="page">';
echo '<div class="container">';
$news = getNewById($_GET['id']);
if (isUserLoggedIn() && isAuthor($_SESSION['user_id'], $news['author_id'])){
echo '<a href="index.php?action=edit_news&news_id='.$_GET['id'].'" class = "edit-news-button">Редагувати новину</a>';
echo '<form method="post" action="index.php?action=delete_news">';
echo '<input type="hidden" name="id" value='.$_GET['id'].' required><br>';
echo '<button type="submit" class = "delete-news-button">Видалити новину</button>';
echo '</form>';
}
echo '<div>';
echo '<h3>' . htmlentities($news['title'], ENT_QUOTES) . '</h3>';
echo '<p>' . htmlentities($news['text'], ENT_QUOTES) . '</p>';
echo '<p>Автор: ' . $news['name'] . '</p>';
echo '</div>';


?>
 <form method="post" action="index.php?action=create_comment&news_id=<?php echo $_GET['id']; ?>">
    <div class="create-comment-container">
        <label class = "comment-text">Текст коментаря:</label>
        <textarea name="text" rows="4" required></textarea><br>
        <button type="submit" class = "comment-button">Залишити коментар</button>
        <p><a href="index.php?action=home" class = "return-button">На головну</a></p>
    </div>
</form>

<!-- Виведення списку коментарів -->
<h2 class = "title-comment">Коментарі</h2>
 <?php
 // Отримання списку коментарів і виведення їх
 $commentList = getCommentsForNews($_GET['id']); // Потрібно реалізувати функцію отримання списку коментарів
 if (!empty($commentList)) {
     foreach ($commentList as $comment) {
         echo '<div>';
         if (isUserLoggedIn() && isAuthor($_SESSION['user_id'], $comment['author_id'])){
         echo '<a href="index.php?action=edit_comment&comment_id='.$comment['id'].'" class = "edit-comment-button">Редагувати коментар </a>';
         echo '<form method="post" action="index.php?action=delete_comment">';
        echo '<input type="hidden" name="id" value='.$comment['id'].' required><br>';
        echo '<button type="submit" class = "delete-comment-button">Видалити коментар</button>';
        echo '</form>';
         }
         echo '<p>' . htmlentities($comment['text'], ENT_QUOTES) . '</p>';
         echo '<p>Автор: ' . $comment['author'] . '</p>';
         echo '</div>';
     }
 } else {
     echo '<p class = "no-comment">Немає коментарів.</p>';
 }
    echo '</div>';
    echo '</div>';
 ?> 