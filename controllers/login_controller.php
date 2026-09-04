<?php
session_start();

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/login_model.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

$errors = [];

if ($email === '') {
    $errors['email'] = 'Email is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format.';
}

if ($password === '') {
    $errors['password'] = 'Password is required.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['oldEmail'] = $email;

    header('Location: ../views/login.php');
    exit;
}

$user = getUser($pdo, $email);

// if (!$user || !password_verify($password, $user['password'])) {
//     $_SESSION['login_errors'] = ['general' => 'Invalid email or password.'];
//     $_SESSION['old_email'] = $email;
//     header('Location: ../views/login.php');
//     exit;
// }

if (!$user || $password!==$user["password"]) {
    $errors["email"] = "Email or password incorrect";
    $errors["password"] = "Email or password incorrect";

    $_SESSION['errors'] = $errors;
    $_SESSION['oldEmail'] = $email;

    header('Location: ../views/login.php');
    exit;
}


session_regenerate_id(true);
$_SESSION['id'] = $user['id'];
$_SESSION['email'] = $user['email'];

header('Location: ../views/dashboard.php');
exit;