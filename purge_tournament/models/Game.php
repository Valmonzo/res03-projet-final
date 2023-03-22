<?php

class Game {

    // Attributs

    private ?int $id;
    private ?Team $teamA;
    private ?Team $teamB;
    private ?int $winner;
    private GameRound $gameRound;
    private array $teams;

    // Construct

    public function __construct( ?Team $teamA, ?Team $teamB, GameRound $gameRound)
    {
        $this->id = NULL;
        $this->teamA = $teamA;
        $this->teamB = $teamB;
        $this->winner = NULL;
        $this->gameRound = $gameRound;
        $this->teams = [];
    }


    // Getters

    public function getId(): ?int
    {
        if ($this->id !== null) {
            return $this->id;
        }

        else {
            return NULL;
        }

    }

    public function getTeamA(): ?Team
    {
        return $this->teamA;
    }

    public function getTeamB(): ?Team
    {
        return $this->teamB;
    }

    public function getGameRound(): GameRound
    {
        return $this->gameRound;
    }

    public function getWinner(): ?int
    {
        return $this->winner;
    }

    public function getTeams() : array
    {
        return $this->teams;
    }

    // Setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTeamA(Team $teamA): void
    {
        $this->teamA = $teamA;
    }

    public function setTeamB(Team $teamB): void
    {
        $this->teamB = $teamB;
    }

    public function setWinner(int $winner): void
    {
        $this->winner = $winner;
    }

    public function setGameRound(GameRound $gameRound): void
    {
        $this->gameRound = $gameRound;
    }

    public function setTeams (array $teams): void
    {
        $this->teams = array_unique($teams, SORT_REGULAR);
    }

    // Methodes

    public function addTeam(Team $team): void
    {
       $this->teams[] = $team;

        // Je traite l'erreur possible en supprimant un potentiel doublon de team dans mon tableau
        $this->teams = array_unique($this->teams, SORT_REGULAR);
    }

    public function toArray() : array {

        // Je transforme mon tournoi en tableau
        $GameAsArray = get_object_vars($this);

        // Je transforme mes teams en tableau pour les push dans l'index teams de mon tournoi
        $gameAsArray['teams'] = array_map(
            fn (Team $team) => $team->toArray(),
            $this->teams
        );

        // Je retourne mon tournoi sous forme de tableau
        return $gameAsArray;
    }
}