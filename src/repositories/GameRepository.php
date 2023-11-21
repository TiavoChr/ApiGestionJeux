<?php

class GameRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getGames()
    {
        $sql = "SELECT * FROM games";
        $stmt = $this->db->executeQuery($sql);
        return $this->db->fetchAll($stmt);
    }

    public function getGameById($id)
    {
        $sql = "SELECT * FROM games WHERE id = :id";
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

    public function getGamesByStudioId($studioId)
    {
        $sql = "SELECT g.* FROM games g
                JOIN game_studios gs ON g.id = gs.game_id
                WHERE gs.studio_id = :studioId";
        $params = [':studioId' => $studioId];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetchAll($stmt);
    }
}
