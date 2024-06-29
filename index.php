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

// Get page identifier from query string
if (isset($_GET['id'])) {
    $identifier = $_GET['id'];
} elseif (isset($_GET['friendly'])) {
    $identifier = $_GET['friendly'];
} else {
    $identifier = 1; // Default page ID
}

// Display the page
$controller->displayPage($identifier);
