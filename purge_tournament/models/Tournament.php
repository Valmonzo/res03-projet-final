<?php

class Tournament {

    // Attributs

    private ?int $id;
    private string $name;
    private string $date;
    private string $description;
    private string $gameName;
    private string $streamURL;


    // Construct

    public function __construct (string $name, string $date, string $description, string $gameName, string $streamURL) {

        $this->id = NULL;
        $this->name = $name;
        $this->date = $date;
        $this->description = $description;
        $this->gameName = $gameName;
        $this->streamURL = $streamURL;
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


    // Setters

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setDate(string $date) : void {
        $this->date = $date;
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
}