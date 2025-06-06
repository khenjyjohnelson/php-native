<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Require login to access
requireLogin();

$user = getUserData();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origin = $_POST['origin'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $items = $_POST['items'] ?? [];

    if (empty($origin) || empty($destination) || empty($items)) {
        $error = 'Please fill in all required fields';
    } else {
        try {
            $pdo->beginTransaction();

            // Generate tracking number
            $tracking_number = 'TRK' . date('Ymd') . strtoupper(substr(uniqid(), -6));

            // Insert shipment
            $stmt = $pdo->prepare("INSERT INTO shipments (user_id, tracking_number, origin, destination, status) VALUES (?, ?, ?, ?, 'pending')");
            $stmt->execute([$user['id'], $tracking_number, $origin, $destination]);
            $shipment_id = $pdo->lastInsertId();

            // Insert shipment details
            $stmt = $pdo->prepare("INSERT INTO shipment_details (shipment_id, item_name, quantity, weight, description) VALUES (?, ?, ?, ?, ?)");
            foreach ($items as $item) {
                if (!empty($item['name'])) {
                    $stmt->execute([
                        $shipment_id,
                        $item['name'],
                        $item['quantity'] ?? 1,
                        $item['weight'] ?? 0,
                        $item['description'] ?? ''
                    ]);
                }
            }

            // Insert initial tracking status
            $stmt = $pdo->prepare("INSERT INTO shipment_tracking (shipment_id, status, location, description) VALUES (?, 'pending', ?, 'Shipment created')");
            $stmt->execute([$shipment_id, $origin]);

            $pdo->commit();
            $success = 'Shipment created successfully!';
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Failed to create shipment. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Shipment - Logistics Maritime</title>
    <link rel="stylesheet" href="/imk/logistikmaritim/css/index.css">
    <style>
        .new-shipment-container {
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
                    <img src="/imk/logistikmaritim/image/logo.png" alt="logo" />
                </div>
                <span>Logistik Maritime</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/imk/index.php">Beranda</a></li>
                    <li><a href="/imk/dashboard.php">Dashboard</a></li>
                    <li><a href="/imk/logistikmaritim/html/informasi.php">Jadwal Pengiriman</a></li>
                    <li><a href="/imk/logistikmaritim/html/kontak.php">Kontak Kami</a></li>
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

    <div class="new-shipment-container">
        <h2>Create New Shipment</h2>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success); ?>
                <br>
                <a href="/imk/dashboard.php">Return to Dashboard</a>
            </div>
        <?php else: ?>
            <form method="POST" id="shipmentForm">
                <div class="form-group">
                    <label for="origin">Origin:</label>
                    <input type="text" id="origin" name="origin" required>
                </div>

                <div class="form-group">
                    <label for="destination">Destination:</label>
                    <input type="text" id="destination" name="destination" required>
                </div>

                <div class="items-container">
                    <h3>Items</h3>
                    <div id="itemsList">
                        <div class="item-row">
                            <input type="text" name="items[0][name]" placeholder="Item Name" required>
                            <input type="number" name="items[0][quantity]" placeholder="Quantity" value="1" min="1">
                            <input type="number" name="items[0][weight]" placeholder="Weight (kg)" step="0.01" min="0">
                            <input type="text" name="items[0][description]" placeholder="Description">
                            <button type="button" class="remove-item-btn" onclick="removeItem(this)" style="display: none;">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="add-item-btn" onclick="addItem()">Add Item</button>
                </div>

                <button type="submit" class="submit-btn">Create Shipment</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        let itemCount = 1;

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