<?php

class PageController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function displayPage($identifier)
    {
        $page = $this->getPageByIdOrFriendly($identifier);

        if ($page) {
            $title = $page['title'];
            $description = $page['description'];
        } else {
            $title = 'Page not found';
            $description = 'This page does not exist.';
        }

        include 'views/pageTemplate.php';
    }

    public function displayHomePage()
    {
        $homePage = $this->model->getPageByFriendly('home');
        $pages = $this->model->getAllPagesExceptHome();

        if ($homePage) {
            $title = $homePage['title'];
            $description = $homePage['description'];
        } else {
            $title = 'Home Page';
            $description = 'Welcome, it\'s a home screen ya know';
        }

        include 'views/homeTemplate.php';
    }

    private function getPageByIdOrFriendly($identifier)
    {
        if (is_numeric($identifier)) {
            return $this->model->getPageById($identifier);
        } else {
            return $this->model->getPageByFriendly($identifier);
        }
    }
}
