<?php
require_once '../config/database.php';
require_once '../config/session.php';

// Require admin access
requireAdmin();

$user = getUserData();
$error = '';
$success = '';

// Get user ID from URL
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$user_id) {
    header('Location: /imk/admin/users.php');
    exit();
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$target_user = $stmt->fetch();

if (!$target_user) {
    header('Location: /imk/admin/users.php');
    exit();
}

// Fetch user's shipments
$stmt = $pdo->prepare("
    SELECT s.*, COUNT(sd.id) as item_count 
    FROM shipments s 
    LEFT JOIN shipment_details sd ON s.id = sd.shipment_id 
    WHERE s.user_id = ? 
    GROUP BY s.id 
    ORDER BY s.created_at DESC
");
$stmt->execute([$user_id]);
$shipments = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Logistics Maritime</title>
    <link rel="stylesheet" href="/imk/logistikmaritim/css/index.css">
    <style>
        .user-details-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .user-info {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .user-info h3 {
            margin-top: 0;
            color: #333;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        .info-item {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
        }
        .shipments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .shipments-table th,
        .shipments-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .shipments-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            display: inline-block;
        }
        .status-pending { background: #ffd700; color: #000; }
        .status-in-transit { background: #007bff; color: #fff; }
        .status-delivered { background: #28a745; color: #fff; }
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }
        .view-btn { background: #17a2b8; color: #fff; }
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">
                    <img src="/imk/logistikmaritim/image/logo.png" alt="logo" />
                </div>
                <span>Logistik Maritime - Admin</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/imk/index.php">Home</a></li>
                    <li><a href="/imk/admin/dashboard.php">Admin Dashboard</a></li>
                    <li><a href="/imk/admin/users.php" class="active">Manage Users</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <div class="user-menu">
                    <span>Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
                    <a href="/imk/logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="user-details-container">
        <a href="/imk/admin/users.php" class="back-btn">← Back to Users</a>
        
        <div class="user-info">
            <h3>User Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Name</div>
                    <div><?php echo htmlspecialchars($target_user['name']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div><?php echo htmlspecialchars($target_user['email']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Role</div>
                    <div><?php echo ucfirst(htmlspecialchars($target_user['role'])); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Member Since</div>
                    <div><?php echo date('F j, Y', strtotime($target_user['created_at'])); ?></div>
                </div>
            </div>
        </div>

        <h3>User's Shipments</h3>
        <?php if (empty($shipments)): ?>
            <p>No shipments found for this user.</p>
        <?php else: ?>
            <table class="shipments-table">
                <thead>
                    <tr>
                        <th>Tracking Number</th>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Status</th>
                        <th>Items</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipments as $shipment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($shipment['tracking_number']); ?></td>
                            <td><?php echo htmlspecialchars($shipment['origin']); ?></td>
                            <td><?php echo htmlspecialchars($shipment['destination']); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo strtolower($shipment['status']); ?>">
                                    <?php echo ucfirst(str_replace('_', ' ', $shipment['status'])); ?>
                                </span>
                            </td>
                            <td><?php echo $shipment['item_count']; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($shipment['created_at'])); ?></td>
                            <td>
                                <a href="/imk/view-shipment.php?id=<?php echo $shipment['id']; ?>" class="action-btn view-btn">View Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html> 