<?php

class TeamManager extends AbstractManager {

    public function getAllTeams() : array {
        $query = $this->db->prepare('SELECT * FROM team');
        $query->execute();
        $teams = $query->fetchAll(PDO::FETCH_ASSOC);

        $teamsTab = [];

        foreach($teams as $team) {
            $teamToLoad = new Team($team['name'], $team['player_one'], $team['player_two'],
            $team['player_three'], $team['player_four'], $team['sub_player'], $team['coach'], $team['logo']);
            $teamToLoad->setId($team['id']);
            $teamsTab[] = $teamToLoad;
        }

        return $teamsTab;
    }

    public function getTeamById(int $id) : Team {
        // Récupérer un message par l'id pour le lire
        $query = $this->db->prepare('SELECT * FROM team WHERE id = :id');
        $parameters = [
        'id' => $id
        ];
        $query->execute($parameters);
        $team = $query->fetch(PDO::FETCH_ASSOC);

        $teamToLoad = new Team($team['name'], $team['player_one'], $team['player_two'],
        $team['player_three'], $team['player_four'], $team['sub_player'], $team['coach'], $team['logo']);
        $teamToLoad->setId($team['id']);

        return $teamToLoad;
    }


    public function insertTeam(Team $team) : Void  {
        $query = $this->db->prepare('INSERT INTO team (`id`, `name`, `player_one`, `player_two`, `player_three`, `player_four`, `sub_player`, `logo`, `coach` ) VALUES(NULL, :name, :player_one, :player_two, :player_three, :player_four, :sub_player, :logo, :coach)');

        $parameters = [
        'name' => $team->getName(),
        'player_one' => $team->getPlayerOne(),
        'player_two'=>$team->getPlayerTwo(),
        'player_three' => $team->getPlayerThree(),
        'player_four' => $team->getPlayerFour(),
        'sub_player' => $team->getSubPlayer(),
        'coach' => $team->getCoach(),
        'logo' => $team->getLogo(),
        ];
        $query->execute($parameters);
    }

    public function editTeam(Team $team) : Void {
        var_dump($team);

        $query = $this->db->prepare('UPDATE team SET  name = :name , player_one = :player_one, player_two = :player_two, player_three = :player_three, player_four = :player_four, sub_player = :sub_player, logo = :logo, coach = :coach WHERE id = :id');
        $parameters = [
        'id' => $team->getId(),
        'name' => $team->getName(),
        'player_one' => $team->getPlayerOne(),
        'player_two'=>$team->getPlayerTwo(),
        'player_three' => $team->getPlayerThree(),
        'player_four' => $team->getPlayerFour(),
        'sub_player' => $team->getSubPlayer(),
        'coach' => $team->getCoach(),
        'logo' => $team->getLogo(),
        ];
        $query->execute($parameters);


    }

    public function deleteTeamById(int $id) : void {
        // Supprimer une Team

        $query = $this->db->prepare('DELETE FROM team WHERE id = :id');
        $parameters = [
            'id' => $id,
        ];
        $query->execute($parameters);
    }
}