<?php 
function load_view($view, $data = []) {
    // Construct full view file path
    $viewFile = VIEW_PATH . $view . VIEW_EXTENSION;

    // Check if view file exists
    if (file_exists($viewFile)) {
        // Extract data array to variables
        extract($data);

        // Include view file
        require $viewFile;
    } else {
        // Handle error if view file does not exist
        echo 'View file not found: ' . $view;
    }
}

function redirect($url, $statusCode = 302) {
    header('Location: ' . $url, true, $statusCode);
    exit();
}

/**
 * Generates the URL to your site.
 *
 * @param string $uri URI string
 * @return string
 */
function site_url($uri = '')
{
    // Define your base URL here
    $base_url = 'C:/laragon/www/me/hotel-php-native/';

    // Trim any leading/trailing slashes from the URI
    $uri = trim($uri, '/');

    // Concatenate the base URL with the URI
    return $base_url . '/' . $uri;
}


// helpers/input_helper.php

/**
 * Get input value by key
 * 
 * @param string $key The key of the input value
 * @param mixed $default The default value if input value is not set
 * @return mixed The input value or default value
 */
function input($key, $default = null) {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}
