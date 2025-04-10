# Task Management System ![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## What is this project?
This is a Task Management System backend built with **Laravel 11** and **MariaDB/MySQL**. The project was developed as a test assessment for **Invade Solutions**.

## How does this project setup work?
Follow these steps to get the project up and running:

### 1. Clone the repository
Clone the repository using the following command:
```bash
git clone <repository_url>
```

### 2. Create a `.env` file
Create a `.env` file based on the `.env.example` provided in the root directory.

### 3. Install dependencies
Run the following command to install all required dependencies:
```bash
composer install
```

### 4. Run migrations with seeders
Run the following command to migrate the database and seed it with initial data:
```bash
php artisan migrate --seed
```

**Important Note:** When running migrations, make sure to include the `--seed` flag, as it contains seeded users with the following credentials:
* **Email:** user@invade.com
* **Password:** 123456789

The seeded user comes with **10 pre-populated tasks** to make testing easier. Alternatively, you can register a new user through the provided API endpoints.

## API Documentation
Complete API documentation is available via **Postman**: [Invade Solutions API](https://www.postman.com/martian-shadow-736975/invade-solutions/overview)

For each endpoint, you'll find detailed responses showing URLs, different use cases, and request bodies when needed.

**Important Note:** The base URL for the API is:
```bash
127.0.0.1:8000/api
```

## Bonus Features

### Architecture & Design
* **Modularity** using the **Service-Repository pattern**
* Structured **request validation** and **API resources**
* **Response trait** for consistent API responses

### Internationalization
* Full **localization support** for **Arabic** and **English** languages

### Performance Optimization
* **Redis cache implementation**
* **Pagination** for large data sets
* **Database indexes** for optimized search queries

### Extended Endpoints
Beyond the required CRUD operations, the API includes:
* Authentication endpoints (register, login, logout, profile)
* **Soft delete functionality**
* **Force delete operations**
* **Restore deleted tasks**
* **Bulk operations** (delete, force delete, restore)
* User password updates
* Retrieving **deleted tasks**
* **Advanced search** and **sorting** capabilities

### Security Features
* **Laravel Sanctum** for API authentication
* **CORS middleware** for cross-origin requests
* Input **validation** and **sanitization**
