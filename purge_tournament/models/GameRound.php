<?php

class GameRound
{
    // Attributs

    private ?int $id;
    private string $name;
    private Tournament $tournament;
    private string $streamURL;
    private array $games;

    // Construct

    public function __construct(string $name, Tournament $tournament)
    {
        $this->id = null;
        $this->name = $name;
        $this->tournament = $tournament;
        $this->streamURL = "";
        $this->games = [];
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

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

    public function getStreamURL(): ?string
    {
        return $this->streamURL;
    }

    public function getGames(): array
    {
        return $this->games;
    }

    // Setters

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setTournament(Tournament $tournament): void
    {
        $this->tournament = $tournament;
    }

    public function setStreamURL(string $streamURL): void
    {
        $this->streamURL = $streamURL;
    }

    public function setGames(array $games): void
    {
        $this->games = array_unique($games, SORT_REGULAR);
    }

    // Methodes

    public function addGame(Game $game): void
    {
        $this->games[] = $game;

        // Je traite l'erreur possible en supprimant un potentiel doublon de team dans mon tableau
        $this->games = array_unique($this->games, SORT_REGULAR);
    }

    public function toArray(): array
    {
        // Je transforme mon gameRound en tableau
        $gameRoundAsArray = get_object_vars($this);

        // Je transforme mes teams en tableau pour les push dans l'index teams de mon tournoi
        $gameRoundAsArray["games"] = array_map(
            fn(Game $game) => $game->toArray(),
            $this->games
        );

        // Je retourne mon tournoi sous forme de tableau
        return $gameRoundAsArray;
    }
}
