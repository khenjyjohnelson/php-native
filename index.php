<?php

require_once 'app/config/views_config.php';
require_once 'app/helper/view_helper.php';
require_once 'app/helper/upload_helper.php';

// Define constants
define('BASE_URL', 'localhost/me/hotel-php-native/');
define('APP_PATH', __DIR__ . '/app/');
define('CONTROLLERS_PATH', APP_PATH . 'controllers/');
define('MODELS_PATH', APP_PATH . 'models/');


// Autoloading
spl_autoload_register(function($class) {
    // Convert class name to lowercase and append ".php" extension
    $file = strtolower($class) . '.php';

    // Check if the file exists in models directory
    $path = MODELS_PATH . $file;
    if (file_exists($path)) {
        require_once $path;
        return;
    }

    // Check if the file exists in controllers directory
    $path = CONTROLLERS_PATH . $file;
    if (file_exists($path)) {
        require_once $path;
    }
});

// Routing
$url = isset($_GET['url']) ? $_GET['url'] : '';
$route = explode('/', $url);

$controller = isset($route[0]) && !empty($route[0]) ? ucfirst($route[0]) : 'Welcome';
$method = isset($route[1]) && !empty($route[1]) ? $route[1] : 'index';

// Load configurations
// Start session if needed

// Include controller
$controllerFile = CONTROLLERS_PATH . $controller . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
    die('Controller not found');
}

// Instantiate controller
$controllerInstance = new $controller();

// Call method
if (method_exists($controllerInstance, $method)) {
    // Call the method
    call_user_func_array([$controllerInstance, $method], array_slice($route, 2));
} else {
    die('Method not found');
}
