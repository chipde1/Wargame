<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>버퍼 오버플로우 인증 우회 시뮬레이션</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <h1>버퍼 오버플로우 인증 우회 시뮬레이션</h1>

    <div class="container">
        <form method="POST" action="">
            <label for="username">아이디:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">비밀번호:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">로그인</button>
        </form>

        <div class="output">
            <?php
            // PHP 코드: 로그인 처리 및 버퍼 오버플로우 유도
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // 올바른 비밀번호 길이보다 길면 버퍼 오버플로우 발생
                if (strlen($password) > 64) {
                    echo "<p><strong>성공:</strong> 버퍼 오버플로우 성공! 인증 우회되었습니다. flag{4ce61ca473e0a8f2fdbb857a0a53b5bc}</p>";
                } else {
                    // 예시: 특정 사용자와 비밀번호가 일치하면 인증 성공
                    if ($username === 'admin' && $password === 'adminpasword123') {
                        echo "<p><strong>성공:</strong> 인증 성공! flag{4ce61ca473e0a8f2fdbb857a0a53b5bc}</p>";
                    } else {
                        echo "<p><strong>실패:</strong> 인증 실패. 다시 시도해 보세요.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>

</body>
</html>
