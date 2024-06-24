
# Laravel User Management API

This Laravel application provides an API to manage users. It includes endpoints to register users and retrieve user information with filtering options. Additionally, it features email verification using a job queue.

## Requirements

- PHP >= 8.3
- Composer
- MySQL (or any preferred database)
- Laravel 8.x or later

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd <repository-directory>
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Setup environment variables: Copy `.env.example` to `.env` and configure your database settings.
    ```bash
    cp .env.example .env
    ```

4. Generate application key:
    ```bash
    php artisan key:generate
    ```

5. Run database migrations:
    ```bash
    php artisan migrate
    ```

6. Start the server:
    ```bash
    php artisan serve
    ```

7. Start the queue worker: Open a new terminal and run:
    ```bash
    php artisan queue:work
    ```

## Database Seeding

To seed the database with 100,000 users (a mix of verified and unverified users), run:
```bash
php artisan db:seed --class=UserSeeder
```

## Endpoints

### Register a User

- **URL**: `/api/user`
- **Method**: POST
- **Headers**: `Content-Type: application/json`
- **Body**:
    ```json
    {
        "name": "John Doe",
        "email": "john.doe@example.com"
    }
    ```

- **Response**:
    - **Status**: 201 Created
    - **Body**:
        ```json
        {
            "id": 1,
            "name": "John Doe",
            "email": "john.doe@example.com",
            "is_verified": false,
            "created_at": "2024-06-24T00:00:00.000000Z",
            "updated_at": "2024-06-24T00:00:00.000000Z"
        }
        ```

### Retrieve Users

- **URL**: `/api/users`
- **Method**: GET
- **Query Parameters**:
    - `is_verified` (optional): true or false to filter by verification status.

- **Response**:
    - **Status**: 200 OK
    - **Body**:
        ```json
        [
            {
                "id": 1,
                "name": "John Doe",
                "email": "john.doe@example.com",
                "is_verified": false,
                "created_at": "2024-06-24T00:00:00.000000Z",
                "updated_at": "2024-06-24T00:00:00.000000Z"
            },
            ...
        ]
        ```

## Testing

To test the application, you can use PHPUnit:
- Run the tests:
    ```bash
    php artisan test
    ```

## Logging

Logs for email verification are written to `storage/logs/laravel.log`. Ensure your `logging.php` configuration is set up correctly.

## Notes

- Make sure to configure your `.env` file with appropriate settings for your environment.
- The email verification is logged and not actually sent. This is for development and testing purposes.
- During high traffic periods (e.g., marketing campaigns), ensure your queue worker can handle the load by properly configuring the queue system.


## My Feedback

- The task was clear, straightforward, and practical, providing a good learning experience.
- Setting up and running the queue worker correctly posed a challenge.
- Ensuring the seeder was fast and efficient with a large dataset required thoughtful consideration.
- Improved understanding of Laravel’s queue system functionality.
- Importance of optimizing database operations for performance.
- More detailed setup instructions for the queue worker would be beneficial.
- Including a mock or example for MailService could enhance clarity.
- Emphasizing logging and monitoring during high traffic periods could be beneficial.
- The exercise was practical and relevant to real-world scenarios.
- Effective use of Laravel’s features made the task feel cohesive and valuable.