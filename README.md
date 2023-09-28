# URL Shortener App

This is a simple URL shortener application built using PHP and the Laravel framework. It allows you to shorten long URLs into more manageable and shareable links.

## Features

- Shorten long URLs into concise, easy-to-share links.
- Redirect users from shortened links to the original URL.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP installed on your server.
- Composer globally installed for Laravel dependencies.
- MySQL database server.

## Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/mhojaguliyev/url-shortener.git
   ```

2. Navigate to the project directory:

   ```shell
   cd url-shortener
   ```

3. Install dependencies using Composer:

   ```shell
   composer install
   ```

4. Create a copy of the `.env.example` file as `.env` and configure your database connection:

   ```shell
   cp .env.example .env
   ```

   Update the database configuration in the `.env` file with your database credentials:

   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

5. Generate an application key:

   ```shell
   php artisan key:generate
   ```

6. Run database migrations:

   ```shell
   php artisan migrate
   ```

7. Start the development server:

   ```shell
   php artisan serve
   ```

8. Your URL shortener app should now be accessible at `http://localhost:8000`.

## Usage

- To shorten a URL, make post request to url /shorten with providing body parameter link.
- You will receive a shortened link that you can share.
- Users with the shortened link will be redirected to the original URL until link expires.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please follow these guidelines:

1. Fork the repository.
2. Create a new branch for your feature or bug fix: `git checkout -b feature/your-feature-name`.
3. Make your changes and commit them: `git commit -m 'Add new feature'`.
4. Push to the branch: `git push origin feature/your-feature-name`.
5. Submit a pull request.

## Acknowledgments

- [Laravel](https://laravel.com) - The PHP framework used.
- [Composer](https://getcomposer.org) - Dependency management for PHP.
