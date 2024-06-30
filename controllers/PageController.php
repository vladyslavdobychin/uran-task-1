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
            include 'views/pageTemplate.php';
        } else {
            $this->displayNotFoundPage();
        }
    }

    public function displayHomePage()
    {
        $homePage = $this->model->getPageByFriendly('home');
        $pages = $this->model->getAllPagesExceptHome();

        $title = $homePage['title'];
        $description = $homePage['description'];

        include 'views/homeTemplate.php';
    }

    public function createPageForm()
    {
        include 'views/createPageForm.php';
    }

    public function createPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $friendly = $_POST['friendly'];
            $description = $_POST['description'];
            $this->model->createPage($title, $friendly, $description);
            $this->performRedirect('/home');
        } else {
            $this->createPageForm(); // Handle GET request by displaying the form
        }
    }

    public function updatePageForm($id)
    {
        $page = $this->model->getPageById($id);
        if ($page) {
            include 'views/updatePageForm.php';
        } else {
            $this->displayNotFoundPage();
        }
    }

    public function updatePage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $friendly = $_POST['friendly'];
            $description = $_POST['description'];
            $this->model->updatePage($id, $friendly, $title, $description);
            $this->performRedirect('/home');
        } else {
            $this->displayHomePage(); // Handle GET request by displaying the home page
        }
    }

    public function deletePage()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->deletePage($id);
        }
        $this->performRedirect('/home');
    }

    private function getPageByIdOrFriendly($identifier)
    {
        if (is_numeric($identifier)) {
            $page = $this->model->getPageById($identifier);

            if ($page) {
                // Redirect to friendly URL if accessed by ID
                $this->performRedirect('/' . $page['friendly']);
            }
        } else {
            return $this->model->getPageByFriendly($identifier);
        }

        return null;
    }

    private function displayNotFoundPage()
    {
        $title = 'Page not found';
        $description = 'This page does not exist.';
        include 'views/notFoundTemplate.php';
    }

    public function performRedirect($url)
    {
        header("Location: $url");
        exit;
    }
}
