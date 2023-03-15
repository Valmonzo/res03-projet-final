<?php

class GameRound {

    // Attributs

    private ?int $id;
    private Game $game;
    private Team $winner;
    private ?string $media;

    // Construct

    public function __construct(Game $game, Team $winner, string $media = NULL)
    {
        $this->id = NULL;
        $this->game = $game;
        $this->winner = $winner;
        $this->media = $media;
    }

    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getGame() : Game {
        return $this->game;
    }

    public function getWinner() : Team {
        return $this->winner;
    }

    public function getMedia() : ?string {
        return $this->media;
    }

    // Setters

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setGame(Game $game) : void {
        $this->game = $game;
    }

    public function setWinner(Team $winner) : void {
        $this->winner = $winner;
    }

    public function setMedia(string $media) : void {
        $this->media = $media;
    }
}