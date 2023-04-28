<?php

class TournamentManager extends AbstractManager {

    // Méthodes

    public function insertTournament(Tournament $tournament): Tournament
    {
        var_dump($tournament);
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
    
    public function updateTournament(Tournament $tournament): Tournament
    {
        $dateToConvert = strtotime($tournament->getDate());
        $date = date("Y-m-d H:i:s", $dateToConvert);

        $query = $this->db->prepare('UPDATE tournament SET name = :name, date = :date, description = :description, game_name = :game_name, stream_url = :stream_url WHERE id = :id');

        $parameters = [
        'name' => $tournament->getName(),
        'date' => $date,
        'description'=>$tournament->getDescription(),
        'game_name' => $tournament->getGameName(),
        'stream_url'=> $tournament->getStreamURL(),
        'id' => $tournament->getId(),
        ];

        $query->execute($parameters);

        return $tournament;
    }

    public function getAllTournaments(): array
    {
        $query = $this->db->prepare('SELECT * FROM tournament');
        $query->execute();
        $tournaments = $query->fetchAll(PDO::FETCH_ASSOC);

        $tournamentsTab = [];

        foreach($tournaments as $tournament) {

            if ($tournament['stream_url'] === NULL) {
                $tournament['stream_url'] = "";
            }
            // $dateToString = date_format($tournament['date'],'Y-m-d H:i:s');

            $tournamentToLoad = new Tournament($tournament['name'], $tournament['date'], $tournament['description'], $tournament['game_name'], $tournament['stream_url']);
            $tournamentToLoad->setId($tournament['id']);
            $tournamentsTab[] = $tournamentToLoad;
        }

        return $tournamentsTab;
    }


    public function getTournamentById(int $id) : Tournament {

        // Récupérer un tournoi par l'id pour l'afficher


        $query = $this->db->prepare('SELECT * FROM tournament WHERE id = :id');

        $parameters = [
        'id' => $id
        ];
        $query->execute($parameters);

        $tournament = $query->fetch(PDO::FETCH_ASSOC);

        $tournamentToLoad= new Tournament($tournament['name'], $tournament['date'], $tournament['description'],
        $tournament['game_name'], $tournament['stream_url']);
        $tournamentToLoad->setId($tournament['id']);

        return $tournamentToLoad;
    }

    public function getTournamentsToday(): array
    {
    // Récupérer la date d'aujourd'hui

    $query = $this->db->prepare('SELECT * FROM tournament WHERE DATE(date) = CURDATE()');
    $query->execute();
    $tournaments = $query->fetchAll(PDO::FETCH_ASSOC);

    $tournamentsTab = [];

        foreach($tournaments as $tournament) {

            if ($tournament['stream_url'] === NULL) {
                $tournament['stream_url'] = "";
            }

            $tournamentToLoad = new Tournament($tournament['name'], $tournament['date'], $tournament['description'], $tournament['game_name'], $tournament['stream_url']);
            $tournamentToLoad->setId($tournament['id']);
            $tournamentsTab[] = $tournamentToLoad;
        }

            return $tournamentsTab;

    }

}