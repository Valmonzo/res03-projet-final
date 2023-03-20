<?php

class Team {

    // Attributs

    private ?int $id;
    private string $name;
    private string $playerOne;
    private string $playerTwo;
    private string $playerThree;
    private string $playerFour;
    private string $subPlayer;
    private string $coach;
    private string $logo;


    // Construct

    public function __construct (string $name, string $playerOne, string $playerTwo, string $playerThree, string $playerFour, string $subPlayer, string $coach, string $logo)
    {
        $this->id = NULL;
        $this->name = $name;
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
        $this->playerThree = $playerThree;
        $this->playerFour = $playerFour;
        $this->subPlayer = $subPlayer;
        $this->coach = $coach;
        $this->logo = $logo;
    }

    // Getters

    public function getId() : ?int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getPlayerOne() : string {
        return $this->playerOne;
    }

    public function getPlayerTwo() : string {
        return $this->playerTwo;
    }

    public function getPlayerThree() : string {
        return $this->playerThree;
    }

    public function getPlayerFour() : string {
        return $this->playerFour;
    }

    public function getSubPlayer() : string {
        return $this->subPlayer;
    }

    public function getCoach() : string {
        return $this->coach;
    }

    public function getLogo() : string {
        return $this->logo;
    }


    // Setters


    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setPlayerOne(string $playerOne) : void {
        $this->playerOne = $playerOne;
    }

    public function setPlayerTwo(string $playerTwo) : void {
        $this->playerTwo = $playerTwo;
    }

    public function setPlayerThree(string $playerThree) : void {
        $this->playerThree = $playerThree;
    }

    public function setPlayerFour(string $playerFour) : void {
        $this->playerFour = $playerFour;
    }

    public function setSubPlayer(string $subPlayer): void {
        $this->subPlayer = $subPlayer;
    }

    public function setCoach(string $coach): void {
        $this->coach = $coach;
    }

    public function setLogo(string $logo): void {
        $this->logo = $logo;
    }

    // Methodes

    public function toArray() : array
    {
        // Je retourne mon objet en tableau pour pouvoir l'utiliser en JSON
        /* return [
            'id' => $this->id,
            'name' => $this->name,
            'playerOne' => $this->playerOne,
            'playerTwo' => $this->playerTwo,
            'playerThree' => $this->playerThree,
            'playerFour' => $this->playerFour,
            'subPlayer' => $this->subPlayer,
            'coach' => $this->coach,
            'logo' => $this->logo,
            ];
        */

        return get_object_vars($this);

    }
}