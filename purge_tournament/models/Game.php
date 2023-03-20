<?php

class Game {

    // Attributs

    private ?int $id;
    private Team $teamA;
    private Team $teamB;
    private Team $winner;
    private GameRound $gameRound;

    // Construct

    public function __construct(Team $teamA , Team $teamB, GameRound $gameRound)
    {
        $this->id = NULL;
        $this->teamA = $teamA;
        $this->teamB = $teamB;
        $this->winner = NULL;
        $this->gameRound = $gameRound;
    }


    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamA(): Team
    {
        return $this->teamA;
    }

    public function getTeamB(): Team
    {
        return $this->teamB;
    }

    public function getGameRound(): GameRound
    {
        return $this->gameRound;
    }

    public function getWinner(): Team
    {
        return $this->winner;
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

    public function setWinner(Team $winner): void
    {
        $this->winner = $winner;
    }

    public function setGameRound(GameRound $gameRound): void
    {
        $this->gameRound = $gameRound;
    }
}