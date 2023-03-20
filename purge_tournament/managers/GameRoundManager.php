<?php

class GameRoundManager extends AbstractManager {

    // Methodes

    public function getGameRoundByTournament(Tournament $tournament) : array
    {
        $query = $this->db->prepare('SELECT * FROM game_round WHERE tournament_id = :id');
        $query->execute();
        $parameters = [
        'id' => $tournament->getId(),
        ];
        $query->execute($parameters);
        $gamesRoundAsArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $gamesRoundTab = [];

        // Pour chaque donnée de mon fetch, j'hydrate des instances de GameRound
        foreach ($gamesRoundAsArray as $gameRound) {

            $gameRoundToReturn = new GameRound($gameRound['name'], $tournament);

            // Je set son Id généré par ma base de données
            $gameRoundToReturn->setId($gameRound['id']);

            // Si un lien de stream est dans la base de données , je le set sur mon gameRound
            if(isset($gameRound['stream_url'] && !empty($gameRound['stream_url'])) {

                $gameRoundToReturn->setStreamURL($gameRound['stream_url']);
            }

            // Je push chaque gameRound dans un tableau
            $gamesRoundTab[] = $gameRoundToReturn;
        }

        // Je retourne mon tableau de GameRound
        return $gamesRoundTab;
    }


    public function insertGameRound(GameRound $gameRound): GameRound
    {

        $query = $this->db->prepare('INSERT INTO game_round ( `ìd`, `name`, `tournament_id`, `stream_url`) VALUES (NULL, :name, :tournament_id, :stream_url)');

        $parameters = [
        'name' => $gameRound->getName(),
        'tournament_id' => $gameRound->getTournament()->getId(),
        'stream_url'=>$gameRound->getStreamURL(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $gameRound->setId($id);
        return $gameRound;
    }

}