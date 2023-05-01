<?php

class GameManager extends AbstractManager
{
    public function getGamesByGameRound(GameRound $gameRound): array
    {
        $query = $this->db->prepare(
            "SELECT * FROM game WHERE game_round_id = :id"
        );

        $parameters = [
            "id" => $gameRound->getId(),
        ];
        $query->execute($parameters);
        $gamesAsArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $gamesTab = [];

        // Pour chaque donnée de mon fetch, j'hydrate des instances de Game
        foreach ($gamesAsArray as $game) {
            // J'instancie des Team pour chaque game
            if ($game["team_a"] !== null && $game["team_b"] !== null) {
                $teamA = $this->getTeamById($game["team_a"]);
                $teamB = $this->getTeamById($game["team_b"]);
            } else {
                $teamA = null;
                $teamB = null;
            }

            $gameToReturn = new Game($teamA, $teamB, $gameRound);

            // Je set son Id généré par ma base de données
            $gameToReturn->setId($game["id"]);

            // Si un gagnant est déjà dans la base de données je le set
            if ($game["winner_team"] !== null) {
                $gameToReturn->setWinner($game["winner_team"]);
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
            $query = $this->db->prepare(
                "INSERT INTO game ( `id`, `team_a`, `team_b`, `game_round_id`, `winner_team`) VALUES (NULL, NULL, NULL, :game_round_id, :winner_team)"
            );

            $parameters = [
                "game_round_id" => $game->getGameRound()->getId(),
                "winner_team" => $game->getWinner(),
            ];

            $query->execute($parameters);

            $id = $this->db->lastInsertId();
            $game->setId($id);
            return $game;
        } else {
            $query = $this->db->prepare(
                "INSERT INTO game ( `id`, `team_a`, `team_b`, `game_round_id`, `winner_team`) VALUES (NULL, :team_a, :team_b, :game_round_id, :winner_team)"
            );

            $parameters = [
                "team_a" => $game->getTeamA()->getId(),
                "team_b" => $game->getTeamB()->getId(),
                "game_round_id" => $game->getGameRound()->getId(),
                "winner_team" => $game->getWinner(),
            ];

            $query->execute($parameters);

            $id = $this->db->lastInsertId();
            $game->setId($id);
            return $game;
        }
    }

    public function editGame(Game $game): void
    {
        $query = $this->db->prepare(
            "UPDATE game SET  team_a = :team_a , team_b = :team_b, winner_team = :winner_team WHERE id = :id"
        );
        $parameters = [
            "id" => $game->getId(),
            "team_a" => $game->getTeamA()->getId(),
            "team_b" => $game->getTeamB()->getId(),
            "winner_team" => $game->getWinner(),
        ];
        $query->execute($parameters);
    }

    private function getTeamById(int $id): Team
    {
        // Récupérer un message par l'id pour le lire
        $query = $this->db->prepare("SELECT * FROM team WHERE id = :id");
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
        $team = $query->fetch(PDO::FETCH_ASSOC);

        $teamToLoad = new Team(
            $team["name"],
            $team["player_one"],
            $team["player_two"],
            $team["player_three"],
            $team["player_four"],
            $team["sub_player"],
            $team["coach"],
            $team["logo"]
        );
        $teamToLoad->setId($team["id"]);

        return $teamToLoad;
    }

    public function deleteGamesByGameRoundId(int $id): void
    {
        $query = $this->db->prepare(
            "DELETE FROM game WHERE game_round_id = :id"
        );
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
    }
}
