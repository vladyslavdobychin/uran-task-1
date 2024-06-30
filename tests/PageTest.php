<?php

use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    private $db;
    private $page;

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
    }

    public function testGetAllPages()
    {
        $pages = $this->page->getAllPages();
        $this->assertIsArray($pages);
        $this->assertNotEmpty($pages);
    }

    public function testGetPageById()
    {
        $page = $this->page->getPageById(1);
        $this->assertIsArray($page);
        $this->assertEquals('Home Page', $page['title']);
    }

    public function testCreatePage()
    {
        $title = 'Test Page';
        $friendly = 'test-page';
        $description = 'This is a test page.';

        $result = $this->page->createPage($title, $friendly, $description);
        $this->assertTrue($result);

        $page = $this->page->getPageByFriendly('test-page');
        $this->assertEquals($title, $page['title']);
    }

    public function testUpdatePage()
    {
        $title = 'Updated Page';
        $friendly = 'updated-page';
        $description = 'This page has been updated.';

        $page = $this->page->getPageByFriendly('test-page');
        $id = $page['id'];

        $result = $this->page->updatePage($id, $friendly, $title, $description);
        $this->assertTrue($result);

        $updatedPage = $this->page->getPageById($id);
        $this->assertEquals($title, $updatedPage['title']);
    }

    public function testDeletePage()
    {
        $page = $this->page->getPageByFriendly('updated-page');
        $id = $page['id'];

        $result = $this->page->deletePage($id);
        $this->assertTrue($result);

        $deletedPage = $this->page->getPageById($id);
        $this->assertFalse($deletedPage);
    }
}
