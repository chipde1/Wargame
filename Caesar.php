<?php
// 복호화된 패스워드 (정답)
$correct_password = 'secretpassword';

// 사용자가 제출한 패스워드 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = trim($_POST['password_input']);
    
    if ($user_input === $correct_password) {
        $message = "flag{b712916d8bfc1718a431c7b4fa280ae6} 🎉"; #caesar md5
    } else {
        $message = "틀렸습니다. 다시 시도하세요.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wargame - 패스워드 복호화</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 2.5em;
            color: #4CAF50;
        }

        section {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .links a:hover {
            background-color: #0056b3;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }

        form input {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #218838;
        }

        .message {
            margin-top: 20px;
            font-size: 1.2em;
            color: #ff5722;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>Wargame - 패스워드 복호화</h1>
    </header>

    <section>
        <p>I am Julius Caesar</p>

        <div class="links">
            <a href="#" id="password">password</a>
        </div>

        <div id="encryptedPassword" style="display: none;">
            <p><strong>encryptedPassword: </strong>xjhwjyufxxbtwi</p>
        </div>

        <form action="caesar.php" method="POST">
            <label for="password_input">복호화된 패스워드를 입력하세요:</label>
            <input type="text" id="password_input" name="password_input" required>
            <button type="submit">제출</button>
        </form>

        <?php if (isset($message)) { ?>
            <div class="message"><?= $message ?></div>
        <?php } ?>
    </section>

    <footer>
        <p>© 2025 Wargame</p>
    </footer>

    <script>
        document.getElementById('password').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('encryptedPassword').style.display = 'block'; 
        });
    </script>
</body>
</html>
