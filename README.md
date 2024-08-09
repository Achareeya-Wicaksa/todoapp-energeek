# Todo List Application

This is a simple Todo List application built using Laravel. The application allows users to create and manage their tasks, organized into different categories.

## Features

- User management (automatic creation based on email)
- Task management
- Category management
- AJAX-based task submission with success modal
- Responsive design using Bootstrap

## Requirements

- PHP >= 7.3
- Composer
- Laravel 8.x
- MySQL or any other supported database

## Installation

1. **Clone the repository, Install dependencies, and Set up the environment**:
   ```bash
   git clone https://github.com/yourusername/todo-list.git
   cd todo-list
   composer install
   cp .env.example .env

After copying the .env file, configure it to match your environment settings:

2. **Generate application key**:
   php artisan key:generate

3. **Migrate the database**:
   php artisan migrate

4. **Install dependencies**:
   NPM install
4. **Install dependencies**:
   NPM install

4. **Running the Application**:
   PHP artisan serve

## Testing

php artisan test
