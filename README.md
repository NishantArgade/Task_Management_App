# Laravel Task Management App

This is a robust Task Management App built with Laravel. It allows the admin to create and manage tasks and assign them to users with ease. Additionally, users can view their tasks and change the status of tasks.


## Features

- User Authentication: Register and login functionality.
- Admin Task Creation: Create tasks with a title, description, due date.
- Task Assignment: Assign tasks to users.
- Task Update: Update the details of the tasks.
- Task Deletion: Delete tasks when they are no longer needed.
- Task Search: Search for tasks based on their details.
- Task Status Update: Update the status of tasks (e.g., In Progress, Completed).

## Installation & Setup

1. Clone the repository
    ```bash
    git clone https://github.com/NishantArgade/Task_Management_App.git
    ```

2. Change into the project directory
    ```bash
    cd Task_Management_App
    ```

3. Install dependencies
    ```bash
    composer install
    ```
3. Install npm dependencies and run build 
    ```bash
    npm install
    npm run build
    ```

4. Copy the example env file and make the database configuration changes in the .env file 
    ```bash
    cp .env.example .env
    ```
for example:
  ```bash
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=root
DB_PASSWORD=
```

Note: create a database (any name) in mysql server and assign their name in above configuration ex.DB_DATABASE=YOUR_DB_NAME

5. Generate a new application key
    ```bash
    php artisan key:generate
    ```

## Database Migration & Seeding

1. Run the database migrations (Set the database connection in .env before migrating)
    ```bash
    php artisan migrate
    ```

2. Seed the database with some test data
    ```bash
    php artisan db:seed
    ```

## Running the Project

1. Start the local development server
    ```bash
    php artisan serve
    ```

You can now access the server at http://localhost:8000

## Testing

Since the admin can only create a task and assign it to a user, first, log in as an admin. Then, you can see all tasks, create, edit, delete tasks, as well as assign a task to users.

To see assigned tasks, log in as a user. Then, you can view the tasks assigned to logged-in users and also change the status of tasks accordingly.
```bash
# Admin Login Creadentials
email: admin@gmail.com
password: 12345678

# User Login Creadentials
email: user@gmail.com
password: 12345678

```