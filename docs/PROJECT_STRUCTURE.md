# Project Structure

```
imk/
├── admin/                    # Admin panel files
│   ├── dashboard.php
│   ├── users.php
│   └── view-user.php
├── assets/                   # Static assets
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   ├── images/              # Image files
│   └── fonts/               # Font files
├── config/                   # Configuration files
│   ├── database.php
│   └── session.php
├── docs/                    # Documentation
│   ├── INSTALLATION.md
│   ├── USER_GUIDE.md
│   ├── ADMIN_GUIDE.md
│   ├── DATABASE.md
│   ├── SECURITY.md
│   ├── API.md
│   └── PROJECT_STRUCTURE.md
├── includes/                # Reusable PHP components
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   └── functions.php
├── uploads/                 # User uploaded files
│   ├── documents/
│   └── temp/
├── vendor/                  # Third-party libraries
├── api/                     # API endpoints
│   ├── v1/
│   └── config/
├── logs/                    # System logs
├── database.sql            # Database schema
├── index.php              # Main entry point
├── login.php              # Login page
├── register.php           # Registration page
├── logout.php             # Logout handler
├── dashboard.php          # User dashboard
├── new-shipment.php       # Create shipment
├── edit-shipment.php      # Edit shipment
├── view-shipment.php      # View shipment
└── delete-shipment.php    # Delete shipment
```

## Directory Descriptions

### admin/
Contains all administrative interface files and functionality.

### assets/
Static files used throughout the application:
- CSS stylesheets
- JavaScript files
- Images and icons
- Font files

### config/
Configuration files for database, sessions, and other system settings.

### docs/
Complete system documentation:
- Installation guide
- User manual
- Admin guide
- Database documentation
- Security documentation
- API documentation
- Project structure

### includes/
Reusable PHP components and functions:
- Header and footer templates
- Navigation components
- Utility functions
- Common includes

### uploads/
Storage for user-uploaded files:
- Documents
- Temporary files
- User content

### vendor/
Third-party libraries and dependencies.

### api/
API endpoints and related configuration:
- Version-specific endpoints
- API configuration
- Authentication handlers

### logs/
System logs and error tracking.

## File Naming Conventions

- Use lowercase for all file names
- Use hyphens (-) to separate words
- Use descriptive names that indicate purpose
- Keep file names concise but meaningful

## Best Practices

1. **File Organization**
   - Keep related files together
   - Use appropriate directories
   - Maintain consistent structure

2. **Code Organization**
   - Separate concerns
   - Use includes for reusable code
   - Follow PHP best practices

3. **Security**
   - Protect sensitive files
   - Use proper permissions
   - Implement access control

4. **Maintenance**
   - Regular cleanup
   - Version control
   - Documentation updates 