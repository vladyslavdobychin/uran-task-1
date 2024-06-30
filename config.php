<?php
const DSN = 'mysql:host=db;dbname=task_1_database';
const DB_USER = 'task_1_user';
const DB_PASSWORD = 'task_1_password';
const DB_OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

function getDatabaseConnection() {
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD, DB_OPTIONS);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}

function autoloadClasses($class_name) {
    $directories = ['models', 'controllers'];
    foreach ($directories as $directory) {
        $file = __DIR__ . '/' . $directory . '/' . $class_name . '.php';
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
}
