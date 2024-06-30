<?php

function redirect($url) {
    header("Location: $url");
    exit;
}

function handleRequest($controller) {
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
        redirect('/home');
    } elseif ($_SERVER['REQUEST_URI'] === '/home') {
        $controller->displayHomePage();
    } else {
        // Handle invalid routes or unknown pages
        redirect('/home'); // Default to home page
    }
}
