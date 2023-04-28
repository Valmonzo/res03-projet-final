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
    private array $gameRounds;


    // Construct

    public function __construct (string $name, string $date, string $description, string $gameName, string $streamURL) {

        $this->id = NULL;
        $this->name = $name;
        $this->date = $date;
        $this->description = $description;
        $this->gameName = $gameName;
        $this->streamURL = $streamURL;
        $this->teams = [];
        $this->gameRounds = [];
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

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGameName(): string
    {
        return $this->gameName;
    }

    public function getStreamURL(): string
    {
        return $this->streamURL;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }

    public function getGameRounds(): array
    {
        return $this->gameRounds;
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

    public function setTeams(array $teams): void
    {
        $this->teams = array_unique($teams, SORT_REGULAR);
    }

    public function setGameRounds(array $gameRounds): void
    {
        $this->gameRounds = array_unique($gameRounds, SORT_REGULAR);
    }

    // Methodes

    public function addTeam(Team $team): void
    {
       $this->teams[] = $team;

        // Je traite l'erreur possible en supprimant un potentiel doublon de team dans mon tableau
        $this->teams = array_unique($this->teams, SORT_REGULAR);
    }

    public function addGameRound(GameRound $gameRound) : void
    {
        $this->gameRounds[] = $gameRound;

        // Je traite l'erreur possible en supprimant un potentiel doublon de team dans mon tableau
        $this->gameRounds = array_unique($this->gameRounds, SORT_REGULAR);
    }

    public function toArrayTeams() : array
    {

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

    public function toArrayTournament(): array
    {
        // Je veux transformer mon tournoi en tableau et tout ce qu'il y a dedans aussi

        // Je commence par transformer mon tournoi en tableau
        $tournamentAsArray = get_object_vars($this);

        // Je transforme les Rounds dedans qui eux mêmes vont transformer ce qu'il y a à l'intérieur pour retourner un seul et unique tableau
        $tournamentAsArray['gameRounds'] = array_map(
            fn (GameRound $gameRound) => $gameRound->toArray(),
            $this->gameRounds
        );

        return $tournamentAsArray;
    }
    
    public function toArray(): array
    {
        return get_object_vars($this);
    }

}