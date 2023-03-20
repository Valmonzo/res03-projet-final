<?php

class Tournament {

    // Attributs

    private ?int $id;
    private string $name;
    private string $date;
    private string $description;
    private string $gameName;
    private string $streamURL;
    private array $teams;


    // Construct

    public function __construct (string $name, string $date, string $description, string $gameName, string $streamURL) {

        $this->id = NULL;
        $this->name = $name;
        $this->date = $date;
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
        return $this->date;
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

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDate(string $date): void {
        $this->date = $date;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setGameName(string $gameName): void {
        $this->gameName = $gameName;
    }

    public function setStreamURL(string $streamURL): void {
        $this->streamURL = $streamURL;
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
        $tournamentAsArray = get_object_vars($this);

        // Je transforme mes teams en tableau pour les push dans l'index teams de mon tournoi
        $tournamentAsArray['teams'] = array_map(
            fn (Team $team) => $team->toArray(),
            $this->teams
        );

        // Je retourne mon tournoi sous forme de tableau
        return $tournamentAsArray;
    }

}