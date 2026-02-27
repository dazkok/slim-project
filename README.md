# Slim Project

A PHP web application built with the Slim 4 microframework, featuring authentication, search functionality, and a bike shop interface.

## Features

- **Authentication System**: Login/logout functionality with session management
- **Search Functionality**: API endpoints and web interface for search operations
- **Bike Shop**: Product listing and detail pages
- **Secure Routes**: Protected endpoints requiring authentication
- **Template Engine**: Mustache templating for clean view separation
- **Error Handling**: Custom 404 error pages

## Requirements

- PHP 8.0 or higher
- Composer
- Web server (Apache/Nginx) or PHP built-in server

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd slim-project
```

2. Install dependencies:
```bash
composer install
```

3. Configure your web server to point to the `public/` directory as the document root.

## Project Structure

```
slim-project/
├── public/                 # Web root directory
│   └── index.php          # Application entry point
├── src/                   # Source code
│   ├── Controller/        # MVC controllers
│   └── Middleware/        # Custom middleware
├── templates/             # Mustache templates
├── data/                  # Application data
└── vendor/                # Composer dependencies
```

## Available Routes

### Public Routes
- `GET /` - Homepage
- `GET /hello/{name}` - Greeting page
- `GET /bikes` - Bike shop listing
- `GET /bikes/{id}` - Bike details
- `GET /search` - Search interface
- `POST /form` - Search form submission
- `GET /api` - Search API endpoint

### Authentication Routes
- `ANY /login` - Login page/form
- `GET /logout` - Logout action

### Protected Routes (Require Authentication)
- `GET /secure` - Secure dashboard
- `GET /status` - Status page

## Dependencies

- **slim/slim**: Slim 4 microframework
- **slim/psr7**: PSR-7 implementation
- **slim/http**: HTTP utilities
- **php-di/php-di**: Dependency injection container
- **mustache/mustache**: Template engine
- **bryanjhv/slim-session**: Session middleware

## Usage

### Development Server

Run the built-in PHP server:
```bash
php -S localhost:8000 -t public
```

### Authentication

The application includes a basic authentication system. Access to protected routes (`/secure`, `/status`) requires login through the `/login` endpoint.

### API Usage

The search API can be accessed at:
```
GET /api?query=<search-term>
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests (if available)
5. Submit a pull request

## License

This project is open source, use it as you like
