<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$repo = new UserRepository($pdo);
$user = $repo->findByUsername($username);

if (!$user) {
    $_SESSION['error'] = 'Пользователь не найден';
    header('Location: views/login.php');
    exit;
}

if ($user->password !== $password) {
    $_SESSION['error'] = 'Неверный пароль';
    header('Location: views/login.php');
    exit;
}

$_SESSION['user_id'] = $user->id;
$_SESSION['user_role'] = $user->role;
$_SESSION['username'] = $user->username;

header('Location: /PhpstormProjects/logistics_crm/controllers/counterparties_controller.php');