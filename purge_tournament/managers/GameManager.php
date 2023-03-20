<?php

class GameManager extends AbstractManager {

    public function getGamesByGameRound(GameRound $gameRound): array
    {

        $query = $this->db->prepare('SELECT * FROM game WHERE game_round_id = :id');
        $query->execute();
        $parameters = [
        'id' => $gameRound->getId(),
        ];
        $query->execute($parameters);
        $gamesAsArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $gamesTab = [];

        // Pour chaque donnée de mon fetch, j'hydrate des instances de Game
        foreach ($gamesAsArray as $game) {

            $gameToReturn = new Game($game['team_a'], $game['team_b'], $gameRound);

            // Je set son Id généré par ma base de données
            $gameToReturn->setId($game['id']);

            // Si un gagnant est déjà dans la base de données je le set
            if(isset($game['winner_team']) && !empty($game['winner_team'])) {

                $gameToReturn->setWinner(getTeamById($game['winner_team']));
            }

            // Je push chaque gameRound dans un tableau
            $gamesTab[] = $gameToReturn;
        }

        // Je retourne mon tableau de GameRound
        return $gamesTab;
    }


    public function insertGame(Game $game): Game
    {
        $query = $this->db->prepare('INSERT INTO game ( `ìd`, `team_a`, `team_b`, `game_round_id`) VALUES (NULL, :team_a, :team_b, :game_round_id)');

        $parameters = [
        'team_a' => $game->getTeamA()->getId(),
        'team_b' => $game->getTeamB()->getId(),
        'game_round_id'=>$game->getGameRound()->getId(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $game->setId($id);
        return $game;
    }

}