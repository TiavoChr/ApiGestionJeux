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

    public function getGamesInfo($page, $genre, $plateforme, $studioname)
    {
        $sql = "SELECT g.* FROM games g
        JOIN game_studios gs ON g.id = gs.game_id
        JOIN studios std ON std.id = gs.studio_id
            WHERE std.name = '".$studioname."' 
        AND g.genre = '".$genre."'
            AND (g.platform LIKE '%".$plateforme."'
            OR g.platform LIKE '".$plateforme."%'
            OR g.platform LIKE '%".$plateforme."%') LIMIT ".$page;
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

    public function getEditorsByGameId($gameId)
    {
        $sql = "SELECT e.* FROM editors e
                JOIN game_editors ge ON e.id = ge.editor_id
                WHERE ge.game_id = :gameId";

        $params = [':gameId' => $gameId];
        $stmt = $this->db->executeQuery($sql, $params);
        return $this->db->fetchAll($stmt);
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
