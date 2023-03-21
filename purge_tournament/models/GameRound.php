<?php

class GameRound {

    // Attributs

    private ?int $id;
    private string $name;
    private Tournament $tournament;
    private string $streamURL;

    // Construct

    public function __construct(string $name, Tournament $tournament)
    {
        $this->id = NULL;
        $this->name = $name;
        $this->tournament = $tournament;
        $this->streamURL = '';
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTournament() : Tournament {
        return $this->tournament;
    }

    public function getStreamURL() : ?string {
        return $this->streamURL;
    }

    // Setters

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setTournament(Tournament $tournament) : void {
        $this->tournament = $tournament;
    }

    public function setStreamURL(string $streamURL) : void {
        $this->streamURL = $streamURL;
    }
}