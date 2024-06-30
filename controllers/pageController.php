<?php

class pageController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function displayPage($identifier) {
        // Check if identifier is numeric
        if (is_numeric($identifier)) {
            $page = $this->model->getPageById($identifier);
            if ($page) {
                // Redirect to friendly URL if accessed by ID
                $friendlyUrl = '/' . $page['friendly'];
                header('Location: ' . $friendlyUrl);
                exit;
            }
        } else {
            $page = $this->model->getPageByFriendly($identifier);
        }

        if ($page) {
            $title = $page['title'];
            $description = $page['description'];
        } else {
            $title = 'Page not found';
            $description = 'This page does not exist.';
        }
        include 'views/pageTemplate.php';
    }

    public function displayHomePage() {
        // Fetch the home page content
        $homePage = $this->model->getPageByFriendly('home');

        if ($homePage) {
            $title = $homePage['title'];
            $description = $homePage['description'];
        } else {
            // Fallback values just in case
            $title = 'Home Page';
            $description = 'Welcome, it\'s a home screen ya know';
        }

        // Fetch all pages except the home page
        $pages = array_filter($this->model->getAllPages(), function($page) {
            return $page['friendly'] !== 'home';
        });

        include 'views/homeTemplate.php';
    }
}