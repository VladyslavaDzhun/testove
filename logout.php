<?php
session_start();
require_once 'user.php';
logoutUser();
header('Location: index.php?action=login');
?>