<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'comments.php';
if (!isUserLoggedIn()) {
    header('Location: index.php?action=home');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = getCommentById($_POST['id']);
    if (!isAuthor($_SESSION['user_id'], $comment['author_id']) ) {
        header('Location: index.php?action=home');
        exit;
    }
    deleteComment($_POST['id']);
    header('Location: index.php?action=get_news&id='.$comment['news_id']);
} else {
    header('Location: index.php?action=home');
    exit;
}


