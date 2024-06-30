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

    public function getPageByFriendly($friendly) {
        $sqlQuery = $this->db->prepare("SELECT * FROM pages WHERE friendly = :friendly");
        $sqlQuery->bindParam(':friendly', $friendly, PDO::PARAM_STR);
        $sqlQuery->execute();
        return $sqlQuery->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPagesExceptHome() {
        $sqlQuery = $this->db->prepare("SELECT * FROM pages WHERE friendly <> 'home'");
        $sqlQuery->execute();
        return $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPage($title, $friendly, $description) {
        $sqlQuery = $this->db->prepare("INSERT INTO pages (title, friendly, description) VALUES (:title, :friendly, :description)");
        $sqlQuery->bindParam(':title', $title);
        $sqlQuery->bindParam(':friendly', $friendly);
        $sqlQuery->bindParam(':description', $description);
        return $sqlQuery->execute();
    }

    public function updatePage($id, $friendly, $title, $description) {
        $sqlQuery = $this->db->prepare("UPDATE pages SET friendly = :friendly, title = :title, description = :description WHERE id = :id");
        $sqlQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $sqlQuery->bindParam(':friendly', $friendly);
        $sqlQuery->bindParam(':title', $title);
        $sqlQuery->bindParam(':description', $description);
        return $sqlQuery->execute();
    }

    public function deletePage($id) {
        $sqlQuery = $this->db->prepare("DELETE FROM pages WHERE id = :id");
        $sqlQuery->bindParam(':id', $id, PDO::PARAM_INT);
        return $sqlQuery->execute();
    }
}