<?php

function redirect($url) {
    header("Location: $url");
    exit;
}

function handleRequest($controller) {
    $requestUri = $_SERVER['REQUEST_URI'];
    $normalizedUri = strtok($requestUri, '?');

    switch (true) {
        case $normalizedUri === '/createPageForm':
            $controller->createPageForm();
            break;

        case $normalizedUri === '/createPage':
            $controller->createPage();
            break;

        case isset($_GET['id']):
            $identifier = $_GET['id'];
            $controller->displayPage($identifier);
            break;

        case isset($_GET['friendly']):
            $identifier = $_GET['friendly'];
            if ($identifier === 'home') {
                $controller->displayHomePage();
            } else {
                $controller->displayPage($identifier);
            }
            break;

        case $normalizedUri === '/':
            redirect('/home');
            break;

        case $normalizedUri === '/home':
            $controller->displayHomePage();
            break;

        default:
            redirect('/home'); // Default to home page
            break;
    }
}
