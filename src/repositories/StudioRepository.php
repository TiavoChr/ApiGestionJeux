<?php

class StudioRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getStudios()
    {
        $sql = "SELECT * FROM studios";
        $stmt = $this->db->executeQuery($sql);
        return $this->db->fetchAll($stmt);
    }

    public function getStudioById($id)
    {
        $sql = "SELECT * FROM studios WHERE id = :id";
        $params = [':id' => $id];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetch($stmt);
    }

    public function getStudiosByGameId($gameId)
    {
        $sql = "SELECT s.* FROM studios s
                JOIN game_studios gs ON s.id = gs.studio_id
                WHERE gs.game_id = :gameId";

        $params = [':gameId' => $gameId];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetchAll($stmt);
    }
}
