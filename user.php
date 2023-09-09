<?php
require_once 'config.php';
// Реєстрація нового користувача
function registerUser($name, $email, $password) {
    global $db;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    return $stmt->execute([$name, $email, $hashedPassword]);
}
// Вхід користувача
function loginUser($email, $password) {
    global $db;
    $query = "SELECT id, name, password FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        // Збереження даних користувача в сесії
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        return true;
    }
    return false;
}
// Вихід користувача
function logoutUser() {
    session_unset();
    session_destroy();
}
// Перевірка авторизації користувача
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Перевірка чи це адмін
function isAdmin ($user_id) {
    global $db;
    $query = "SELECT id, role FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && $user['role'] === 'admin') {
        return true;
    }

    return false;
}
?>
