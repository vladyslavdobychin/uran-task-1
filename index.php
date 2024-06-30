<?php

require_once 'config.php';
require_once 'functions.php';

// Autoload classes
spl_autoload_register('autoloadClasses');

// Initialize model and controller
$db = getDatabaseConnection();
$model = new Page($db);
$controller = new PageController($model);

// Handle the request
handleRequest($controller);
