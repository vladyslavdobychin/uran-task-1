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
$controller = new PageController($model);

// Get page identifier from query string or friendly URL
if (isset($_GET['id'])) {
    $identifier = $_GET['id'];
    $controller->displayPage($identifier);
} elseif (isset($_GET['friendly'])) {
    $identifier = $_GET['friendly'];
    if ($identifier === 'home') {
        $controller->displayHomePage();
    } else {
        $controller->displayPage($identifier);
    }
} elseif ($_SERVER['REQUEST_URI'] === '/') {
    // Redirect to the friendly URL of the home page
    header('Location: /home');
    exit;
} elseif ($_SERVER['REQUEST_URI'] === '/home') {
    $controller->displayHomePage();
} else {
    // Handle invalid routes or unknown pages
    $controller->displayPage('home'); // Default to home page
}
