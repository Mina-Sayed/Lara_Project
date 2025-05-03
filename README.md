# Laravel Order Management API

A simple RESTful API built with Laravel 12 to manage Customers and Orders.

## Project Overview

This project provides basic API functionality for `Customer` and `Order` resources. It demonstrates core Laravel concepts including Eloquent models, relationships (HasMany, BelongsTo), controllers, routing, migrations, seeding, and environment configuration.

## Features

*   **Customers:** (Managed via seeding or potentially future endpoints)
    *   `id`, `name`, `email`
*   **Orders:**
    *   List all orders (with associated customer info).
    *   Create a new order for an existing customer.
    *   Update the status (`pending`/`shipped`) of an existing order.
    *   Get order statistics (total orders and revenue per status).
*   **Relationships:** `Customer` has many `Orders`, `Order` belongs to a `Customer`.
*   **Database:** Configured for PostgreSQL (can be changed in `.env`).

## Setup Instructions

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/Mina-Sayed/Lara_Project.git](https://github.com/Mina-Sayed/Lara_Project.git)
    cd Lara_Project
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    # npm install (Optional, if you plan to use frontend assets)
    ```

3.  **Configure Environment:**
    *   Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    *   Generate an application key:
        ```bash
        php artisan key:generate
        ```
    *   **Edit the `.env` file** and update the `DB_` variables to match your database credentials (e.g., for PostgreSQL):
        ```dotenv
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1 # Or your database host (e.g., Railway URL)
        DB_PORT=5432      # Or your database port
        DB_DATABASE=your_db_name
        DB_USERNAME=your_db_user
        DB_PASSWORD=your_db_password

        # Ensure these are set to avoid database dependency issues
        SESSION_DRIVER=file
        CACHE_STORE=file
        QUEUE_CONNECTION=sync
        ```

4.  **Run Database Migrations & Seed:** Create the `customers` and `orders` tables and add a sample customer.
    ```bash
    php artisan migrate:fresh --seed --seeder=CustomerSeeder
    ```
    *(Alternatively, run `php artisan migrate:fresh` and then `php artisan db:seed --class=CustomerSeeder`)*

5.  **Start the Development Server:**
    ```bash
    php artisan serve --port=8080 # Or any available port
    ```
    The API will typically be available at `http://127.0.0.1:8080`.

## API Endpoints

**Base URL:** `http://127.0.0.1:8080/api` (Assuming server running on port 8080)

| Method      | URL                     | Description                  | Request Body (JSON)                       | Success Response (JSON)                                     |
| :---------- | :---------------------- | :--------------------------- | :---------------------------------------- | :---------------------------------------------------------- |
| **GET**     | `/orders`               | List all orders              | *N/A*                                     | Array of order objects (with customer)                      |
| **POST**    | `/orders`               | Create a new order           | `{ "customer_id":.., "product_name":.., "quantity":.., "price":.. }` | Created order object (with customer) (Status `201`)       |
| **PUT**     | `/orders/{order}`       | Update an order's status     | `{ "status": "shipped" }`                 | Updated order object (with customer)                        |
| **GET**     | `/orders/stats`         | Get order stats by status    | *N/A*                                     | `{ "stats_by_status": [...], "overall_total_revenue": ... }` |

*(Replace `{order}` with the actual ID of the order)*

**Headers:**
*   For `GET`: `Accept: application/json`
*   For `POST`, `PUT`: `Accept: application/json`, `Content-Type: application/json`

## Key Technologies

*   PHP
*   Laravel 12
*   Composer
*   PostgreSQL (or other configured SQL database)
