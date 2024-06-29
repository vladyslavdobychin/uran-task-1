<?php

class Page {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPages() {
        $sqlQuery = $this->db->prepare("SELECT * FROM pages");
        $sqlQuery->execute();
        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPageByID($id) {
        $sqlQuery = $this->db->prepare("SELECT * FROM pages WHERE id = :id");
        $sqlQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $sqlQuery->execute();
        return $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function createPage($title, $friendly, $description) {
        $sqlQuery = $this->db->prepare("INSERT INTO pages (title, friendly, description) VALUES (:title, :friendly, :description)");
        $sqlQuery->bindParam(':title', $title);
        $sqlQuery->bindParam(':friendly', $friendly);
        $sqlQuery->bindParam(':description', $description);
        return $sqlQuery->execute();
    }

    public function updatePage($id, $friendly, $title, $description) {
        $stmt = $this->db->prepare("UPDATE pages SET friendly = :friendly, title = :title, description = :description WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':friendly', $friendly);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function deletePage($id) {
        $stmt = $this->db->prepare("DELETE FROM pages WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}