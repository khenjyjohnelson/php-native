<?php
require_once '../config/database.php';
require_once '../config/session.php';

// Require admin access
requireAdmin();

$user = getUserData();
$error = '';
$success = '';

// Handle user role updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['role'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $user_id]);
        $success = 'User role updated successfully!';
    } catch (Exception $e) {
        $error = 'Failed to update user role.';
    }
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Logistics Maritime</title>
    <link rel="stylesheet" href="/me/php-native/logistikmaritim/css/index.css">
    <style>
        .users-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .users-table th,
        .users-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .users-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .role-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
        }

        .role-admin {
            background: #007bff;
            color: white;
        }

        .role-user {
            background: #6c757d;
            color: white;
        }

        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background: #ffc107;
            color: #000;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">
                    <img src="/me/php-native/logistikmaritim/image/logo.png" alt="logo" />
                </div>
                <span>Logistik Maritime - Admin</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/me/php-native/index.php">Home</a></li>
                    <li><a href="/me/php-native/admin/dashboard.php">Admin Dashboard</a></li>
                    <li><a href="/me/php-native/admin/users.php" class="active">Manage Users</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <div class="user-menu">
                    <span>Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
                    <a href="/me/php-native/logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="users-container">
        <h2>Manage Users</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <table class="users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                <select name="role" onchange="this.form.submit()" <?php echo $u['id'] === $user['id'] ? 'disabled' : ''; ?>>
                                    <option value="user" <?php echo $u['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo $u['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td><?php echo date('Y-m-d H:i', strtotime($u['created_at'])); ?></td>
                        <td>
                            <a href="/me/php-native/admin/view-user.php?id=<?php echo $u['id']; ?>" class="action-btn edit-btn">View Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>