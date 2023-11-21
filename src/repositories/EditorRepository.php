<?php

class EditorRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getEditors()
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

    public function getEditorsByGameId($gameId)
    {
        $sql = "SELECT e.* FROM editors e
                JOIN game_editors ge ON e.id = ge.editor_id
                WHERE ge.game_id = :gameId";

        $params = [':gameId' => $gameId];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetchAll($stmt);
    }
}
