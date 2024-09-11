<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure To-Do List Application</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <h2>Secure To-Do List Application</h2>
            <?php if (isset($_SESSION['username'])): ?>
                <nav>
                    <a href="dashboard.php">Dashboard</a> | 
                    <a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a>
                </nav>
            <?php else: ?>
                <nav>
                    <a href="login.php">Login</a> | 
                    <a href="signup.php">Sign Up</a>
                </nav>
            <?php endif; ?>
        </header>
        <hr>
