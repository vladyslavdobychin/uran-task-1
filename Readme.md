# Very Useful Web Application

## Description

This project is a PHP web application running inside a Docker environment. The application is designed to manage pages, with functionality for creating, updating, and deleting pages. The application also includes unit tests written with PHPUnit.

## Prerequisites

- Docker
- Docker Compose

If you don't have Docker installed, follow the instructions in the [Installation](#installation) section.

## Installation

### Docker

If you don't have Docker installed, you can download and install it from the official website:

- **[Download Docker](https://www.docker.com/products/docker-desktop)**


## Getting Started

Follow these steps to get the project up and running:

### 1. Clone the Repository

Clone the project repository to your local machine:

```sh
git clone https://github.com/vladyslavdobychin/uran-task-1.git
cd uran-task-1
```

### 2. Start the Docker Containers

Build and start the Docker containers using Docker Compose:

```sh
docker-compose build
docker-compose up
```
This will set up the following services:

- This will set up the following services:
- Database using MariaDB
- Web server running PHP and Nginx
- Adminer for database management

The web application will be accessible at http://localhost:8080, and Adminer will be accessible at http://localhost:8081.

### 3. Basic functionality of the application

- Upon application start, an SQL script creates the database with default pages to play with 
- Going to http://localhost:8080 will automatically open the 'Home' page
- You can open the home page by also going to http://localhost:8080/1 , http://localhost:8080/home 
- Page id is automatically hot swapped with the page slug in the URL - http://localhost:8080/1 >>> http://localhost:8080/home 
- You can create new pages, edit and delete existing ones

### 4. Running Tests
   To run the PHPUnit tests, follow these steps:

Exec into the running web container:

```sh
docker exec -it uran-task-1-web-1 /bin/bash
```

Navigate to the project directory inside the container:

```sh
cd /var/www/html
```

Run the PHPUnit tests:
    
```sh
vendor/bin/phpunit --configuration phpunit.xml --testdox
```



