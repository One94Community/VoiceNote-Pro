<?php
session_start();

// Hardcoded credentials for demo (In real app, use database)
// NEVER store passwords in plain text in production!
$valid_username = 'admin';
$valid_password_hash = password_hash('admin123', PASSWORD_DEFAULT); // Hash your password

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // In a real app, fetch hash from database based on $username
    if ($username === $valid_username && password_verify($password, $valid_password_hash)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: index.php'); // Redirect to main app
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - VoiceNote Pro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #4f46e5; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #4338ca; }
        .error { color: red; margin-top: 15px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>VoiceNote Pro Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>