<?php
session_start();
require_once 'config.php';
require_once 'user.php';
require_once 'news.php';
if (!isUserLoggedIn()) {
    header('Location: index.php?action=home');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news = getNewById($_POST['id']);
    if (!isAuthor($_SESSION['user_id'], $news['author_id']) ) {
        header('Location: index.php?action=home');
        exit;
    }
    deleteNews($_POST['id']);
    header('Location: index.php?action=home');
} else {
    header('Location: index.php?action=home');
    exit;
}