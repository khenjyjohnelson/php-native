# Database Documentation

## Overview
The system uses MySQL database with the name `logistik_maritim`. This document provides detailed information about the database structure, tables, and relationships.

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    company_name VARCHAR(100),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Shipments Table
```sql
CREATE TABLE shipments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    cargo_type VARCHAR(50) NOT NULL,
    weight DECIMAL(10,2),
    vessel_name VARCHAR(100),
    status ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Documents Table
```sql
CREATE TABLE documents (
    id INT PRIMARY KEY AUTO_INCREMENT,
    shipment_id INT,
    document_type VARCHAR(50) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (shipment_id) REFERENCES shipments(id)
);
```

## Table Relationships

### One-to-Many Relationships
- Users to Shipments (One user can have multiple shipments)
- Shipments to Documents (One shipment can have multiple documents)

## Indexes

### Primary Indexes
- users.id
- shipments.id
- documents.id

### Foreign Key Indexes
- shipments.user_id
- documents.shipment_id

### Performance Indexes
- users.email
- shipments.status
- shipments.created_at

## Data Types

### Common Data Types
- INT: For IDs and numeric values
- VARCHAR: For text fields
- DECIMAL: For precise numeric values
- TIMESTAMP: For date and time
- ENUM: For fixed set of values

## Backup and Recovery

### Backup Procedures
1. Regular full database backups
2. Incremental backups for changes
3. Transaction log backups

### Recovery Procedures
1. Full database restore
2. Point-in-time recovery
3. Selective table restore

## Security

### Access Control
- Database user permissions
- Role-based access
- IP restrictions

### Data Protection
- Password hashing
- Sensitive data encryption
- Regular security audits

## Maintenance

### Optimization
- Regular index maintenance
- Table optimization
- Query optimization

### Monitoring
- Performance monitoring
- Space usage tracking
- Query performance analysis

## Best Practices

### Database Design
- Normalized structure
- Proper indexing
- Consistent naming conventions

### Performance
- Optimized queries
- Regular maintenance
- Proper indexing strategy

## Troubleshooting

### Common Issues
1. Connection problems
2. Performance issues
3. Data integrity
4. Backup failures

### Solutions
1. Check connection settings
2. Optimize queries
3. Verify data consistency
4. Test backup procedures 