<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Require login to access
requireLogin();

$user = getUserData();
$error = '';
$success = '';

// Get shipment ID from URL
$shipment_id = $_GET['id'] ?? null;

if (!$shipment_id) {
    header('Location: /me/php-native/dashboard.php');
    exit();
}

// Get shipment details
$stmt = $pdo->prepare("
    SELECT * FROM shipments 
    WHERE id = ? AND user_id = ?
");
$stmt->execute([$shipment_id, $user['id']]);
$shipment = $stmt->fetch();

if (!$shipment) {
    header('Location: /me/php-native/dashboard.php');
    exit();
}

// Get shipment items
$stmt = $pdo->prepare("
    SELECT * FROM shipment_details 
    WHERE shipment_id = ?
    ORDER BY id ASC
");
$stmt->execute([$shipment_id]);
$items = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $status = $_POST['status'] ?? '';
    $items = $_POST['items'] ?? [];

    if (empty($origin) || empty($destination) || empty($status) || empty($items)) {
        $error = 'Please fill in all required fields';
    } else {
        try {
            $pdo->beginTransaction();

            // Update shipment
            $stmt = $pdo->prepare("
                UPDATE shipments 
                SET origin = ?, destination = ?, status = ?
                WHERE id = ? AND user_id = ?
            ");
            $stmt->execute([$origin, $destination, $status, $shipment_id, $user['id']]);

            // Delete existing items
            $stmt = $pdo->prepare("DELETE FROM shipment_details WHERE shipment_id = ?");
            $stmt->execute([$shipment_id]);

            // Insert updated items
            $stmt = $pdo->prepare("
                INSERT INTO shipment_details (shipment_id, item_name, quantity, weight, description)
                VALUES (?, ?, ?, ?, ?)
            ");

            foreach ($items as $item) {
                if (!empty($item['name']) && !empty($item['quantity']) && !empty($item['weight'])) {
                    $stmt->execute([
                        $shipment_id,
                        $item['name'],
                        $item['quantity'],
                        $item['weight'],
                        $item['description'] ?? ''
                    ]);
                }
            }

            // Add tracking status if status changed
            if ($status !== $shipment['status']) {
                $stmt = $pdo->prepare("
                    INSERT INTO shipment_tracking (shipment_id, status, location, description)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt->execute([
                    $shipment_id,
                    $status,
                    $status === 'in_transit' ? $origin : ($status === 'delivered' ? $destination : $origin),
                    'Status updated to ' . $status
                ]);
            }

            $pdo->commit();
            $success = 'Shipment updated successfully!';

            // Refresh shipment data
            $stmt = $pdo->prepare("SELECT * FROM shipments WHERE id = ?");
            $stmt->execute([$shipment_id]);
            $shipment = $stmt->fetch();

            $stmt = $pdo->prepare("SELECT * FROM shipment_details WHERE shipment_id = ? ORDER BY id ASC");
            $stmt->execute([$shipment_id]);
            $items = $stmt->fetchAll();
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Failed to update shipment. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipment - Logistics Maritime</title>
    <link rel="stylesheet" href="/me/php-native/logistikmaritim/css/index.css">
    <style>
        .edit-shipment-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .items-container {
            margin-top: 20px;
        }

        .item-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr auto;
            gap: 10px;
            margin-bottom: 10px;
            align-items: start;
        }

        .add-item-btn,
        .remove-item-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-item-btn {
            background: #28a745;
            color: white;
        }

        .remove-item-btn {
            background: #dc3545;
            color: white;
        }

        .submit-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
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
                <span>Logistik Maritime</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/me/php-native/index.php">Beranda</a></li>
                    <li><a href="/me/php-native/dashboard.php">Dashboard</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/informasi.html">Jadwal Pengiriman</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/kontak.html">Kontak Kami</a></li>
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

    <div class="edit-shipment-container">
        <h1>Edit Shipment</h1>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
                <br>
                <a href="/me/php-native/view-shipment.php?id=<?php echo $shipment['id']; ?>">View Shipment</a>
            </div>
        <?php else: ?>
            <form method="POST" id="shipmentForm">
                <div class="form-group">
                    <label for="tracking_number">Tracking Number:</label>
                    <input type="text" id="tracking_number" value="<?php echo htmlspecialchars($shipment['tracking_number']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="origin">Origin:</label>
                    <input type="text" id="origin" name="origin" value="<?php echo htmlspecialchars($shipment['origin']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="destination">Destination:</label>
                    <input type="text" id="destination" name="destination" value="<?php echo htmlspecialchars($shipment['destination']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pending" <?php echo $shipment['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="in_transit" <?php echo $shipment['status'] === 'in_transit' ? 'selected' : ''; ?>>In Transit</option>
                        <option value="delivered" <?php echo $shipment['status'] === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="cancelled" <?php echo $shipment['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>

                <div class="items-container">
                    <h3>Items</h3>
                    <div id="itemsList">
                        <?php foreach ($items as $index => $item): ?>
                            <div class="item-row">
                                <input type="text" name="items[<?php echo $index; ?>][name]" placeholder="Item Name" value="<?php echo htmlspecialchars($item['item_name']); ?>" required>
                                <input type="number" name="items[<?php echo $index; ?>][quantity]" placeholder="Quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                                <input type="number" name="items[<?php echo $index; ?>][weight]" placeholder="Weight (kg)" value="<?php echo htmlspecialchars($item['weight']); ?>" step="0.01" min="0">
                                <input type="text" name="items[<?php echo $index; ?>][description]" placeholder="Description" value="<?php echo htmlspecialchars($item['description']); ?>">
                                <button type="button" class="remove-item-btn" onclick="removeItem(this)" <?php echo count($items) === 1 ? 'style="display: none;"' : ''; ?>>Remove</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="add-item-btn" onclick="addItem()">Add Item</button>
                </div>

                <button type="submit" class="submit-btn">Update Shipment</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        let itemCount = <?php echo count($items); ?>;

        function addItem() {
            const itemsList = document.getElementById('itemsList');
            const newItem = document.createElement('div');
            newItem.className = 'item-row';
            newItem.innerHTML = `
                <input type="text" name="items[${itemCount}][name]" placeholder="Item Name" required>
                <input type="number" name="items[${itemCount}][quantity]" placeholder="Quantity" value="1" min="1">
                <input type="number" name="items[${itemCount}][weight]" placeholder="Weight (kg)" step="0.01" min="0">
                <input type="text" name="items[${itemCount}][description]" placeholder="Description">
                <button type="button" class="remove-item-btn" onclick="removeItem(this)">Remove</button>
            `;
            itemsList.appendChild(newItem);
            itemCount++;

            // Show remove button for first item if there's more than one item
            if (itemCount > 1) {
                document.querySelector('.item-row:first-child .remove-item-btn').style.display = 'block';
            }
        }

        function removeItem(button) {
            const itemRow = button.parentElement;
            itemRow.remove();
            itemCount--;

            // Hide remove button for first item if it's the only item
            if (itemCount === 1) {
                document.querySelector('.item-row:first-child .remove-item-btn').style.display = 'none';
            }
        }
    </script>
</body>

</html>