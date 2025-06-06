<?php
require_once '../config/database.php';
require_once '../config/session.php';

// Require admin access
requireAdmin();

$user = getUserData();

// Fetch all shipments with user information
$stmt = $pdo->prepare("
    SELECT s.*, u.name as user_name, u.email as user_email,
           COUNT(sd.id) as item_count 
    FROM shipments s 
    LEFT JOIN users u ON s.user_id = u.id
    LEFT JOIN shipment_details sd ON s.id = sd.shipment_id 
    GROUP BY s.id 
    ORDER BY s.created_at DESC
");
$stmt->execute();
$shipments = $stmt->fetchAll();

// Fetch user statistics
$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users WHERE role = 'user'");
$userStats = $stmt->fetch();

$stmt = $pdo->query("SELECT COUNT(*) as total_shipments FROM shipments");
$shipmentStats = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Logistics Maritime</title>
    <link rel="stylesheet" href="/imk/logistikmaritim/css/index.css">
    <style>
        .admin-dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            margin: 0;
            color: #666;
        }
        .stat-card .number {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
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
        }
        .status-pending {
            background: #ffd700;
            color: #000;
        }
        .status-in-transit {
            background: #007bff;
            color: white;
        }
        .status-delivered {
            background: #28a745;
            color: white;
        }
        .status-cancelled {
            background: #dc3545;
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
        .view-btn {
            background: #17a2b8;
            color: white;
        }
        .edit-btn {
            background: #ffc107;
            color: #000;
        }
        .delete-btn {
            background: #dc3545;
            color: white;
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
                    <li><a href="/imk/admin/dashboard.php" class="active">Admin Dashboard</a></li>
                    <li><a href="/imk/admin/users.php">Manage Users</a></li>
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

    <div class="admin-dashboard-container">
        <h2>Admin Dashboard</h2>
        
        <div class="stats-container">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="number"><?php echo $userStats['total_users']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Shipments</h3>
                <div class="number"><?php echo $shipmentStats['total_shipments']; ?></div>
            </div>
        </div>

        <h3>All Shipments</h3>
        <table class="shipments-table">
            <thead>
                <tr>
                    <th>Tracking Number</th>
                    <th>User</th>
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
                        <td>
                            <?php echo htmlspecialchars($shipment['user_name']); ?><br>
                            <small><?php echo htmlspecialchars($shipment['user_email']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($shipment['origin']); ?></td>
                        <td><?php echo htmlspecialchars($shipment['destination']); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($shipment['status']); ?>">
                                <?php echo htmlspecialchars($shipment['status']); ?>
                            </span>
                        </td>
                        <td><?php echo $shipment['item_count']; ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($shipment['created_at'])); ?></td>
                        <td>
                            <a href="/imk/view-shipment.php?id=<?php echo $shipment['id']; ?>" class="action-btn view-btn">View</a>
                            <a href="/imk/edit-shipment.php?id=<?php echo $shipment['id']; ?>" class="action-btn edit-btn">Edit</a>
                            <a href="/imk/delete-shipment.php?id=<?php echo $shipment['id']; ?>" class="action-btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 