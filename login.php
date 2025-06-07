<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Redirect if already logged in
if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        // Get user from database
        $sql = "SELECT * FROM users WHERE username = ? AND status = 'active' LIMIT 1";
        $user = get_row($sql, 's', [$username]);

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            set_session_data('user_id', $user['id']);
            set_session_data('username', $user['username']);
            set_session_data('user_role', $user['role']);
            set_session_data('user_data', [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'full_name' => $user['full_name'],
                'role' => $user['role']
            ]);

            // Log activity
            $sql = "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) VALUES (?, 'login', 'User logged in', ?, ?)";
            execute_query($sql, 'iss', [
                $user['id'],
                $_SERVER['REMOTE_ADDR'],
                $_SERVER['HTTP_USER_AGENT']
            ]);

            // Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Invalid username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Logistics Maritime</title>
    <link rel="stylesheet" href="logistikmaritim/login/login.css">
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Image/Info -->
        <div class="login-image-section">
            <div class="image-overlay">
                <div class="image-content">
                    <h2>Selamat Datang Kembali!</h2>
                    <p>Masuk untuk mengelola pengiriman Anda dan nikmati layanan logistik maritim terbaik.</p>
                    <div class="benefits-list">
                        <div class="benefit-item">
                            <span class="benefit-icon">🚢</span>
                            <div class="benefit-text">
                                <h4>Pelacakan Real-Time</h4>
                                <p>Lacak status pengiriman kapan saja</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">🔒</span>
                            <div class="benefit-text">
                                <h4>Akun Aman</h4>
                                <p>Keamanan data dan privasi terjamin</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <span class="benefit-icon">⚡</span>
                            <div class="benefit-text">
                                <h4>Respon Cepat</h4>
                                <p>Dukungan pelanggan 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-form-section">
            <div class="form-container">
                <!-- Logo -->
                <div class="logo-section">
                    <div class="logo">
                        <div class="logo-icon">
                            <img src="/me/php-native/logistikmaritim/image/logo.png" alt="Logo" height="50">
                        </div>
                        <div class="logo-text">
                            <h1>Logistics Maritime</h1>
                        </div>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="login-form">
                    <h2>Masuk ke Akun Anda</h2>
                    <p class="form-subtitle">Silakan login untuk melanjutkan</p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="" class="auth-form" novalidate>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Ingat saya</label>
                            </div>
                        </div>
                        <button type="submit" class="btn-login">Login</button>
                    </form>
                    <div class="register-link">
                        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>