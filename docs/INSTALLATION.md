# Installation Guide

## Prerequisites
- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, or Edge)

## Installation Steps

1. **Install XAMPP**
   - Download and install XAMPP from https://www.apachefriends.org/
   - Start Apache and MySQL services from XAMPP Control Panel

2. **Clone/Download the Project**
   - Place the project files in your XAMPP htdocs directory
   - Default path: `C:/xampp/htdocs/imk`

3. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `logistik_maritim`
   - Import the `database.sql` file from the project root

4. **Configuration**
   - Navigate to `config/database.php`
   - Update database credentials if different from default:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'logistik_maritim');
     ```

5. **File Permissions**
   - Ensure the following directories are writable:
     - `uploads/`
     - `logs/`

6. **Access the Application**
   - Open your web browser
   - Navigate to: http://localhost/imk

## Default Login Credentials

### Admin Account
- Username: admin@logistikmaritim.com
- Password: admin123

### User Account
- Username: user@example.com
- Password: user123

## Troubleshooting

1. **Database Connection Issues**
   - Verify MySQL service is running
   - Check database credentials in config file
   - Ensure database exists

2. **File Upload Issues**
   - Check directory permissions
   - Verify PHP upload settings in php.ini

3. **Session Issues**
   - Clear browser cookies
   - Check PHP session configuration

## Support
For additional support, please contact the system administrator. 