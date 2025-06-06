# API Documentation

## Overview
This document provides detailed information about the Logistik Maritim API endpoints, authentication, and usage.

## Authentication

### API Key Authentication
```http
Authorization: Bearer <your_api_key>
```

### OAuth 2.0
```http
Authorization: Bearer <access_token>
```

## Base URL
```
https://api.logistikmaritim.com/v1
```

## Endpoints

### Authentication

#### Login
```http
POST /auth/login
```
Request Body:
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```
Response:
```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

#### Register
```http
POST /auth/register
```
Request Body:
```json
{
    "name": "John Doe",
    "email": "user@example.com",
    "password": "password123",
    "company_name": "Example Corp",
    "phone": "+1234567890"
}
```

### Users

#### Get User Profile
```http
GET /users/profile
```
Response:
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com",
    "company_name": "Example Corp",
    "phone": "+1234567890",
    "created_at": "2024-01-01T00:00:00Z"
}
```

#### Update User Profile
```http
PUT /users/profile
```
Request Body:
```json
{
    "name": "John Doe",
    "phone": "+1234567890"
}
```

### Shipments

#### List Shipments
```http
GET /shipments
```
Query Parameters:
- page (default: 1)
- limit (default: 10)
- status
- date_from
- date_to

Response:
```json
{
    "data": [
        {
            "id": 1,
            "origin": "Jakarta",
            "destination": "Surabaya",
            "status": "pending",
            "created_at": "2024-01-01T00:00:00Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "total_pages": 5,
        "total_items": 50
    }
}
```

#### Create Shipment
```http
POST /shipments
```
Request Body:
```json
{
    "origin": "Jakarta",
    "destination": "Surabaya",
    "cargo_type": "Container",
    "weight": 1000.50,
    "vessel_name": "MV Example"
}
```

#### Get Shipment Details
```http
GET /shipments/{id}
```

#### Update Shipment
```http
PUT /shipments/{id}
```
Request Body:
```json
{
    "status": "in_progress",
    "vessel_name": "MV Example Updated"
}
```

#### Delete Shipment
```http
DELETE /shipments/{id}
```

### Documents

#### Upload Document
```http
POST /shipments/{id}/documents
```
Request Body (multipart/form-data):
- file: [file]
- document_type: string
- description: string

#### List Documents
```http
GET /shipments/{id}/documents
```

#### Download Document
```http
GET /documents/{id}/download
```

## Error Handling

### Error Response Format
```json
{
    "error": {
        "code": "ERROR_CODE",
        "message": "Error description",
        "details": {}
    }
}
```

### Common Error Codes
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Internal Server Error

## Rate Limiting

### Limits
- 100 requests per minute per API key
- 1000 requests per hour per API key

### Headers
```
X-RateLimit-Limit: 100
X-RateLimit-Remaining: 99
X-RateLimit-Reset: 1516239022
```

## Webhooks

### Configuration
```http
POST /webhooks
```
Request Body:
```json
{
    "url": "https://your-domain.com/webhook",
    "events": ["shipment.created", "shipment.updated"]
}
```

### Event Types
- shipment.created
- shipment.updated
- shipment.deleted
- document.uploaded
- user.registered

### Webhook Payload
```json
{
    "event": "shipment.created",
    "data": {
        "id": 1,
        "origin": "Jakarta",
        "destination": "Surabaya"
    },
    "timestamp": "2024-01-01T00:00:00Z"
}
```

## Best Practices

### Security
- Use HTTPS
- Keep API keys secure
- Implement rate limiting
- Validate input data

### Performance
- Use pagination
- Implement caching
- Optimize requests
- Monitor usage

## SDKs

### PHP
```php
composer require logistikmaritim/api-client
```

### JavaScript
```bash
npm install @logistikmaritim/api-client
```

## Support

### API Status
- Check status page
- Monitor uptime
- Report issues
- Get updates

### Contact
- API Support: api@logistikmaritim.com
- Documentation: docs@logistikmaritim.com
- Emergency: emergency@logistikmaritim.com 