<?php

class User
{
    // Attributs //

    private ?int $id;
    private string $email;
    private string $username;
    private string $password;

    // Constructor //

    public function __construct(string $email, string $username, string $password)
    {
        $this->id = NULL;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    // Getters //

    public function getId() : int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    // Setters //

    public function setId($id) : void
    {
        $this->id = $id;
    }

    public function setEmail($email) : void
    {
        $this->email = $email;
    }

    public function setUsername($username) : void
    {
        $this->username = $username;
    }

    public function setPassword($password) : void
    {
        $this->password = $password;
    }


}


?>