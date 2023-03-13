<?php

class Contact

{
    // Attributs

    private ?int $id;
    private string $name;
    private string $email;
    private string $message;

    // Construct

    public function __construct(string $name , string $email , string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->id = NULL;

    }


    // Getters

     public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }
    public function getMessage() : string
    {
        return $this->message;
    }


    // Setters

    public function setId($id) : void
    {
        $this->id = $id;
    }


    public function setName($name) : void
    {
        $this->name = $name;
    }

    public function setEmail($email) : void
    {
        $this->email = $email;
    }



    public function setMessage($message) : void
    {
        $this->password = $password;
    }

}