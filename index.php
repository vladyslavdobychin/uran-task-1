<?php
// Database connection details
$dsn = 'mysql:host=db;dbname=task_1_database';
$username = 'task_1_user';
$password = 'task_1_password';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Create a new PDO instance
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    $directories = ['models', 'controllers'];
    foreach ($directories as $directory) {
        $file = __DIR__ . '/' . $directory . '/' . $class_name . '.php';
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
});

// Initialize model and controller
$model = new Page($db);
$controller = new pageController($model);

// Get page ID from query string
$pageId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Display the page
$controller->displayPage($pageId);
