<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    if ($username === 'user') {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        $_SESSION['is_admin'] = false;
        header('Location: index.php');
        exit;
    } else {
        $error = "Only 'user' login is allowed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <button type="submit">Login</button>
    </form>
</body>
</html>
