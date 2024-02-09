
# Test task from @prascorporation made on raw PHP for skelar :)

## Getting Started

To get started with the application, follow these steps:

1. **Install Dependencies**
   - Run `composer dump-autoload` to generate the autoload files for the application.

2. **Run the Application**
   - Run `php -S localhost:8000` to start the PHP built-in server locally.

## Usage

Once the application is running, you can access the following endpoints:

- POST `/auth/login`: Endpoint for user login.
- POST `/auth/logout`: Endpoint for user logout.
- GET `/users`: Endpoint to view all users (requires authentication).
- GET `/user/{username}`: Endpoint to view a specific user by username (requires authentication).

### Example Login

To login, use the following credentials:

- Username: `Artem`
- Password: `123123`

You should provide it in body raw: {
    "username": "Artem",
    "password": "123123"
}
