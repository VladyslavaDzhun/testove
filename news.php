<?php
require_once 'config.php';
// Створення нової новини
function createNews($title, $text, $author_id) {
    global $db;
    $query = "INSERT INTO news (title, text, author_id) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    return $stmt->execute([$title, $text, $author_id]);
}
// Отримання новини по id
function getNewById ($news_id) {
    global $db;
    $query = "SELECT * FROM news n
            INNER JOIN users u ON n.author_id = u.id
            WHERE n.id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$news_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    
}
// Отримання списку новин
function getNewsList() {
    global $db;
    $query = "SELECT n.id, n.title, n.text, u.name AS author FROM news n
              INNER JOIN users u ON n.author_id = u.id
              ORDER BY n.publish_date DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Видалення новини за ID
function deleteNews($news_id) {
    global $db;
    $query = "DELETE FROM news WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$news_id]);
}
// Редагування новини за ID
function editNews($news_id, $title, $text) {
    global $db;
    $query = "UPDATE news SET title = ?, text = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    return $stmt->execute([$title, $text, $news_id]);
}
?>
