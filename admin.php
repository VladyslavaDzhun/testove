<?php
require_once 'config.php';
require_once 'user.php'; // Підключення для перевірки ролі користувача
// Видалення коментаря за ID
function deleteCommentByAdmin($comment_id) {
    global $db;
    $query = "DELETE FROM comments WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$comment_id]);
}
// Редагування коментаря за ID
function editCommentByAdmin($comment_id, $text) {
    global $db;
    $query = "UPDATE comments SET text = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$text, $comment_id]);
}
// Видалення новини за ID
function deleteNewsByAdmin($news_id) {
    global $db;
    $query = "DELETE FROM news WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$news_id]);
}
// Редагування новини за ID
function editNewsByAdmin($news_id, $title, $text) {
    global $db;
    $query = "UPDATE news SET title = ?, text = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$title, $text, $news_id]);
}
// Видалення користувача за ID
function deleteUserByAdmin($user_id) {
    global $db;
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$user_id]);
}
?>
