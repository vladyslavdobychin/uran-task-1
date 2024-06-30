<?php

use PHPUnit\Framework\TestCase;

class PageControllerTest extends TestCase
{
    private $db;
    private $page;
    private $controller;

    protected function setUp(): void
    {
        $dsn = 'mysql:host=db;dbname=task_1_database';
        $username = 'task_1_user';
        $password = 'task_1_password';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->db = new PDO($dsn, $username, $password, $options);
        $this->page = new Page($this->db);
        $this->controller = new PageController($this->page);
    }

    public function testDisplayHomePage()
    {
        ob_start();
        $this->controller->displayHomePage();
        $output = ob_get_clean();

        $this->assertStringContainsString('Home Page', $output);
        $this->assertStringContainsString('Welcome to the home page.', $output);
    }

    public function testDisplayPage()
    {
        // Mock the performRedirect function
        $this->controller = $this->getMockBuilder(PageController::class)
            ->setConstructorArgs([$this->page])
            ->onlyMethods(['performRedirect'])
            ->getMock();

        $this->controller->expects($this->any())
            ->method('performRedirect')
            ->will($this->returnValue(true));

        // Test with a valid identifier
        ob_start();
        $this->controller->displayPage('about');
        $output = ob_get_clean();

        $this->assertStringContainsString('About Us', $output);
        $this->assertStringContainsString('Learn more about us on this page.', $output);
    }



    public function testCreatePage()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['title'] = 'Test Page';
        $_POST['friendly'] = 'test-page';
        $_POST['description'] = 'This is a test page.';

        // Mock the performRedirect function
        $this->controller = $this->getMockBuilder(PageController::class)
            ->setConstructorArgs([$this->page])
            ->onlyMethods(['performRedirect'])
            ->getMock();

        $this->controller->expects($this->any())
            ->method('performRedirect')
            ->will($this->returnValue(true));

        ob_start();
        $this->controller->createPage();
        ob_end_clean();

        $page = $this->page->getPageByFriendly('test-page');
        $this->assertEquals('Test Page', $page['title']);
    }

}
