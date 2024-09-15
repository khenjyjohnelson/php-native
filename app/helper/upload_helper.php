<?php
// File: upload_helper.php

/**
 * Function to handle file uploads
 * @param string $fieldName The name of the file input field
 * @param string $uploadDir The directory where the uploaded file will be stored
 * @param array $allowedTypes An array of allowed file types/extensions
 * @return string|false The uploaded file path on success, false on failure
 */
function handle_upload($fieldName, $uploadDir, $allowedTypes = [])
{
    // Check if file was uploaded
    if (!isset($_FILES[$fieldName])) {
        return false;
    }

    // Retrieve uploaded file details
    $file = $_FILES[$fieldName];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Check for upload errors
    if ($fileError !== UPLOAD_ERR_OK) {
        return false;
    }

    // Check file type if allowed
    if (!empty($allowedTypes) && !in_array($fileType, $allowedTypes)) {
        return false;
    }

    // Generate unique filename
    $uniqueFilename = uniqid() . '_' . $fileName;

    // Move uploaded file to destination directory
    $destination = $uploadDir . '/' . $uniqueFilename;
    if (move_uploaded_file($fileTmpName, $destination)) {
        return $destination;
    } else {
        return false;
    }
}
