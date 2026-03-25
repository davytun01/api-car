# Ignite Luxury API

A complete, RESTful JSON API for a premium automotive dealership called "Ignite Luxury". Built with Laravel 12.

## Features
- **Strict JSON Standardized Responses**: Wrapper for data using `{success, message, data, meta}`.
- **Role-Based Users**: Admin and Sales users.
- **Robust CRUD**: Manage Cars, Customers, Inquiries, and Sales natively.
- **Image Upload Support**: Car images are stored cleanly in the local `public` disk.
- **Search & Filters**: Comprehensive query scope filtering (brand, price, status, etc.).

## Prerequisites
- PHP 8.2+
- Composer
- MySQL 8 (Though SQLite fallback is configured for simple testing environments)

## Installation & Setup

1. **Clone the repository and install dependencies:**
   ```bash
   composer install
   ```

2. **Environment Configuration:**
   Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```
   *Note: Update your database configuration block inside `.env` if using MySQL. Default config typically points to `DB_CONNECTION=sqlite`.*

3. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

4. **Link Storage (for Car Image uploads):**
   ```bash
   php artisan storage:link
   ```

5. **Run Migrations & Seed Database:**
   ```bash
   php artisan migrate --seed
   ```
   *(This creates the admin user `admin@igniteluxury.com` / `password` and seeds 20 realistic cars).*

6. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

## Endpoints Summary

### Public
| Method | URL | Description |
|---|---|---|
| `GET` | `/api/cars` | List available cars (Paginated, filters: `?brand=Toyota&price_min=1000000&price_max=5000000&year=2023&status=available`) |
| `GET` | `/api/cars/{id}` | Show single car details |
| `POST` | `/api/login` | Login (Returns Bearer token). Requires: `email`, `password` |
| `POST` | `/api/register` | Register new staff user. Requires: `name`, `email`, `password`, `password_confirmation` |

### Protected (Requires Bearer Token `Authorization: Bearer <token>`)
| Method | URL | Description |
|---|---|---|
| `POST` | `/api/logout` | Revoke current user's token |
| `POST` | `/api/cars` | Create a car (Accepts `multipart/form-data` for image upload) |
| `PUT/PATCH` | `/api/cars/{id}` | Update car details |
| `DELETE` | `/api/cars/{id}` | Delete a car |
| `GET` | `/api/customers` | List all customers |
| `POST` | `/api/customers` | Create a customer |
| `GET` | `/api/customers/{id}` | Show a customer |
| `PUT/PATCH` | `/api/customers/{id}` | Update a customer |
| `DELETE` | `/api/customers/{id}` | Delete a customer |
| `GET` | `/api/inquiries` | List all inquiries |
| `POST` | `/api/inquiries` | Create an inquiry |
| `GET` | `/api/inquiries/{id}` | Show an inquiry |
| `PUT/PATCH` | `/api/inquiries/{id}` | Update an inquiry |
| `DELETE` | `/api/inquiries/{id}` | Delete an inquiry |
| `GET` | `/api/sales` | List all sales |
| `POST` | `/api/sales` | Create a sale (Automatically updates related Car status to `sold`) |
| `GET` | `/api/sales/{id}` | Show a sale |
| `PUT/PATCH` | `/api/sales/{id}` | Update a sale |
| `DELETE` | `/api/sales/{id}` | Delete a sale |

## Postman Collection

You can import the following JSON directly into Postman:

```json
{
	"info": {
		"name": "Ignite Luxury API",
		"schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
	},
	"item": [
		{
			"name": "Auth",
			"item": [
				{
					"name": "Login",
					"request": {
						"method": "POST",
						"header": [],
						"body": {
							"mode": "formdata",
							"formdata": [
								{ "key": "email", "value": "admin@igniteluxury.com", "type": "text" },
								{ "key": "password", "value": "password", "type": "text" }
							]
						},
						"url": { "raw": "http://localhost:8000/api/login", "host": ["http://localhost:8000/api/login"] }
					}
				}
			]
		},
		{
			"name": "Cars",
			"item": [
				{
					"name": "List Cars",
					"request": { "method": "GET", "url": { "raw": "http://localhost:8000/api/cars?status=available", "host": ["http://localhost:8000/api/cars?status=available"] } }
				}
			]
		}
	]
}
```
