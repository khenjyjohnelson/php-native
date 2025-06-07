<?php
require_once 'config/database.php';
require_once 'config/session.php';

requireLogin();
$user = getUserData();

$shipment_id = $_GET['id'] ?? null;
if (!$shipment_id) {
    header('Location: /me/php-native/dashboard.php');
    exit();
}

// Fetch shipment details
$stmt = $pdo->prepare("SELECT * FROM shipments WHERE id = ? AND user_id = ?");
$stmt->execute([$shipment_id, $user['id']]);
$shipment = $stmt->fetch();

if (!$shipment) {
    header('Location: /me/php-native/dashboard.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        // Delete tracking history
        $stmt = $pdo->prepare("DELETE FROM shipment_tracking WHERE shipment_id = ?");
        $stmt->execute([$shipment_id]);

        // Delete shipment details
        $stmt = $pdo->prepare("DELETE FROM shipment_details WHERE shipment_id = ?");
        $stmt->execute([$shipment_id]);

        // Delete shipment
        $stmt = $pdo->prepare("DELETE FROM shipments WHERE id = ? AND user_id = ?");
        $stmt->execute([$shipment_id, $user['id']]);

        $pdo->commit();
        $success = 'Shipment deleted successfully!';
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = 'Failed to delete shipment. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Shipment - Logistics Maritime</title>
    <link rel="stylesheet" href="/me/php-native/logistikmaritim/css/index.css">
    <style>
        .delete-shipment-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }

        .shipment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            margin-bottom: 10px;
        }

        .detail-label {
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

        .delete-form {
            margin-top: 20px;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cancel-btn {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-left: 10px;
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
    <div class="delete-shipment-container">
        <h2>Delete Shipment</h2>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
                <br>
                <a href="/me/php-native/dashboard.php">Return to Dashboard</a>
            </div>
        <?php else: ?>
            <div class="shipment-details">
                <div class="detail-row">
                    <div class="detail-label">Tracking Number:</div>
                    <div><?php echo htmlspecialchars($shipment['tracking_number']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Status:</div>
                    <div>
                        <span class="status-badge status-<?php echo strtolower($shipment['status']); ?>">
                            <?php echo htmlspecialchars($shipment['status']); ?>
                        </span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Origin:</div>
                    <div><?php echo htmlspecialchars($shipment['origin']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Destination:</div>
                    <div><?php echo htmlspecialchars($shipment['destination']); ?></div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Created Date:</div>
                    <div><?php echo date('Y-m-d H:i', strtotime($shipment['created_at'])); ?></div>
                </div>
            </div>

            <div class="delete-form">
                <p>Are you sure you want to delete this shipment? This action cannot be undone.</p>
                <form method="POST">
                    <button type="submit" class="delete-btn">Delete Shipment</button>
                    <a href="/me/php-native/view-shipment.php?id=<?php echo $shipment['id']; ?>" class="cancel-btn">Cancel</a>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>