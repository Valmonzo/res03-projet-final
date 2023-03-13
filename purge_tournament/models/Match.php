<?php

class Match {

    // Attributs

    private ?int $id;
    private Team $teamA;
    private Team $teamB;
    private Tournament $tournament


    // Construct

    public function __construct(Team $teamA , Team $teamB, Tournament $tournament) {
        $this->id = NULL;
        $this->teamA = $teamA;
        $this->teamB = $teamB;
        $this->tournament = $tournament;
    }


    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getTeamA() : Team {
        return $this->teamA;
    }

    public function getTeamB() : Team {
        return $this->teamB;
    }

    public function getTournament() : Tournament {
        return $this->tournament;
    }

    // Setters

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setTeamA(Team $teamA) : void {
        $this->teamA = $teamA;
    }

    public function setTeamB(Team $teamB) : void {
        $this->teamB = $teamB;
    }

    public function setTournament(Tournament $tournament) : void {
        $this->tournament = $tournament;
    }
}