<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        /* 전체 페이지 스타일 */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* 카드 형태 컨테이너 */
        .dashboard {
            background: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 12px 0;
            font-size: 16px;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background: #3498db;
            color: white;
            transition: background 0.2s;
        }

        a:hover {
            background: #2980b9;
        }

        #secret::before {
            content: "admin_session=admin_secret_session_id";
            color: transparent;
            font-size: 0;
            display: block;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <p>This is your user dashboard.</p>
        <p><a href="admin.php">🔐 Try to access admin page</a></p>
        <p><a href="logout.php">🚪 Logout</a></p>

        <div id="secret"></div>
    </div>
</body>
</html>
