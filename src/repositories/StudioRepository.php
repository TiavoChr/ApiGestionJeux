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
