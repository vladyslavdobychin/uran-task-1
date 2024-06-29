<?php

class pageController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function displayPage($id) {
        $page = $this->model->getPageById($id);

        if ($page) {
            $title = $page['title'];
            $description = $page['description'];
        }
        else {
            $title = 'Page not found';
            $description = 'This page does not exist.';
        }
        include 'views/pageTemplate.php';
    }
}