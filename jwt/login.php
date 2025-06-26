<?php
require 'jwt_helper.php';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin' && $password === 'adminpass') {
    $payload = ['username' => $username, 'role' => 'admin'];
} else {
    $payload = ['username' => $username, 'role' => 'user'];
}

$jwt = create_jwt($payload);
setcookie('token', $jwt, time() + 3600, '/');
header('Location: dashboard.php');
exit;
?>
