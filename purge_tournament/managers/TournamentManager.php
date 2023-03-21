<?php

class TournamentManager extends AbstractManager {

    // Méthodes

    public function insertTournament(Tournament $tournament): Tournament
    {

        $dateToConvert = strtotime($tournament->getDate());
        $date = date("Y-m-d H:i:s", $dateToConvert);

        $query = $this->db->prepare('INSERT INTO tournament (`id`, `name`, `date`, `description`, `game_name`, `stream_url`) VALUES (NULL, :name, :date, :description, :game_name, :stream_url)');

        $parameters = [
        'name' => $tournament->getName(),
        'date' => $date,
        'description'=>$tournament->getDescription(),
        'game_name' => $tournament->getGameName(),
        'stream_url'=> $tournament->getStreamURL(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $tournament->setId($id);
        return $tournament;
    }
}