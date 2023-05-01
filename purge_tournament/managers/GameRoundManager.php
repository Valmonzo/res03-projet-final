<?php

class GameRoundManager extends AbstractManager
{
    // Methodes

    public function getGameRoundsByTournament(Tournament $tournament): array
    {
        $query = $this->db->prepare(
            "SELECT * FROM game_round WHERE tournament_id = :id"
        );
        $parameters = [
            "id" => $tournament->getId(),
        ];
        $query->execute($parameters);
        $gamesRoundAsArray = $query->fetchAll(PDO::FETCH_ASSOC);

        $gamesRoundTab = [];

        // Pour chaque donnée de mon fetch, j'hydrate des instances de GameRound
        foreach ($gamesRoundAsArray as $gameRound) {
            $gameRoundToReturn = new GameRound($gameRound["name"], $tournament);

            // Je set son Id généré par ma base de données
            $gameRoundToReturn->setId($gameRound["id"]);

            // Si un lien de stream est dans la base de données , je le set sur mon gameRound
            if (
                isset($gameRound["stream_url"]) &&
                !empty($gameRound["stream_url"])
            ) {
                $gameRoundToReturn->setStreamURL($gameRound["stream_url"]);
            }

            // Je push chaque gameRound dans un tableau
            $gamesRoundTab[] = $gameRoundToReturn;
        }

        // Je retourne mon tableau de GameRound
        return $gamesRoundTab;
    }

    public function getGameRoundByTournamentAndGameRoundName(
        Tournament $tournament,
        string $gameRoundName
    ): GameRound {
        $query = $this->db->prepare(
            "SELECT * FROM game_round WHERE tournament_id = :id AND name = :name"
        );
        $parameters = [
            "id" => $tournament->getId(),
            "name" => $gameRoundName,
        ];
        $query->execute($parameters);
        $gameRound = $query->fetch(PDO::FETCH_ASSOC);

        $gameRoundToReturn = new GameRound($gameRound["name"], $tournament);
        $gameRoundToReturn->setId($gameRound["id"]);

        return $gameRoundToReturn;
    }

    public function insertGameRound(GameRound $gameRound): GameRound
    {
        $query = $this->db->prepare(
            "INSERT INTO game_round ( `id`, `name`, `tournament_id`, `stream_url`) VALUES (NULL, :name, :tournament_id, :stream_url)"
        );

        $parameters = [
            "name" => $gameRound->getName(),
            "tournament_id" => $gameRound->getTournament()->getId(),
            "stream_url" => $gameRound->getStreamURL(),
        ];

        $query->execute($parameters);

        $id = $this->db->lastInsertId();
        $gameRound->setId($id);
        return $gameRound;
    }

    public function deleteGameRoundByTournamentId(int $id)
    {
        $query = $this->db->prepare(
            "DELETE FROM game_round WHERE tournament_id = :id"
        );
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
    }
}
