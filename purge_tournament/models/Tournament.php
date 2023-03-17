<?php

class Tournament {

    // Attributs

    private ?int $id;
    private string $name;
    private string $tdate;
    private string $description;
    private string $gameName;
    private string $streamURL;
    private array $teams;


    // Construct

    public function __construct (string $name, string $tdate, string $description, string $gameName, string $streamURL) {

        $this->id = NULL;
        $this->name = $name;
        $this->tdate = $tdate;
        $this->description = $description;
        $this->gameName = $gameName;
        $this->streamURL = $streamURL;
        $this->teams = [];
    }

    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getDate() : string {
        return $this->tdate;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getGameName() : string {
        return $this->gameName;
    }

    public function getStreamURL() : string {
        return $this->streamURL;
    }

    public function getTeams() : array {
        return $this->teams;
    }


    // Setters

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setDate(string $tdate) : void {
        $this->tdate = $tdate;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function setGameName(string $gameName) : void {
        $this->gameName = $gameName;
    }

    public function setStreamURL(string $streamURL) : void {
        $this->streamURL = $streamURL;
    }

    public function setTeams (array $teams) : void {
        $this->teams = $teams;
    }

    // Methodes

    public function addTeam(Team $team) : array {

        $this->teams[] = $team;
        return $this->teams;
    }
}