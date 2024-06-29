CREATE DATABASE IF NOT EXISTS task_1_database;
USE task_1_database;

CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    friendly VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
    );

INSERT INTO pages (friendly, title, description) VALUES
    ('home', 'Home Page', 'Welcome to the home page.'),
    ('about', 'About Us', 'Learn more about us on this page.'),
    ('contact', 'Contact Us', 'Get in touch with us through this page.');
