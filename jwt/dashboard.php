<?php
require 'jwt_helper.php';

if (!isset($_COOKIE['token'])) {
    die("로그인이 필요합니다.");
}

$payload = verify_jwt($_COOKIE['token']);
if (!$payload) {
    die("유효하지 않은 토큰입니다.");
}

echo "<h2>안녕하세요, {$payload['username']}님!</h2>";
echo "<p>당신의 권한은: <strong>{$payload['role']}</strong></p>";

if ($payload['role'] === 'admin') {
    echo "<h3>FLAG{cfd61b8a7397fa7c10b2ae548f5bfaef}</h3>";
} else {
    echo "<p>이 페이지는 관리자만 볼 수 있습니다.</p>";
}
?>
