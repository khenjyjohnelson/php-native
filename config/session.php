<?php
// Session configuration

require_once 'environment.php';

class Session {
    private static $instance = null;
    private $config;
    
    private function __construct() {
        $this->config = [
            'lifetime' => SESSION_LIFETIME,
            'path' => SESSION_PATH,
            'domain' => SESSION_DOMAIN,
            'secure' => SESSION_SECURE,
            'httponly' => SESSION_HTTPONLY,
            'samesite' => SESSION_SAMESITE
        ];
        
        $this->initialize();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function initialize() {
        // Set session cookie parameters
        session_set_cookie_params([
            'lifetime' => $this->config['lifetime'],
            'path' => $this->config['path'],
            'domain' => $this->config['domain'],
            'secure' => $this->config['secure'],
            'httponly' => $this->config['httponly'],
            'samesite' => $this->config['samesite']
        ]);
        
        // Set session name
        session_name('IMK_SESSION');
        
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Regenerate session ID periodically
        if (!isset($_SESSION['last_regeneration'])) {
            $_SESSION['last_regeneration'] = time();
        } else if (time() - $_SESSION['last_regeneration'] > 300) {
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
    
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public function get($key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }
    
    public function has($key) {
        return isset($_SESSION[$key]);
    }
    
    public function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    
    public function clear() {
        session_unset();
        return true;
    }
    
    public function destroy() {
        session_destroy();
        return true;
    }
    
    public function regenerate() {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
        return true;
    }
    
    public function flash($key, $value = null) {
        if ($value === null) {
            $value = $_SESSION['_flash'][$key] ?? null;
            unset($_SESSION['_flash'][$key]);
            return $value;
        }
        
        $_SESSION['_flash'][$key] = $value;
    }
    
    public function hasFlash($key) {
        return isset($_SESSION['_flash'][$key]);
    }
    
    public function getFlash($key, $default = null) {
        return $_SESSION['_flash'][$key] ?? $default;
    }
    
    public function clearFlash() {
        unset($_SESSION['_flash']);
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    public function getUserRole() {
        return $_SESSION['user_role'] ?? null;
    }
    
    public function isAdmin() {
        return $this->getUserRole() === 'admin';
    }
    
    public function login($userId, $userRole) {
        $this->regenerate();
        $this->set('user_id', $userId);
        $this->set('user_role', $userRole);
        $this->set('last_activity', time());
    }
    
    public function logout() {
        $this->clear();
        $this->destroy();
    }
    
    public function checkActivity() {
        if (!isset($_SESSION['last_activity'])) {
            return false;
        }
        
        if (time() - $_SESSION['last_activity'] > $this->config['lifetime']) {
            $this->logout();
            return false;
        }
        
        $_SESSION['last_activity'] = time();
        return true;
    }
}

// Session helper functions
function session_set($key, $value) {
    return Session::getInstance()->set($key, $value);
}

function session_get($key, $default = null) {
    return Session::getInstance()->get($key, $default);
}

function session_has($key) {
    return Session::getInstance()->has($key);
}

function session_remove($key) {
    return Session::getInstance()->remove($key);
}

function session_clear() {
    return Session::getInstance()->clear();
}

function session_destroy() {
    return Session::getInstance()->destroy();
}

function session_regenerate() {
    return Session::getInstance()->regenerate();
}

function session_flash($key, $value = null) {
    return Session::getInstance()->flash($key, $value);
}

function session_has_flash($key) {
    return Session::getInstance()->hasFlash($key);
}

function session_get_flash($key, $default = null) {
    return Session::getInstance()->getFlash($key, $default);
}

function session_clear_flash() {
    return Session::getInstance()->clearFlash();
}

function is_logged_in() {
    return Session::getInstance()->isLoggedIn();
}

function get_user_id() {
    return Session::getInstance()->getUserId();
}

function get_user_role() {
    return Session::getInstance()->getUserRole();
}

function is_admin() {
    return Session::getInstance()->isAdmin();
}

function login($userId, $userRole) {
    return Session::getInstance()->login($userId, $userRole);
}

function logout() {
    return Session::getInstance()->logout();
}

function check_activity() {
    return Session::getInstance()->checkActivity();
}

// Function to set session data
function set_session_data($key, $value) {
    $_SESSION[$key] = $value;
}

// Function to get session data
function get_session_data($key, $default = null) {
    return $_SESSION[$key] ?? $default;
}

// Function to remove session data
function remove_session_data($key) {
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

// Function to check if session data exists
function has_session_data($key) {
    return isset($_SESSION[$key]);
}

// Function to set flash message
function set_flash_message($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Function to get flash message
function get_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

// Function to require login
function require_login() {
    if (!is_logged_in()) {
        set_flash_message('error', 'Please login to access this page');
        header('Location: /login.php');
        exit;
    }
}

// Function to require admin
function require_admin() {
    if (!is_admin()) {
        set_flash_message('error', 'You do not have permission to access this page');
        header('Location: /dashboard.php');
        exit;
    }
}

function getUserData() {
    if (is_logged_in()) {
        return $_SESSION['user_data'];
    }
    return null;
}
?> 