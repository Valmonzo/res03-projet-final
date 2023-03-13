<?php

class MatchRound {

    // Attributs

    private ?int $id;
    private Match $match;
    private Team $winner;
    private ?string $media;

    // Construct

    public function __construct(Match $match, Team $winner, string $media = NULL)
    {
        $this->id = NULL;
        $this->match = $match;
        $this->winner = $winner;
        $this->media = $media;
    }

    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getMatch() : Match {
        return $this->match;
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

    public function setMatch(Match $match) : void {
        $this->match = $match;
    }

    public function setWinner(Team $winner) : void {
        $this->winner = $winner;
    }

    public function setMedia(string $media) : void {
        $this->media = $media;
    }
}