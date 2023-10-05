<?php
require_once 'config.php';
// Створення нового коментаря
function createComment($text, $author_id, $news_id) {
    global $db;
    $query = "INSERT INTO comments (text, author_id, news_id) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    return $stmt->execute([$text, $author_id, $news_id]);
}
// Отримання списку коментарів для конкретної новини
function getCommentsForNews($news_id) {
    global $db;
    $query = "SELECT c.id, c.text, u.name AS author, c.author_id FROM comments c
              INNER JOIN users u ON c.author_id = u.id
              WHERE c.news_id = ?
              ORDER BY c.created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute([$news_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCommentById($comment_id) {
    global $db;
    $query = "SELECT * from comments WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$comment_id]);
    return $stmt->fetch();
}
// Видалення коментаря за ID
function deleteComment($comment_id) {
    global $db;
    $query = "DELETE FROM comments WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$comment_id]);
}
// Редагування коментаря за ID
function editComment($comment_id, $text) {
    global $db;
    $query = "UPDATE comments SET text = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$text, $comment_id]);
}
?>
