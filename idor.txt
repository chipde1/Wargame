<?php
session_start();

// DB 연결
$host = 'localhost';
$user = 'war';
$pass = 'kim06418';
$dbname = 'idor';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// 최초 실행 시 사용자 테이블 생성 및 샘플 데이터 삽입
$conn->query("CREATE TABLE IF NOT EXISTS users (
    num INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    role VARCHAR(20),
    flag TEXT
)");
$res = $conn->query("SELECT COUNT(*) as cnt FROM users");
$row = $res->fetch_assoc();
if ($row['cnt'] == 0) {
    $conn->query("INSERT INTO users (username, password, role, flag) VALUES
        ('irene', 'sher', 'user', NULL),
        ('sherlock', 'watson', 'user', NULL),
        ('john', 'johnpass', 'user', NULL),
        ('jane', 'janepass', 'user', NULL),
        ('moriarty', 'evilpass', 'user', NULL),
        ('watson', 'trustpass', 'user', NULL),
        ('hudson', 'housepass', 'user', NULL),
        ('lestrade', 'detective', 'user', NULL),
        ('mycroft', 'govpass', 'user', NULL),
        ('irregulars', 'pass', 'user', NULL),
        ('moran', 'sniperpass', 'user', NULL),
        ('gregson', 'officerpass', 'user', NULL),
        ('shadow_admin', 'adminpass', 'admin', 'FLAG{1bea3a3d4bc3be1149a75b33fb8d82bc}')
    ");
}


// 로그인 처리
$login_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $res = $conn->query($sql);
    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        $_SESSION['user_num'] = $user['num'];
        header("Location: ?num=" . $user['num']);
        exit;
    } else {
        $login_error = "❌ 로그인 실패! 사용자명 또는 비밀번호가 잘못되었습니다.";
    }
}

// 로그아웃 처리
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>🕵️ IDOR Wargame: Sherlock Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e1e;
            background-image: url('https://images.unsplash.com/photo-1600508771380-7cc3d4e3c5f9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-attachment: fixed;
            color: #f8f9fa;
            font-family: 'Cinzel', serif;
            padding-top: 60px;
        }
        .container {
            max-width: 600px;
            background-color: rgba(30, 30, 30, 0.92);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px #000;
        }
        .btn-primary {
            background-color: #6c757d;
            border: none;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        h2 {
            text-align: center;
            color: #ffc107;
        }
        .flag {
            background-color: #2d2d2d;
            border-left: 5px solid #ffc107;
            color: #ffc107;
            font-weight: bold;
        }
        .list-group-item {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #f1f1f1;
        }
        label {
            color: #ccc;
        }
        .form-control {
            background-color: #2e2e2e;
            color: #fff;
            border: 1px solid #555;
        }
        .alert {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
<div class="container">
<img src="https://i.redd.it/zqs69kw3cmv91.jpg">
</a>
<?php if (!isset($_SESSION['user_num'])): ?>
    <h2 class="mb-4">🔍 로그인</h2>
    <?php if ($login_error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">사용자명</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">비밀번호</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">🕵️ 로그인</button>
    </form>

<?php else:

    $num = $_GET['num'] ?? $_SESSION['user_num'];
    $sql = "SELECT num, username, role, flag FROM users WHERE num = '$num'";
    $res = $conn->query($sql);
    ?>
    <h2 class="mb-4">👁️‍🗨️ 사용자 조사</h2>

    <?php if ($res && $res->num_rows === 1):
        $user = $res->fetch_assoc(); ?>
        <ul class="list-group">
            <li class="list-group-item">🆔 ID: <?= htmlspecialchars($user['num']) ?></li>
            <li class="list-group-item">👤 이름: <?= htmlspecialchars($user['username']) ?></li>
            <li class="list-group-item">🔒 역할: <?= htmlspecialchars($user['role']) ?></li>
            <?php if ($user['flag']): ?>
                <li class="list-group-item flag">🏁 FLAG: <?= htmlspecialchars($user['flag']) ?></li>
            <?php endif; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-warning mt-3">❓ 사용자 정보를 찾을 수 없습니다.</div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="?logout=1" class="btn btn-outline-danger">🚪 로그아웃</a>
    </div>
<?php endif; ?>

</div>
</body>
</html>
