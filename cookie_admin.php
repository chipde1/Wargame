<?php
session_start();

$admin_session_id = 'admin';

if (isset($_COOKIE['PHPSESSID']) && $_COOKIE['PHPSESSID'] === $admin_session_id) {
    echo "<h1>🎉 Welcome, Admin!</h1>";
    echo "<p>FLAG: FLAG{2dccd1ab3e03990aea77359831c85ca2}</p>";
    echo '<p><a href="logout.php">Logout</a></p>';
} else {
    echo "<h2>Access Denied</h2>";
    echo "<p>You are not the admin.</p>";
    echo '<p><a href="index.php">Back</a></p>';
}
