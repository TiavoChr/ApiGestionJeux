<?php

class EditorRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getEditors($page = 100)
    {
        $sql = "SELECT * FROM editors";
        $stmt = $this->db->executeQuery($sql);
        return $this->db->fetchAll($stmt);
    }

    public function getEditorById($id)
    {
        $sql = "SELECT * FROM editors WHERE id = :id";
        $params = [':id' => $id];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetch($stmt);
    }

    public function getGamesByEditorId($editorId)
    {
        $sql = "SELECT g.* FROM games g
                JOIN game_editors ge ON g.id = ge.game_id
                WHERE ge.editor_id = :editorId";
        $params = [':editorId' => $editorId];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetchAll($stmt);
    }
}
