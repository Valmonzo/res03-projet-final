<?php

class GameManager extends AbstractManager {

    public function getGamesByGameRound(GameRound $gameRound): array
    {
        // Je récupère les games et les teams liées aux games avec un LEFT JOIN

        $query = $this->db->prepare('
        SELECT * FROM game  JOIN team ON game.team_a = team.id  WHERE game.game_round_id =  :id
        UNION
        SELECT * FROM game  JOIN team ON game.team_b = team.id  WHERE game.game_round_id =  :id
        UNION
        SELECT * FROM game  JOIN team ON game.winner_team = team.id WHERE game.game_round_id =  :id'
        );

        $parameters = [
        'id' => $gameRound->getId(),
        ];
        $query->execute($parameters);
        $gamesAsArray = $query->fetchAll(PDO::FETCH_ASSOC);

        var_dump($gamesAsArray);

        $gamesTab = [];

        // Pour chaque donnée de mon fetch, j'hydrate des instances de Game
        foreach ($gamesAsArray as $game) {
       // J'instancie des Team pour chaque game
            $teamA = new Team($game['team_a']['name'], $game['team_a']['player_one'], $game['team_a']['player_two'], $game['team_a']['player_three'], $game['team_a']['player_four'], $game['team_a']['sub_player'], $game['team_a']['coach'], $game['team_a']['logo']);
            $teamB = new Team($game['team_b']['name'], $game['team_b']['player_one'], $game['team_b']['player_two'], $game['team_b']['player_three'], $game['team_b']['player_four'], $game['team_b']['sub_player'], $game['team_b']['coach'], $game['team_b']['logo']);


            $gameToReturn = new Game($teamA, $teamB, $gameRound);

            // Je set son Id généré par ma base de données
            $gameToReturn->setId($game['id']);

            // Si un gagnant est déjà dans la base de données je le set
            if($game['winner_team'] !== NULL) {

            $winner = new Team($game['winner_team']['name'], $game['winner_team']['player_one'], $game['winner_team']['player_two'], $game['winner_team']['player_three'], $game['winner_team']['player_four'], $game['winner_team']['sub_player'], $game['winner_team']['coach'], $game['winner_team']['logo']);

                $gameToReturn->setWinner($winner);
            }

            // Je push chaque gameRound dans un tableau
            $gamesTab[] = $gameToReturn;
        }

        // Je retourne mon tableau de GameRound
        return $gamesTab;


    }


    public function insertGame(Game $game): Game
    {
        if ($game->getTeamA() === null && $game->getTeamB() === null) {

            $query = $this->db->prepare('INSERT INTO game ( `id`, `team_a`, `team_b`, `game_round_id`, `winner_team`) VALUES (NULL, NULL, NULL, :game_round_id, :winner_team)');

        $parameters = [
        'game_round_id'=>$game->getGameRound()->getId(),
        'winner_team'=>$game->getWinner(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $game->setId($id);
        return $game;

        }

        else {

            $query = $this->db->prepare('INSERT INTO game ( `id`, `team_a`, `team_b`, `game_round_id`, `winner_team`) VALUES (NULL, :team_a, :team_b, :game_round_id, :winner_team)');

        $parameters = [
        'team_a' => $game->getTeamA()->getId(),
        'team_b' => $game->getTeamB()->getId(),
        'game_round_id'=>$game->getGameRound()->getId(),
        'winner_team'=>$game->getWinner(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $game->setId($id);
        return $game;

        }

    }

}