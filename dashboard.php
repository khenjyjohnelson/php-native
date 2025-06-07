<?php
require_once 'config/database.php';
require_once 'config/session.php';

$pdo = Database::getInstance()->getConnection();

function requireLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: /me/php-native/login.php');
        exit;
    }
}

// Ensure user is logged in
requireLogin();

$user = getUserData();

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of shipments per page
$offset = ($page - 1) * $limit;

try {
    // Fetch user's shipments with pagination
    $stmt = $pdo->prepare("
        SELECT s.*, COUNT(sd.id) as item_count 
        FROM shipments s 
        LEFT JOIN shipment_details sd ON s.id = sd.shipment_id 
        WHERE s.user_id = ? 
        GROUP BY s.id 
        ORDER BY s.created_at DESC
        LIMIT ? OFFSET ?
    ");
    $stmt->execute([$user['id'], $limit, $offset]);
    $shipments = $stmt->fetchAll();

    // Total shipments for pagination
    $totalStmt = $pdo->prepare("SELECT COUNT(*) as total FROM shipments WHERE user_id = ?");
    $totalStmt->execute([$user['id']]);
    $totalShipments = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalShipments / $limit);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Logistics Maritime</title>
    <link rel="stylesheet" href="/me/php-native/logistikmaritim/css/index.css">
    <style>
        /* Styles from original code */
        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .new-shipment-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .new-shipment-btn:hover {
            background: #0056b3;
        }

        .shipments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .no-shipments {
            text-align: center;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a.active {
            background: #0056b3;
        }

        .pagination a:hover {
            background: #0056b3;
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
                <span>Logistik Maritime</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/me/php-native/index.php">Beranda</a></li>
                    <li><a href="/me/php-native/dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/informasi.html">Jadwal Pengiriman</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/kontak.html">Kontak Kami</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <div class="user-menu">
                    <span>Welcome, <?php echo isset($user['name']) ? htmlspecialchars($user['name']) : 'User'; ?></span>
                    <a href="/me/php-native/logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container" style="margin-top: 100px;">
        <div class="dashboard-header">
            <h2>Welcome, <?php echo isset($user['name']) ? htmlspecialchars($user['name']) : 'User'; ?>!</h2>
            <a href="/me/php-native/new-shipment.php" class="new-shipment-btn">Create New Shipment</a>
        </div>

        <?php if (empty($shipments)): ?>
            <div class="no-shipments">
                <h3>No shipments found</h3>
                <p>Start by creating your first shipment!</p>
            </div>
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
                                    <?php echo htmlspecialchars($shipment['status']); ?>
                                </span>
                            </td>
                            <td><?php echo $shipment['item_count']; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($shipment['created_at'])); ?></td>
                            <td>
                                <a href="/me/php-native/view-shipment.php?id=<?php echo $shipment['id']; ?>"
                                    class="action-btn view-btn"
                                    aria-label="View shipment <?php echo htmlspecialchars($shipment['tracking_number']); ?>">
                                    View
                                </a>
                                <a href="/me/php-native/edit-shipment.php?id=<?php echo $shipment['id']; ?>"
                                    class="action-btn edit-btn"
                                    aria-label="Edit shipment <?php echo htmlspecialchars($shipment['tracking_number']); ?>">
                                    Edit
                                </a>
                                <a href="/me/php-native/delete-shipment.php?id=<?php echo $shipment['id']; ?>"
                                    class="action-btn delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this shipment?');"
                                    aria-label="Delete shipment <?php echo htmlspecialchars($shipment['tracking_number']); ?>">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="/me/php-native/dashboard.php?page=<?php echo $i; ?>"
                        class="<?php echo $i === $page ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="/me/php-native/logistikmaritim/js/script.js"></script>
</body>

</html>